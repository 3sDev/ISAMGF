<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class EmploiController extends Controller
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
        $response = Http::get($this->getUrlServer().'/all-emplois');
        $emplois = json_decode($response);   
        return view('offre.index', ['emplois' => $emplois]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offre.create');
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
        $myFile64    = $this->convertFile($file);
        $myExtFile64 = $this->getExtensionFile($file);

        $response = Http::post($this->getUrlServer().'/emplois', [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'nom_societe'   => $request->input('nom_societe'),
            'info_societe'  => $request->input('info_societe'),
            'fichier'       => $myFile64,
            'extensionFile' => $myExtFile64,
        ]);
        return redirect('/offres')->with('message', 'L\'offre d\'emploi est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $response = Http::get($this->getUrlServer().'/emplois/'.$id);
        // $emplois = json_decode($response);  

        // $response2 = Http::get($this->getUrlServer().'/users/'.$id);
        // $users = json_decode($response2); 

        // return view('offre.show', ['emplois' => $emplois, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/emplois/'.$id);
        $emplois = json_decode($response);  

        return view('offre.edit', ['emplois' => $emplois]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-emplois/'.$id, [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'nom_societe'   => $request->input('nom_societe'),
            'info_societe'  => $request->input('info_societe'),
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Offre d\'emploi est modifié avec succés');
    }

    public function updateFileOffre(Request $request, $id)
    {
        $fichier    = $request->fichier;
        $myFile     = $this->convertImage($fichier);
        $myExtFile  = $this->getExtensionImage($fichier);

        $response = Http::put($this->getUrlServer().'/update-fileOffre/'.$id, [
            'fichier'         => $myFile,
            'extensionFile'   => $myExtFile,
        ]);
        error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier offre d\'emploi est modifié avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-emplois/'.$id);
        return redirect()->back()->with('message', 'Offre est supprimé avec succés'); 
    }
}
