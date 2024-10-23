<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
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
        $idAdmin  = Auth::user()->id;

        $response = Http::get($this->getUrlServer().'/all-agenda-users/'.$idAdmin);
        $agenda = json_decode($response);   
        return view('dashboard', ['agenda' => $agenda]);
    }

    public function liste()
    {
        $idAdmin  = Auth::user()->id;

        $response = Http::get($this->getUrlServer().'/all-agenda-user/'.$idAdmin);
        $agenda = json_decode($response);   
        return view('agenda.index', ['agenda' => $agenda]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->fichier != '') {

            $file        = $request->fichier;
            $myFile64    = $this->convertAllFile($file);
            $myExtFile64 = $this->getExtensionFile($file);
        }
        else { 
            $myFile64 = '';
            $myExtFile64    = '';
        }

        $idAdmin  = Auth::user()->id;

        $response = Http::post($this->getUrlServer().'/agenda', [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'date_rappel'   => $request->input('date_rappel'),
            'fichier'       => $myFile64,
            'extensionFile' => $myExtFile64,
            'user_id'       => $idAdmin,
        ]);
        error_log('------------------------------------------------------------------'.$response);
        return redirect('/agenda')->with('message', 'Votre agenda est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/agenda/'.$id);
        $agenda = json_decode($response);

        return view('agenda.show', ['agenda' => $agenda]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/agenda/'.$id);
        $agenda = json_decode($response);  

        return view('agenda.edit', ['agenda' => $agenda]);
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

        $response = Http::put($this->getUrlServer().'/update-agenda/'.$id, [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'date_rappel'   => $request->input('date_rappel'),
        ]);
        error_log($response);
        return redirect()->back()->with('message', 'Le note est modifié avec succés'); 
    }

    public function updateFileAgenda(Request $request, $id)
    {
        $file         = $request->fichier;
        $myFile64     = $this->convertImage($file);
        $myExtFile64  = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-fileAgenda/'.$id, [
            'fichier'       => $myFile64,
            'extensionFile' => $myExtFile64,
        ]);
        error_log($response);
        return redirect()->back()->with('message', 'Le fichier est modifié avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-agenda/'.$id);
        return redirect()->back(); 
    }
}
