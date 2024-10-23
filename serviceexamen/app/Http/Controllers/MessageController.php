<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Departements;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use Services\MyTrait;
    use Services\ConvertBase64;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //private $urlServer = "http://smartschools.tn/university/public/api";

    public function index()
    {
        $idAdmin  = Auth::user()->id;

        // Sent and Receiver Student
        $response = Http::get($this->getUrlServer().'/messages-admin/'.$idAdmin);
        $msgs     = json_decode($response);  
        
        $response2 = Http::get($this->getUrlServer().'/messages-student-admin/'.$idAdmin);
        $msgSend   = json_decode($response2); 
        
        $response4          = Http::get($this->getUrlServer().'/messages-sent-service/'.$idAdmin);
        $msgSendService     = json_decode($response4);
        
        $response3          = Http::get($this->getUrlServer().'/messages-recieved-service/'.$idAdmin);
        $msgReceivedService = json_decode($response3); 

        // Count
        $response4  = Http::get($this->getUrlServer().'/coutAllMessagesSend/'.$idAdmin);
        $allMsgSend = json_decode($response4);

        $response5     = Http::get($this->getUrlServer().'/coutAllMessagesReceive/'.$idAdmin);
        $allMsgReceive = json_decode($response5);

        // Count Msgs From Service Not views
        $response6        = Http::get($this->getUrlServer().'/coutAllMessagesReceiveNotView/'.$idAdmin);
        $countMsgNotView = json_decode($response6);

        // get all messages from corbeil
        $response7        = Http::get($this->getUrlServer().'/getAllCorbeilMessage/'.$idAdmin);
        $cacherMessage    = json_decode($response7);
        
        return view('message.index', ['msgs' => $msgs, 'msgSend' => $msgSend,'msgReceivedService' => $msgReceivedService, 
        'msgSendService' => $msgSendService, 'countMsgNotView' => $countMsgNotView, 'allMsgSend' => $allMsgSend, 
        'allMsgReceive' => $allMsgReceive, 'cacherMessage' => $cacherMessage , 'idAdmin' => $idAdmin ]);
    }

    public function indicateur()
    {
       // return view('message.index', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idAdmin  = Auth::user()->id;
        $users = User::all();
        //$users = DB::select('select * from users v where not exists (select * from  message_services e where e.user_sender_id = 7 or e.user_receiver_id = 7)');

        return view('message.create', ['users' => $users]);
        //return view('student.create');
    }

    public function replayMessage($idUser, $nameUser, $roleUser)
    {
        $idAdmin  = Auth::user()->id;
        $IDUSER   = $idUser;
        $NAMEUSER = $nameUser;
        $ROLEUSER = $roleUser;

        return view('message.replay', ['IDUSER' => $IDUSER, 'NAMEUSER' => $NAMEUSER, 'ROLEUSER' => $ROLEUSER]);
    }

    public function getStudent(Request $request)
    {
        $states = DB::table("students")
            ->where("classe_id", $request->classe_id) //->where("classe_id", 1)
            ->pluck("full_name", "id");
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
        $idAdmin  = Auth::user()->id;

        $file        = $request->fichier;
        //return $file;
        $myFile64    = $this->convertAllFile($file);
        $myExtFile64 = $this->getExtensionFile($file);

        $response = Http::post($this->getUrlServer().'/message', [
            'objet'         => $request->input('objet'),
            'message'       => $request->input('message'),
            'source'        => 'admin',
            'destination'   => 'app',
            'statut'        => 'false',
            'fichier'       => $myFile64,
            'extensionFile' => $myExtFile64,
            'student_id'    => $request->input('student_id'),
            'user_id'       => $idAdmin,            
           ]);

        return redirect('/message');
    }

    public function storeService(Request $request)
    {
        $idAdmin     = Auth::user()->id;
        $roleAdmin   = Auth::user()->role;
    
        if ($request->fichier != '') {

            $file        = $request->fichier;
            $myFile64    = $this->convertAllFile($file);
            $myExtFile64 = $this->getExtensionFile($file);
        }
        else { 
            $myFile64 = '';
            $myExtFile64    = '';
        }
    
        $response = Http::post($this->getUrlServer().'/message-service', [
            'objet'            => $request->input('objet'),
            'message'          => $request->input('message'),
            'source'           => $roleAdmin,
            'statut'           => 'false',
            'fichier'          => $myFile64,
            'extensionFile'    => $myExtFile64,
            'user_sender_id'   => $idAdmin,
            'user_receiver_id' => $request->input('user_receiver_id'),
           ]);
    
        return redirect('/message');
    }

    public function storeServiceMultipleUsers(Request $request)
    {
        $idAdmin     = Auth::user()->id;
        $roleAdmin   = Auth::user()->role;
    
        if ($request->fichier != '') {

            $file        = $request->fichier;
            $myFile64    = $this->convertAllFile($file);
            $myExtFile64 = $this->getExtensionFile($file);
        }
        else { 
            $myFile64 = '';
            $myExtFile64    = '';
        }
    
        $response = Http::post($this->getUrlServer().'/message-multiple-users', [
            'objet'            => $request->input('objet'),
            'message'          => $request->input('message'),
            'source'           => $roleAdmin,
            'fichier'          => $myFile64,
            'extensionFile'    => $myExtFile64,
            'user_sender_id'   => $idAdmin,
            'user_receiver_id' => $request->input('user_receiver_id'),
        ]);
        error_log('---------------------------------------------------------'.$response);
        return redirect('/message');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::put($this->getUrlServer().'/update-view-student/'.$id, [
            'statut' => 'true',
        ]);

        $response2 = Http::get($this->getUrlServer().'/messages-admin-details/'.$id);
        $message = json_decode($response2);

        return view('message.show', ['message' => $message]);
    }

    public function showService($id, $idMessageUser)
    {
        $idAdmin  = Auth::user()->id;

        $response1 = Http::get($this->getUrlServer().'/messages-service-details/'.$id);
        $message = json_decode($response1);

        return $response1;
        $response2 = Http::put($this->getUrlServer().'/update-view-service/'.$idMessageUser, [
            'statut' => 'true',
        ]);

        return view('message.show', ['message' => $message, 'idAdmin' => $idAdmin]);
    }

    public function showServiceSend($message,)
    {
        $idAdmin  = Auth::user()->id;
        $response1 = Http::get($this->getUrlServer().'/message-send-details/'.$message.'/'.$idAdmin);
        $message = json_decode($response1);
        return view('message.show-e', ['message' => $message, 'idAdmin' => $idAdmin]);
    }

    public function showServiceReceive($message, $idMessageUser)
    {
        $idAdmin  = Auth::user()->id;
        $response1 = Http::get($this->getUrlServer().'/message-receive-details/'.$message.'/'.$idAdmin);
        $message = json_decode($response1);

        // return $response1;
        $response2 = Http::put($this->getUrlServer().'/update-view-service/'.$idMessageUser, [
            'statut' => 'true',
        ]);

        return view('message.show', ['message' => $message, 'idAdmin' => $idAdmin]);
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

    public function corbeilMessage($id)
    {
        $response = Http::put($this->getUrlServer().'/corbeil-message/'.$id);
        return redirect()->back(); 
    }
    
    public function restaurerMessage($id)
    {
        $response = Http::put($this->getUrlServer().'/restaurer-message/'.$id);
        return redirect()->back(); 
    }

    public function deleteMessage($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-message-service/'.$id);
        return redirect()->back(); 
    }
}
