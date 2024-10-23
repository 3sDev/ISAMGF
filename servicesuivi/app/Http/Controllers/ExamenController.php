<?php

namespace App\Http\Controllers;

use App\Models\ExamenStudent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamenController extends Controller
{
    use Services\MyTrait;
    use Services\ConvertBase64;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $response = Http::get($this->getUrlServer().'/getAllExamens');
        $examens = json_decode($response);

        foreach ($examens as $key => $value) {
            foreach ($value as $key => $item) {
                $codes = $item;
            }
        }

        //return view('examen.index', ['examens' => $examens, 'codes' => $codes]);
        return view('examen.index', ['examens' => $examens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response1 = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response1);
        $response2 = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response2);
        $response3 = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response3);

        return view('examen.create', ['teachers' => $teachers, 'matieres' => $matieres, 'classes' => $classes]);
    }

    public function getMatiere(Request $request)
    {
        $states = DB::table("matiere_classes")
                ->select('matiere_classes.matiere_id', 'matieres.subjectLabel', 'matieres.description')
                ->join('matieres','matieres.id','=','matiere_classes.matiere_id')
                ->where("matiere_classes.classe_id", $request->classe_id) //->where("classe_id", 1)
                ->get("matiere_classes.matiere_id", "matieres.subjectLabel", "matieres.description");
                error_log($states);
                //return ($states);
        return response()->json($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/examens', [
            'annee'       => $request->input('annee'),
            'semestre'    => $request->input('semestre'),
            'session'     => $request->input('session'),
            'description' => $request->input('description'),
            'classe_id'   => $request->input('classe_id'),
            'matiere_id'  => $request->input('matiere_id'),
            'teacher_id'  => $request->input('teacher_id'),
        ]);
        return redirect('/examens')->with('message', 'Examen est ajouté avec succés');
    }

    public function addCodesToStudents(Request $request)
    {
        $now = new \DateTime();
        $ID_Examen  = $request->examen_id;
        $ID_Student = $request->student_id;
        $code   = $request->code;

        foreach ($ID_Student as $key => $insert) {
            $datasave = [
                'examen_id'  => $ID_Examen,
                'student_id' => $ID_Student[$key],
                'code'       => $code[$key],
                'created_at' => $now,
                'updated_at' => $now,
            ];
            DB::table('examen_students')->insert($datasave);
        }
        
        $response = Http::get($this->getUrlServer().'/getAllExamens');
        $examens = json_decode($response);   
        return view('examen.index', ['examens' => $examens]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/agenda/'.$id);
        $agenda = json_decode($response);

        return view('agenda.show', ['agenda' => $agenda]);
    }

    public function affecterExamen($id, $classe)
    {
        $response1 = Http::get($this->getUrlServer().'/examenWithStudentsById/'.$id);
        $examens = json_decode($response1);
        $response2 = Http::get($this->getUrlServer().'/students-classesRandom/'.$classe);
        $students  = json_decode($response2);

        return view('examen.affecter', ['examens' => $examens, 'students' => $students]);
    }

    public function modifierCodeExamen($id, $classe)
    {
        $response1 = Http::get($this->getUrlServer().'/examenWithStudentsById/'.$id);
        $examens = json_decode($response1);
        $response2 = Http::get($this->getUrlServer().'/students-classes/'.$classe);
        $students  = json_decode($response2);

        foreach ($examens as $key => $value) {
            foreach ($value as $key => $item) {
                $codes = $item;
            }
        }
        return view('examen.code', ['examens' => $examens, 'students' => $students, 'codes' => $codes]);
    }

    public function saisirNoteExamen($id, $classe)
    {
        $response1 = Http::get($this->getUrlServer().'/examenWithStudentsById/'.$id);
        $examens = json_decode($response1);
        $response2 = Http::get($this->getUrlServer().'/students-classes/'.$classe);
        $students  = json_decode($response2);

        foreach ($examens as $key => $value) {
            foreach ($value as $key => $item) {
                $codes = $item;
            }
        }
        return view('examen.teacher', ['examens' => $examens, 'students' => $students, 'codes' => $codes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $response1 = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response1);
        $response2 = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response2);
        $response3 = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response3);
        $response4 = Http::get($this->getUrlServer().'/examenWithStudentsById/'.$id);
        $examens = json_decode($response4);

        return view('examen.edit', ['teachers' => $teachers, 'matieres' => $matieres, 'classes' => $classes, 'examens' => $examens]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-examen/'.$id, [
            'annee'       => $request->input('annee'),
            'semestre'    => $request->input('semestre'),
            'session'     => $request->input('session'),
            'description' => $request->input('description'),
            'classe_id'   => $request->input('classe_id'),
            'matiere_id'  => $request->input('matiere_id'),
            'teacher_id'  => $request->input('teacher_id'),
        ]);
        return redirect()->back()->with('message', 'Examen est modifié avec succés'); 
    }

    public function modifierCodeStudentByIdCode(Request $request, $id)
    {
        $code = ExamenStudent::find($id);
        $code->code = $request->input('code');

        $code->update();
        return redirect()->back(); 
    }

        public function addNotesToStudentsByTeacher(Request $request)
    {
        $ID_Student = $request->student_id;
        $note       = $request->note;
        $idNote     = $request->idNote;
        $idExamen   = $request->idExamen;

        foreach ($ID_Student as $key => $insert) {
            $datasave = [
                'note' => $note[$key],
            ];
            DB::table('examen_students')->where('id', '=', $idNote[$key])->update($datasave);
        }
        DB::table('examens')->where('id', '=', $idExamen)->update(['statut' => '1']);

        return redirect()->back()->with('message', 'Les notes sont ajoutés avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-examenNote/'.$id);
        return redirect()->back(); 
    }
}
