<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DownloadController extends Controller
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
        $response = Http::get($this->getUrlServer().'/downloads');
        $downloads = json_decode($response);   
        return view('download.index', ['downloads' => $downloads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('download.create');
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
        $myFile64    = $this->convertAllFile($file);
        $myExtFile64 = $this->getExtensionFile($file);

        $response = Http::post($this->getUrlServer().'/download', [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'categorie'     => $request->input('categorie'),
            'fichier'       => $myFile64,
            'extensionFile' => $myExtFile64,
        ]);
        return redirect('/downloads')->with('message', 'Le fichier est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/download/'.$id);
        $downloads = json_decode($response);  

        return view('download.edit', ['downloads' => $downloads]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-download-stage/'.$id, [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'categorie'     => $request->input('categorie'),
        ]);
        error_log('UpdateInfos--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Les informations du fichier sont modifiés avec succés');
    }

    public function updateFileDownload(Request $request, $id)
    {
        $fichier    = $request->fichier;
        $myFile     = $this->convertImage($fichier);
        $myExtFile  = $this->getExtensionImage($fichier);

        $response = Http::put($this->getUrlServer().'/update-fileDownload-stage/'.$id, [
            'fichier'         => $myFile,
            'extensionFile'   => $myExtFile,
        ]);
        error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier est modifié avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-downloadFichier/'.$id);
        return redirect()->back()->with('message', 'Le fichier est supprimé avec succés'); 
    }
}
