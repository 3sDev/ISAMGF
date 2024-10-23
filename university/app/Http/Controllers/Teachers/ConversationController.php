<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
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

    public function allRoomsWithTeachers()
    {
        $response = Conversation::with('teacher')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getRoomsByIdTeacher($idTeacher)
    {
        $sql = DB::select('SELECT DISTINCT teachers.id as idTeacher, teachers.nom as nomTeacher, teachers.prenom as prenomTeacher, teachers.profile_image as photoTeacher, conversation_teachers.conversation_id as conversationID FROM conversation_teachers INNER JOIN teachers ON teachers.id = conversation_teachers.teacher_id_sender OR (teachers.id = conversation_teachers.teacher_id_receiver) WHERE (conversation_teachers.teacher_id_sender = '.$idTeacher.' OR conversation_teachers.teacher_id_receiver = '.$idTeacher.') AND teachers.id <> '.$idTeacher.'');
        return $sql;
    }

    public function getMessagesByRoomIdFromTeacher($idConversation)
    {
        $response = ConversationTeacher::where('conversation_id', '=', $idConversation)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getMaxIdMessageFromRoomWithTeacher($idTeacher)
    {
        $sql = DB::select('
        SELECT DISTINCT teachers.id as idTeacher, teachers.nom as nomTeacher, teachers.prenom as prenomTeacher, teachers.profile_image as photoTeacher, conversation_teachers.conversation_id as conversationID FROM conversation_teachers INNER JOIN teachers ON teachers.id = conversation_teachers.teacher_id_sender OR (teachers.id = conversation_teachers.teacher_id_receiver) WHERE (conversation_teachers.teacher_id_sender = '.$idTeacher.' OR conversation_teachers.teacher_id_receiver = '.$idTeacher.') AND teachers.id <> '.$idTeacher.'');
        
        print_r($sql);
        //$id_room = $sql[1]->roomID;
        
        //return $id_room;
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
    public function storeConversation(Request $request)
    {
        $conversation        = new Conversation;
        $conversation->label = $request->input('label');
        $conversation->vue   = $request->input('vue');
       
        $conversation->save();
    }

    public function storeMessageTeacher(Request $request)
    {
        $dateNow         = new \DateTime();
        $created_at      = $dateNow->format('Y-m-d H:i:s');
        $teacherSender   = $request->input('teacher_id_sender');
        $teacherReceiver = $request->input('teacher_id_receiver');

        $sql = DB::select('SELECT * FROM conversation_teachers WHERE (teacher_id_sender = '.$teacherSender.' AND 
        teacher_id_receiver = '.$teacherReceiver.') OR (teacher_id_sender = '.$teacherReceiver.' AND 
        teacher_id_receiver = '.$teacherSender.')');
        
        if ($sql == []) {
            $conversation_teachers_id = Conversation::insertGetId([
                'label'      => 'Conversation_'.$teacherSender.'_'.$teacherReceiver,
                'vue'        => '0',
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
    
            $datasave = [
                'conversation_id'     => $conversation_teachers_id,
                'teacher_id_sender'   => $teacherSender,
                'teacher_id_receiver' => $teacherReceiver,
                'message'             => $request->input('message'),
                'vue'                 => '0',
                'archive'             => '0',
                'created_at'          => $created_at,
                'updated_at'          => $created_at,
            ];
            DB::table('conversation_teachers')->insert($datasave);
        }
        else {
            //return print_r($sql);
            $id_conversation = $sql[0]->conversation_id;
            $datasave = [
                'conversation_id'     => $id_conversation,
                'teacher_id_sender'   => $teacherSender,
                'teacher_id_receiver' => $teacherReceiver,
                'message'             => $request->input('message'),
                'vue'                 => '0',
                'archive'             => '0',
                'created_at'          => $created_at,
                'updated_at'          => $created_at,
            ];
            DB::table('conversation_teachers')->insert($datasave);
        }
    }

    public function storeMessageRechercheTeacher(Request $request, $sender, $receiver)
    {
        $dateNow         = new \DateTime();
        $created_at      = $dateNow->format('Y-m-d H:i:s');
        $teacherSender   = $sender;
        $teacherReceiver = $receiver;

        $sql = DB::select('SELECT * FROM conversations WHERE (label LIKE "Conversation_'.$teacherSender.'_'.$teacherReceiver.'" OR 
        label LIKE "Conversation_'.$teacherReceiver.'_'.$teacherSender.'")');
        
        return $sql;
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
        //
    }
}
