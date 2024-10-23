<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Ladumor\OneSignal\OneSignal;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAllNotes()
    {
        $response = Note::with('classe')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllNotesByClasse($id)
    {
        $response = Note::with('classe')->where("classe_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getNoteById($id)
    {
        $response = Note::with('classe')->where("id", "=", $id)->get();
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
        $extImage  = $request->extensionFile;
        $dataFile  = base64_decode($request->fichier); //decode base64 string
        $nameFile  = time().".$extImage";
        $file      = "upload/notes/".$nameFile;
        $moveFile  = file_put_contents($file, $dataFile);

        $emploi = new Note;
        $emploi->titre     = $request->input('titre');
        $emploi->annee     = $request->input('annee');
        $emploi->semestre  = $request->input('semestre');
        $emploi->type      = $request->input('type');
        $emploi->session   = $request->input('session');
        $emploi->fichier   = $nameFile;
        $emploi->classe_id = $request->input('classe_id');
        $emploi->save();

        //Notification Attendance Students
        $sqlNotif = DB::select('select students_onesignal.api_onesignal from students_onesignal inner join students where students_onesignal.student_id = students.id and students.classe_id = ? ',[$emploi->classe_id]);
        $sqlTitre = DB::select('select label from notifmodels where id = 1');
        
        //Fill apiOneSignal by id student
        $resultIDonesignal = [];
        foreach ($sqlNotif as $key => $value) {
            if ($value->api_onesignal) {
                array_push($resultIDonesignal, $value->api_onesignal);
            }
        }

        //Message of notification
        $message = $emploi->titre." : ".$emploi->type." ".$emploi->session." ".$emploi->semestre; 

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
        $emploi = Note::find($id);
       
        $emploi->titre     = $request->input('titre');
        $emploi->annee     = $request->input('annee');
        $emploi->semestre  = $request->input('semestre');
        $emploi->type      = $request->input('type');
        $emploi->session   = $request->input('session');
        $emploi->classe_id = $request->input('classe_id');

        $emploi->update(); 
    }

    public function updatePDFnotes(Request $request, $id)
    {
        $emploi = Note::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/notes/'.$emploi->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile  = time().".$extFile";
            $file      = "upload/notes/".$nameFile;
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
        return Note::destroy($id);
    }
}
