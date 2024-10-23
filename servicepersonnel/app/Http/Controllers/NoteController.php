<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoteController extends Controller
{
    use Services\MyTrait;
    use Services\ConvertBase64;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/getAllNotesWithPersonnels');
        $notes = json_decode($response);   
        return view('note.index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response);  

        return view('note.create', ['personnels' => $personnels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/notes-professionnelles', [
            'annee'        => $request->input('annee'),
            'note1'        => $request->input('note1'),
            'note2'        => $request->input('note2'),
            'note3'        => $request->input('note3'),
            'note4'        => $request->input('note4'),
            'note5'        => $request->input('note5'),
            'observation'  => $request->input('observation'),
            'personnel_id' => $request->input('personnel_id'),
        ]);
        error_log("--------------------------------------".$response);
        return redirect('/notes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response2 = Http::get($this->getUrlServer().'/mission-personnel/'.$id);
        $missions = json_decode($response2); 

        return view('note.show', ['missions' => $missions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response); 

        $response1 = Http::get($this->getUrlServer().'/getNoteWithPersonnelByIdNote/'.$id);
        $notes = json_decode($response1);  

        return view('note.edit', ['notes' => $notes, 'personnels' => $personnels]);
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
        $response = Http::put($this->getUrlServer().'/update-notePro/'.$id, [
            'annee'        => $request->input('annee'),
            'note1'        => $request->input('note1'),
            'note2'        => $request->input('note2'),
            'note3'        => $request->input('note3'),
            'note4'        => $request->input('note4'),
            'note5'        => $request->input('note5'),
            'observation'  => $request->input('observation'),
            'personnel_id' => $request->input('personnel_id'),
        ]);
        return redirect()->back()->with('message', 'Notes est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-notePro/'.$id);
        return redirect()->back()->with('message', 'Note est supprimée avec succés');
    }
}
