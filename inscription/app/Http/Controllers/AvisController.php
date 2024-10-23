<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AvisController extends Controller
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
        $response = Http::get($this->getUrlServer().'/all-avis');
        $avis = json_decode($response);   
        return view('avis.index', ['avis' => $avis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $image      = $request->image;
        $myImage64  = $this->convertImage($image);
        $myExtImg64 = $this->getExtensionImage($image);

        $file        = $request->fichier;
        $myFile64    = $this->convertFile($file);
        $myExtFile64 = $this->getExtensionFile($file);

        $response = Http::post($this->getUrlServer().'/avis', [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'date'          => $request->input('date'),
            'adresse'       => $request->input('adresse'),
            'rating'        => '0',
            'views'         => '0',
            'image'         => $myImage64,
            'extensionImg'  => $myExtImg64,
            'fichier'       => $myFile64,
            'extensionFile' => $myExtFile64,
            'type'          => 'Enseignant',
           ]);

        return redirect('/avis')->with('message', 'Avis est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/avis/'.$id);
        $avis = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/users/'.$id);
        $users = json_decode($response2); 

        return view('avis.show', ['avis' => $avis, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/avis/'.$id);
        $avis = json_decode($response);  

        return view('avis.edit', ['avis' => $avis]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-avis/'.$id, [
            'titre'       => $request->input('titre'),
            'description' => $request->input('description'),
            'date'        => $request->input('date'),
            'adresse'     => $request->input('adresse'),
            'rating'      => $request->input('rating'),
            'views'       => $request->input('views'),
            'image'       => $request->input('image'),
            'fichier'     => $request->input('fichier'),
            'type'        => $request->input('type'),
           ]);
        return redirect()->back()->with('message', 'Avis est modifier avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-avis/'.$id);
        return redirect()->back()->with('message', 'avis est supprimée avec succés'); 
    }
}
