<?php

namespace App\Http\Controllers\Emploi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\MyTrait;
use App\Http\Controllers\Services\ConvertBase64;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class NoteController extends Controller
{
    use MyTrait;
    use ConvertBase64;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/all-notes');
        $notesStudents = json_decode($response); 
        return view('note_student.index', ['notesStudents' => $notesStudents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$response = Http::get($this->getUrlServer().'/classes');
        //$classes = json_decode($response);
        $classes = DB::select('select * from classes v where not exists (select * from notes e where e.classe_id = v.id)');

        return view('note_student.create', ['classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file        = $request->fichier;
        $myFile64    = $this->convertImage($file);
        $myExtFile64 = $this->getExtensionImage($file);

        $response = Http::post($this->getUrlServer().'/notes', [
            'titre'         => $request->input('titre'),
            'annee'         => $request->input('annee'),
            'semestre'      => $request->input('semestre'),
            'type'          => $request->input('type'),
            'session'       => $request->input('session'),
            'classe_id'     => $request->input('classe_id'),
            'fichier'       => $myFile64,
            'extensionFile' => $myExtFile64,
           ]);
        //return $response;
        return redirect('/notes')->with('message', 'Notes des étudiants sont ajoutées avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/noteByIdNote/'.$id);
        $emplois = json_decode($response);   

        return view('note_student.show', ['emplois' => $emplois]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/classes');
        $classes  = json_decode($response);
        
        $response2 = Http::get($this->getUrlServer().'/noteByIdNote/'.$id);
        $notes     = json_decode($response2);  

        return view('note_student.edit', ['notes' => $notes, 'classes' => $classes]);
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
        $response = Http::put($this->getUrlServer().'/update-note/'.$id, [
            'titre'     => $request->input('titre'),
            'annee'     => $request->input('annee'),
            'semestre'  => $request->input('semestre'),
            'type'      => $request->input('type'),
            'session'   => $request->input('session'),
            'classe_id' => $request->input('classe_id'),
        ]);
        error_log('UpdateInfoNotes--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Notes des étudiants sont modifiées avec succés');
    }

    public function noteFileFn(Request $request, $id)
    {
        $image      = $request->fichier;
        $myImg      = $this->convertImage($image);
        $myExtImg   = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-notesFile/'.$id, [
            'fichier'        => $myImg,
            'extensionFile'  => $myExtImg,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier des notes est modifié avec succés'); 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-note/'.$id);
        return redirect()->back()->with('message', 'Note est supprimée avec succés');
    }
}
