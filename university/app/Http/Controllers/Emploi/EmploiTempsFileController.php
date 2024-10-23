<?php

namespace App\Http\Controllers\Emploi;

use App\Http\Controllers\Controller;
use App\Models\EmploiTempsFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Ladumor\OneSignal\OneSignal;

class EmploiTempsFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = EmploiTempsFile::with("classe")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllEmploiTempsStudentByIdClasse($id)
    {
        $response = EmploiTempsFile::with("classe")->where("classe_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllEmploiTempsStudentByIdClasseAndSemestre($id, $semestre)
    {
        $response = EmploiTempsFile::with("classe")->where("classe_id", "=", $id)->where("semestre", "=", $semestre)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllEmploiTempsStudentByIdEmploi($id)
    {
        $response = EmploiTempsFile::with("classe")->where("id", "=", $id)->get();
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
        //Service Convert Image
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->fichier); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/emploi-student-file/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        $emploi = new EmploiTempsFile;
        $emploi->annee_universitaire = $request->input('annee_universitaire');
        $emploi->semestre = $request->input('semestre');
        $emploi->description = $request->input('description');
        $emploi->fichier = $nameImage;
        $emploi->classe_id  = $request->input('classe_id');
        $emploi->save();

        //Notification Attendance Students
        $sqlNotif = DB::select('select students_onesignal.api_onesignal from students_onesignal inner join students where students_onesignal.student_id = students.id and students.classe_id = ? ',[$emploi->classe_id]);
        $sqlTitre = DB::select('select label from notifmodels where id = 8');
        
        //Fill apiOneSignal by id student
        $resultIDonesignal = [];
        foreach ($sqlNotif as $key => $value) {
            if ($value->api_onesignal) {
                array_push($resultIDonesignal, $value->api_onesignal);
            }
        }

        //Message of notification
        $message = "Semestre ".$emploi->semestre; 

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $emploi = EmploiTempsFile::find($id);
        
        $emploi->annee_universitaire = $request->input('annee_universitaire');
        $emploi->semestre            = $request->input('semestre');
        $emploi->description         = $request->input('description');
        $emploi->classe_id           = $request->input('classe_id');
        $emploi->update();   
    }

    public function updatePhotoEmploi(Request $request, $id)
    {
        $emploi = EmploiTempsFile::find($id);
        //Service Convert File
        if ($request->extensionImg != '') {
            File::delete('upload/emploi-student-file/'.$emploi->fichier);
            $extFile   = $request->extensionImg;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile = time().".$extFile";
            $file      = "upload/emploi-student-file/".$nameFile;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile = $emploi->fichier; }
        $emploi->fichier = $nameFile;
        $emploi->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return EmploiTempsFile::destroy($id);
    }
}
