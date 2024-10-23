<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MissionController extends Controller
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
        $response = Http::get($this->getUrlServer().'/all-missions-personnels');
        $missions = json_decode($response);   
        return view('mission.index', ['missions' => $missions]);
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

        return view('mission.create', ['personnels' => $personnels]);
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
            //return $file;
            $myFile64    = $this->convertAllFile($file);
            $myExtFile64 = $this->getExtensionFile($file);

            $response = Http::post($this->getUrlServer().'/missions', [
                'titre'         => $request->input('titre'),
                'date_debut'    => $request->input('date_debut'),
                'date_fin'      => $request->input('date_fin'),
                'fichier'       => $myFile64,
                'extensionFile' => $myExtFile64,
                'personnel_id'  => $request->input('personnel_id'),
            ]);
        }
        else {  
            $response = Http::post($this->getUrlServer().'/missions', [
                'titre'         => $request->input('titre'),
                'date_debut'    => $request->input('date_debut'),
                'date_fin'      => $request->input('date_fin'),
                'personnel_id'  => $request->input('personnel_id'),
            ]);
        }
        return redirect('/missions');
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

        return view('mission.show', ['missions' => $missions]);
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

        $response = Http::get($this->getUrlServer().'/mission-personnel/'.$id);
        $missions = json_decode($response);  

        return view('mission.edit', ['missions' => $missions, 'personnels' => $personnels]);
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
        $response = Http::put($this->getUrlServer().'/update-mission/'.$id, [
            'titre'         => $request->input('titre'),
            'date_debut'    => $request->input('date_debut'),
            'date_fin'      => $request->input('date_fin'),
            'personnel_id'  => $request->input('personnel_id'),
        ]);
        return redirect()->back()->with('message', 'Mission est modifiée avec succés');
    }

    public function updateFileMission(Request $request, $id)
    {
        $fichier    = $request->fichier;
        $myFile     = $this->convertImage($fichier);
        $myExtFile  = $this->getExtensionImage($fichier);

        $response = Http::put($this->getUrlServer().'/update-fileMission/'.$id, [
            'fichier'         => $myFile,
            'extensionFile'   => $myExtFile,
        ]);
        error_log('UpdateImage--------------------------------------------------------------------------'.$response);
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
        $response = Http::delete($this->getUrlServer().'/delete-mission/'.$id);
        return redirect()->back()->with('message', 'Mission est supprimée avec succés');
    }
}
