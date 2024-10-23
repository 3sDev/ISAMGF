<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageService;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Message::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllMessage()
    {
        $response = Message::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllMessagesFromAdmin()
    {
        $response = User::with('messages')->get();
        $data = json_decode($response);
       	return $data;
    }

    //Messages recus admin - étudiant
    public function getAllMessagesFromAdminWithIdAdmin($id)
    {
        $response = Message::with('student', 'messages')->where("user_id", "=", $id)
        ->where("source", "=", "app")->orderBy('created_at', 'ASC')->get();
        $data = json_decode($response);
       	return $data;
    }

    //Messages recus étudiant - admin
    public function getAllMessagesFromStudentWithIdStudent($id)
    {
        $response = Message::with('student')->where("user_id", "=", $id)
        ->where("source", "=", "admin")->orderBy('created_at', 'ASC')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getMessageFromStudent($id)
    {
        $response = Message::with('student')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getMessageFromStudentWithIdUser($id)
    {
        $response = User::with('messages')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getMsgNotViewStudent()
    {
        $countMsgStudent = Message::where('statut','=','false')->where("source", "=", "app")->count();
        $data = json_decode($countMsgStudent);
       	return $data;
    }

    public function getMsgNotViewService()
    {
        $countMsgStudent = MessageService::where('statut','=','false')->where("source", "!=", "Service scolarité")->count();
        $data = json_decode($countMsgStudent);
       	return $data;
    }
    
    public function changeStatutStudent(Request $request, $id)
    {
        $msg = Message::find($id);
        $msg->statut = $request->input('statut');

        $msg->update();
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
         //Service Convert File
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/messages/students/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);

        $now = new \DateTime();
        $created_at = $now->format('Y-m-d H:i:s');

        $message_personnel_student_id = Message::insertGetId([
            'objet'       => $request->input('objet'),
            'message'     => $request->input('message'),
            'source'      => $request->input('source'),
            'destination' => $request->input('destination'),
            'statut'      => $request->input('statut'),
            'fichier'     => $nameFile,
            'user_id'     => $request->input('user_id'),
            'created_at'  => $created_at,
            'updated_at'  => $created_at,
        ]);

        $ID_User    = $request->user_id;
        $ID_Student = $request->student_id;
        foreach ($ID_Student as $key => $insert) {
            $datasave = [
                'message_id' => $message_personnel_student_id,
                'user_id'    => $ID_User,
                'student_id' => $ID_Student[$key],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
            DB::table('message_personnel_students')->insert($datasave);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Message::destroy($id); 
    }
}
