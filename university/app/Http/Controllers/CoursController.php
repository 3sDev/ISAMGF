<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Cours;
use App\Models\CoursClasse;
use App\Models\Level;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ladumor\OneSignal\OneSignal;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Cours::with('classe')->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    //Get all classes from idTeacher
    public function getAllclassesFromIdTeacher($id)
    {
        $sql = DB::select('SELECT DISTINCT classes.id as idClasse, classes.abbreviation as nomClasse, emploi_teachers.semestre as semestre FROM classes INNER JOIN teachers INNER JOIN emploi_teachers WHERE classes.id = emploi_teachers.classe_id AND teachers.id = emploi_teachers.teacher_id AND emploi_teachers.teacher_id = ?', [$id]);
        return $sql;
    }

    //Get all matieres from idTeacher
    public function getAllMatieresFromIdTeacher($id)
    {
        $sql = DB::select('SELECT DISTINCT matieres.id as idMatiere, matieres.subjectLabel as nomMatiere, matieres.description as typeMatiere, matieres.volume as volumeMatiere, matieres.nbr_eliminatoire as nbrEliminatoireMatiere, matieres.semestre as semestre  FROM matieres INNER JOIN teachers INNER JOIN emploi_teachers WHERE matieres.id = emploi_teachers.matiere_id AND teachers.id = emploi_teachers.teacher_id AND emploi_teachers.teacher_id = ?', [$id]);
        return $sql;
    }

    public function getAllCours()
    {
        $response = Cours::orderBy("created_at", "DESC")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllCoursWithClasse()
    {
        $response = Cours::with('classe')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllCoursWithTeacherId($id)
    {
        $response = Teacher::with('coursteachers', 'profileTeacher')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllClassesFromLevelId($level)
    {
        $response = Level::with('classes')->where("id", "=", $level)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllLevels()
    {
        $response = Level::orderBy("created_at", "ASC")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getCoursbyclasse($id)
    {
       $sql = DB::select('SELECT cours.nom as nomCours, teachers.full_name as enseignant, cours.fichier as fichier, cours_classes.created_at as created_at FROM `cours_classes`, cours, classes,teachers WHERE `cours_classes`.`cours_id` = cours.id and `cours_classes`.`classe_id` = classes.id and `cours`.`teacher_id` = teachers.id and classes.id = ?', [$id]);
       return $sql;
    }

    // public function getCoursesFromTeacher($id)
    // {
    //     $response = Cours::with('user')->where("user_id", "=", $id)->get();
    //     $data = json_decode($response);
    //     return $data;
    // }

    // public function getAllCourses()
    // {
    //     $response = User::with('cours')->get();
    //     $data = json_decode($response);
    //     return $data;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Service Convert PDF
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/cours/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);

        $now = new \DateTime();
        $created_at = $now->format('Y-m-d H:i:s');

        $cours_classe_id = Cours::insertGetId([
        'nom'         => $request->input('nom'),
        'teacher_id'  => $request->input('teacher_id'),
        'fichier'     => $nameFile,
        'created_at'  => $created_at,
        'updated_at'  => $created_at,
        ]);

        $ID_Classe = $request->classe_id;
        foreach ($ID_Classe as $key => $insert) {
            $datasave = [
                'cours_id'   => $cours_classe_id,
                'classe_id'  => $ID_Classe[$key],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
            DB::table('cours_classes')->insert($datasave);
        }

        //Notification Attendance Students
        $IDin = '(\'' . implode('\',\'', $ID_Classe) .'\')';
        $resultIDonesignal = [];
        //$sqlNotif   = DB::select('select api_onesignal from students_onesignal where student_id in '.$IDin);
        $sqlNotif = DB::select('select students_onesignal.api_onesignal from students_onesignal inner join students where students_onesignal.student_id = students.id and students.classe_id in '.$IDin);
        $sqlMsg   = DB::select('select cours.nom as cours, teachers.full_name as teacher from cours inner join teachers where cours.teacher_id = teachers.id and cours.id = ?', [$cours_classe_id]);
        $sqlTitre = DB::select('select label from notifmodels where id = 9');
        //Fill apiOneSignal by id student
        foreach ($sqlNotif as $key => $value) {
            if ($value->api_onesignal) {
                array_push($resultIDonesignal, $value->api_onesignal);
            }
        }
        
        //Message of notification
        $message = $sqlMsg[0]->cours." : ".$sqlMsg[0]->teacher; 
        //Structure notification
        $fields['include_player_ids'] = $resultIDonesignal;
        $fields['contents']           = array("en" => $message);
        $fields['headings']           = array("en" => $sqlTitre[0]->label);
        //Send notification
        OneSignal::sendPush($fields);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function show(Cours $cours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function edit(Cours $cours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cours = Cours::find($id);

        if ($request->fichier = $cours->fichier) {
            $cours->nom        = $request->input('nom');
            $cours->classe_id  = $request->input('classe_id');
            $cours->teacher_id = $request->input('teacher_id');

            $cours->update();
        }
        elseif ($request->fichier != $cours->fichier) {
            //Service Convert PDF
            $dataFile = base64_decode($request->fichier); //decode base64 string
            $nameFile = time().".pdf";
            $file     = "upload/cours/".$nameFile;
            $moveFile = file_put_contents($file, $dataFile);

            $cours->nom        = $request->input('nom');
            $cours->classe_id  = $request->input('classe_id');
            $cours->teacher_id = $request->input('teacher_id');
            $cours->fichier    = $nameFile;

            $cours->update();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cours  $cours
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Cours::destroy($id);
    }
}
