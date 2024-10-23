<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageService;
use App\Models\MessageServiceUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = MessageService::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllMessage()
    {
        $response = MessageService::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllMessagesFromAdminTableMsgService()
    {
        $response = User::with('messages')->get();
        $data = json_decode($response);
       	return $data;
    }

    //Messages envoyés
    public function getAllMsgSentToService($id)
    {
        $response = DB::select('SELECT ms.id, ms.objet, ms.message, ms.created_at, msu.id  as idMessageUser 
        FROM message_services ms INNER JOIN message_service_users msu INNER JOIN users u WHERE ms.id = msu.message_services_id 
        AND msu.user_receiver_id = u.id AND msu.deleted = "0" AND msu.user_sender_id = ? 
        AND msu.user_receiver_id = msu.user_sender_id', [$id]);

        return $response;
    }

    //Messages reçus
    public function getAllMsgRecievedFromService($id)
    {
        $response = DB::select('SELECT distinct(ms.id), ms.objet, ms.message, ms.created_at, msu.statut, 
        (SELECT name FROM users WHERE users.id = msu.user_sender_id) as nameSender, msu.id as idMessageUser 
        FROM message_services ms INNER JOIN message_service_users msu INNER JOIN users u WHERE ms.id = msu.message_services_id 
        AND msu.user_sender_id = u.id AND msu.user_sender_id != msu.user_receiver_id AND msu.deleted = "0" 
        AND msu.user_receiver_id = ?', [$id]);

        return $response;
    }

    public function getMessageFromService($id)
    {
        $response = MessageService::with('users')->orderBy('created_at', 'desc')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function messageSendDetails($message, $sender)
    {
        $response = DB::select('SELECT ms.id, ms.objet, ms.message, ms.fichier, ms.created_at, msu.user_sender_id, msu.user_receiver_id, 
        msu.id as idMessageUser, (SELECT name FROM users WHERE users.id = msu.user_receiver_id) as nameReceiver, 
        (SELECT role FROM users WHERE users.id = msu.user_receiver_id) as roleReceiver FROM message_services ms 
        INNER JOIN message_service_users msu INNER JOIN users u WHERE ms.id = msu.message_services_id 
        AND msu.user_sender_id = u.id AND msu.user_receiver_id != ? AND msu.user_sender_id = ? AND ms.id = ?', [$sender, $sender, $message]);

        return $response;
    }

    public function messageReceiveDetails($message, $sender)
    {
        $response = DB::select('SELECT ms.id, ms.objet, ms.message, ms.fichier, ms.created_at, msu.user_sender_id, msu.user_receiver_id, 
        msu.id as idMessageUser, (SELECT name FROM users WHERE users.id = msu.user_sender_id) as nameSender, 
        (SELECT role FROM users WHERE users.id = msu.user_sender_id) as roleSender FROM message_services ms 
        INNER JOIN message_service_users msu INNER JOIN users u WHERE ms.id = msu.message_services_id 
        AND msu.user_sender_id = u.id AND msu.user_receiver_id = ? AND msu.user_sender_id != ? AND ms.id = ?', [$sender, $sender, $message]);

        return $response;
    }

    //count messages envoyés
    public function coutAllMessagesSend($id)
    {
        $response = DB::select('SELECT COUNT(ms.id) as countMsgs FROM message_services ms INNER JOIN message_service_users msu 
        INNER JOIN users u WHERE ms.id = msu.message_services_id AND msu.user_sender_id = u.id AND msu.user_sender_id = msu.user_receiver_id 
        AND msu.deleted = "0" AND msu.user_receiver_id = ?', [$id]);
        return $response[0]->countMsgs;
    }

    //count messages reçus
    public function coutAllMessagesReceive($id)
    {
        $response = DB::select('SELECT COUNT(ms.id) as countMsgs FROM message_services ms INNER JOIN message_service_users msu 
        INNER JOIN users u WHERE ms.id = msu.message_services_id AND msu.user_sender_id = u.id AND msu.user_sender_id != msu.user_receiver_id 
        AND msu.deleted = "0" AND msu.user_receiver_id = ?', [$id]);
        return $response[0]->countMsgs;
    }

    //count
    public function coutAllMessagesReceiveNotView($id)
    {
        $response = DB::select('SELECT COUNT(ms.id) as countMsgs FROM message_services ms INNER JOIN message_service_users msu 
        INNER JOIN users u WHERE ms.id = msu.message_services_id AND msu.user_sender_id = u.id AND msu.user_sender_id != msu.user_receiver_id 
        AND msu.deleted = "0" AND msu.user_receiver_id = ? AND msu.statut = "false"', [$id]);
        return $response[0]->countMsgs;
    }

    //change Statut of message
    public function changeStatutService(Request $request, $id)
    {
        $msg = MessageServiceUser::find($id);
        $msg->statut = $request->input('statut');
        $msg->update();
    }

    //afficher les messages dans une corbeil
    public function getAllCorbeilMessage($id)
    {
        //$response = MessageService::with('user')->where("user.deleted", "=", 1)->where("user.user_receiver_id", "=", $id)->orWhere("user.user_sender_id", "=", $id)
        $response = DB::select('SELECT ms.id, ms.objet, ms.message, ms.created_at, msu.user_sender_id, msu.user_receiver_id, msu.id as idMessageUser 
        FROM message_services ms INNER JOIN message_service_users msu INNER JOIN users u WHERE ms.id = msu.message_services_id 
        AND msu.user_sender_id = u.id and msu.deleted = "1" and (msu.user_receiver_id = ? or msu.user_sender_id = ?)', [$id, $id]);
        
        return $response;
    }


    public function getMessagesWithUsersByIdMessage($id)
    {
        //$response = MessageService::with('user')->where("user.deleted", "=", 1)->where("user.user_receiver_id", "=", $id)->orWhere("user.user_sender_id", "=", $id)
        $response = MessageService::with('users')->where('id', '=', $id)->orderBy('created_at', 'DESC')->get();
        $data = json_decode($response);
        return $data;
    }

    public function changeStatutStudent(Request $request, $id)
    {
        $msg = MessageService::find($id);
        $msg->statut = $request->input('statut');

        $msg->update();
    }

    //Messages recus étudiant - admin
    // public function getAllMessagesFromStudentWithIdStudent($id)
    // {
    //     $response = MessageService::with('student')->where("user_id", "=", $id)
    //     ->where("source", "=", "admin")->orderBy('created_at', 'ASC')->get();
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
        //Service Convert File
        if ($request->extensionFile != '') {
        
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/messages/services/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $msg                   = new MessageService();
        $msg->objet            = $request->input('objet');
        $msg->message          = $request->input('message');
        $msg->source           = $request->input('source');
        $msg->statut           = $request->input('statut');
        $msg->fichier          = $nameFile;
        $msg->user_sender_id   = $request->input('user_sender_id');
        $msg->user_receiver_id = $request->input('user_receiver_id');

        $msg->save();
    }

    public function storeMultipleUsers(Request $request)
    {
        //Service Convert File
        if ($request->extensionFile != '') {
        
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/messages/services/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $now = new \DateTime();
        $created_at = $now->format('Y-m-d H:i:s');

        $message_user_id = MessageService::insertGetId([
            'objet'       => $request->input('objet'),
            'message'     => $request->input('message'),
            'source'      => $request->input('source'),
            'fichier'     => $nameFile,
            'created_at'  => $created_at,
            'updated_at'  => $created_at,
        ]);

        $ID_SENDER   = $request->user_sender_id;
        $ID_RECEIVER = $request->user_receiver_id;
        foreach ($ID_RECEIVER as $key => $insert) {
            $datasave = [
                'message_services_id' => $message_user_id,
                'user_sender_id'      => $ID_SENDER,
                'user_receiver_id'    => $ID_RECEIVER[$key],
                'statut'              => 'false',
                'deleted'             => '0',
                'created_at'          => $created_at,
                'updated_at'          => $created_at,
            ];
            DB::table('message_service_users')->insert($datasave);
        }
        $myMessage = [
            'message_services_id' => $message_user_id,
            'user_sender_id'      => $ID_SENDER,
            'user_receiver_id'    => $ID_SENDER,
            'statut'              => 'false',
            'deleted'             => '0',
            'created_at'          => $created_at,
            'updated_at'          => $created_at,
        ];
        DB::table('message_service_users')->insert($myMessage);
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
        return MessageService::destroy($id); 
    }

    public function corbeilMessage(Request $request, $id)
    {
        $msg = MessageServiceUser::find($id);
        $msg->deleted = '1';
        $msg->update();
    }

    public function restaurerMessage(Request $request, $id)
    {
        $msg = MessageServiceUser::find($id);
        $msg->deleted = '0';
        $msg->update();
    }
    
    public function deleteMessageService($id)
    {
        return MessageServiceUser::destroy($id); 
    }
}