<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\User;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Agenda::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllAgenda()
    {
        $response = Agenda::all();
        $data = json_decode($response);
        return $data;
    }
    
    public function getAgendaWithUser()
    {
        $response = User::with('agendas')->get();
        $data = json_decode($response);
        return $data;
    }

    // public function getAgendaWithIDUser($id)
    // {
    //     $response = User::with('agendas')->where("id", "=", $id)->get();
    //     $data = json_decode($response);
    //     return $data;
    // }
    
    public function getAgendaWithIDUser($id)
    {
        $response = Agenda::where("user_id", "=", $id)->orderBy('created_at', 'DESC')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAgendaWithIDUserAndLimit($id)
    {
        $dateNow = now();
        $response = Agenda::where("user_id", "=", $id)->orderBy('date_rappel', 'ASC')
        ->where("date_rappel", ">", $dateNow)->limit(5)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllNotesByIdAdmin($id)
    {
        $response = Agenda::where("user_id", "=", $id)->orderBy('date_rappel', 'ASC')->get();
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
        //Service Convert File
        if ($request->extensionFile != '') {
        
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/agenda/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $agenda = new Agenda;
        $agenda->titre       = $request->input('titre');
        $agenda->description = $request->input('description');
        $agenda->date_rappel = $request->input('date_rappel');
        $agenda->fichier     = $nameFile;
        $agenda->user_id     = $request->input('user_id');

        $agenda->save();
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
        $agenda = Agenda::find($id);
        $agenda->titre       = $request->input('titre');
        $agenda->description = $request->input('description');
        $agenda->date_rappel = $request->input('date_rappel');

        $agenda->update();
    }

    public function updateFileAgenda(Request $request, $id)
    {
        $agenda = Agenda::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/agenda/'.$agenda->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile4 = time().".$extFile";
            $file      = "upload/agenda/".$nameFile4;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile4 = $agenda->fichier; }
        $agenda->fichier = $nameFile4;
        $agenda->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Agenda::destroy($id);
    }
}
