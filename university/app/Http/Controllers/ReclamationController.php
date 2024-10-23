<?php

namespace App\Http\Controllers;

use App\Models\Reclamation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ladumor\OneSignal\OneSignal;

class ReclamationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
         $response = Student::with('reclamations')->where("id", "=", $id)->get();
         $data = json_decode($response);
         return $data;
    }

    public function getAllReclams()
    {
        $response = Reclamation::with('student', 'classe')->orderBy('created_at', 'DESC')->get();
        $data = json_decode($response);
        return $data;

    }

    public function getAllReclamsFromSqlDB()
    {
        $sql = DB::select('SELECT r.id as idReclamation, r.description as descriptionReclamation, r.post_image as fileReclamation, r.statut as statutReclamation, r.reponse as reponseReclamation, r.created_at as dateCreationReclamation, r.updated_at as dateUpdateReclamation, s.id as idStudent, s.cin as cinStudent, s.full_name as fullNameStudent, s.email as emailStudent, s.tel1_etudiant as telStudent, s.profile_image as photoStudent, c.id as idClasse, c.abbreviation as classeStudent FROM reclamations r INNER JOIN students s INNER JOIN classes c WHERE r.student_id = s.id AND s.classe_id = c.id');
        return $sql;

    }
    
    public function getReclamWithStudent($id)
    {
        $response = Reclamation::with('student')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getReclamWithStudentFromSqlD($id)
    {
        $data = DB::select('SELECT r.id as idReclamation, r.description as descriptionReclamation, r.post_image as fileReclamation, r.statut as statutReclamation, r.reponse as reponseReclamation, r.created_at as dateCreationReclamation, r.updated_at as dateUpdateReclamation, s.id as idStudent, s.cin as cinStudent, s.full_name as fullNameStudent, s.email as emailStudent, s.tel1_etudiant as telStudent, s.profile_image as photoStudent, c.id as idClasse, c.abbreviation as classeStudent FROM reclamations r INNER JOIN students s INNER JOIN classes c WHERE r.student_id = s.id AND s.classe_id = c.id AND r.id = ?', [$id]);
        return $data;
    }

    public function getReclamWithStudentFilter($id, $statut)
    {
        $response = Reclamation::with('student')->where("student_id", "=", $id)->where("statut", "=", $statut)->get();
        $data = json_decode($response);
        return $data;
    }

    //count
    public function getCountReclamationsStudentsByStatut($statut)
    {
        $response = Reclamation::where("statut", "=", $statut)->count();
        $data = json_decode($response);
        return $data;
    }
    public function countAllReclamationsStudents()
    {
        $response = Reclamation::count();
        $data = json_decode($response);
        return $data;
    }

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
        // $request->validate([
        //     'description' => 'required',
        //     'statut' => 'required'
        // ]);

         //Service Convert Image
         $extImage  = $request->extensionImg;
         $dataImage = base64_decode($request->post_image); //decode base64 string
         $nameImage = time().".$extImage";
         $file      = "upload/reclamations/".$nameImage;
         $moveImage = file_put_contents($file, $dataImage);

        $reclamation = new Reclamation;
        $reclamation->description = $request->input('description');
        $reclamation->post_image = $nameImage;
        $reclamation->statut = 'En cours';
        $reclamation->student_id = $request->input('student_id');

        $reclamation->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function show(Reclamation $reclamation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reclamation $reclamation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reclamationStudent=Reclamation::find($id);
        $reclamationStudent->statut  = $request->input('statut');
        $reclamationStudent->reponse = $request->input('reponse');
        $reclamationStudent->update($request->all());

        $idStudent   = $reclamationStudent->student_id;
        $typeReclam  = $reclamationStudent->description;
        $idReclam    = $reclamationStudent->id;

        //Get one signal id from id student
        $sqlNotif   = DB::select('select api_onesignal from students_onesignal where student_id = '.$idStudent);
        $sqlTitre   = DB::select('select label from notifmodels where id = 6');

        //Fill apiOneSignal by id student
        $resultIDonesignal = [];
        foreach ($sqlNotif as $key => $value) {
            if ($value->api_onesignal) {
                array_push($resultIDonesignal, $value->api_onesignal);
            }
        }

        //Message of notification
        $message = $typeReclam; 

        //Structure notification
        $fields['include_player_ids'] = $resultIDonesignal;
        $fields['contents']           = array("en" => $message);
        $fields['headings']           = array("en" => $sqlTitre[0]->label);

        //Send notification
        OneSignal::sendPush($fields);
         //Send notification to database
         $sendReqToDb = DB::insert('insert into notification_students (consulted, readed, notifmodel_id, idInfo, student_id) values (0, 0, 6, ?, ?)', [$idReclam, $idStudent]);
         return $sendReqToDb;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reclamation  $reclamation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Reclamation::destroy($id);
    }
}
