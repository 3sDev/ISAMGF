<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\NoteProfessionnel;
use Illuminate\Http\Request;

class NoteProfessionnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = NoteProfessionnel::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllNotesProfessionnelles()
    {
        $response = NoteProfessionnel::all();
        $data = json_decode($response);
        return $data;
    }
    
    public function getAllNotesWithPersonnels()
    {
        $response = NoteProfessionnel::with('personnel')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllNotesWithPersonnelByIdPersonnel($id)
    {
        $response = NoteProfessionnel::with("personnel")->where("personnel_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getNoteWithPersonnelByIdNote($id)
    {
        $response = NoteProfessionnel::with("personnel")->where("id", "=", $id)->get();
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
        $download = new NoteProfessionnel;
        $download->annee  = $request->input('annee');
        $download->note1  = $request->input('note1');
        $download->note2  = $request->input('note2');
        $download->note3  = $request->input('note3');
        $download->note4  = $request->input('note4');
        $download->note5  = $request->input('note5');
        $download->observation  = $request->input('observation');
        $download->personnel_id = $request->input('personnel_id');

        $download->save();
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
        $notes=NoteProfessionnel::find($id);
        $notes->annee        = $request->input('annee');
        $notes->note1        = $request->input('note1');
        $notes->note2        = $request->input('note2');
        $notes->note3        = $request->input('note3');
        $notes->note4        = $request->input('note4');
        $notes->note5        = $request->input('note5');
        $notes->observation  = $request->input('observation');
        $notes->personnel_id = $request->input('personnel_id');

        $notes->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return NoteProfessionnel::destroy($id);
    }
}
