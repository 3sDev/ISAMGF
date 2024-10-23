<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Departements;
use App\Models\Section;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        
        // Sent and Receiver Service
        $response4          = Http::get($this->getUrlServer().'/messages-sent-service/'.$idAdmin);
        $msgSendService = json_decode($response4);
        
        $response3      = Http::get($this->getUrlServer().'/messages-recieved-service/'.$idAdmin);
        $msgReceivedService = json_decode($response3); 

        // Count Msgs From Student
        $response5         = Http::get($this->getUrlServer().'/count-msg-view-student');
        $countMsgStudent = json_decode($response5);

        // Count Msgs From Service
        $response6        = Http::get($this->getUrlServer().'/count-msg-view-service');
        $countMsgService = json_decode($response6);

        return view('message.index', ['msgs' => $msgs, 'msgSend' => $msgSend,
        'msgReceivedService' => $msgReceivedService, 'msgSendService' => $msgSendService,
        'countMsgStudent' => $countMsgStudent, 'countMsgService' => $countMsgService]);
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
        $departements = Departements::all();
        $classes = Classe::all();
        $levels = Level::all();

        $lvls = DB::table("levels")->pluck("levelLabel", "id");
        $cls = DB::table("classes")->pluck("classeName", "id");
        $users = User::all();

        return view('message.create', ['levels' => $levels, 'classes' => $classes, 'departements' => $departements
        , 'lvls' => $lvls, 'cls' => $cls, 'users' => $users]);
        //return view('student.create');
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
        $myFile64    = $this->convertFile($file);
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

           return  $response ;
        return redirect('/message');
    }

    public function storeService(Request $request)
    {
        $idAdmin     = Auth::user()->id;
        $roleAdmin   = Auth::user()->role;
    
        $file        = $request->fichier;
        $myFile64    = $this->convertAllFile($file);
        $myExtFile64 = $this->getExtensionFile($file);
    
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

    public function showService($id)
    {
       
        $response = Http::put($this->getUrlServer().'/update-view-service/'.$id, [
            'statut' => 'true',
        ]);

        $response2 = Http::get($this->getUrlServer().'/messages-service-details/'.$id);
        $message = json_decode($response2);

        return view('message.showService', ['message' => $message]);
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
