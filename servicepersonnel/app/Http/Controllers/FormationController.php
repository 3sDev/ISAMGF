<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FormationController extends Controller
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
        $response = Http::get($this->getUrlServer().'/getAllFormationsWithPersonnels');
        $formations = json_decode($response);   
        return view('formation.index', ['formations' => $formations]);
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

        return view('formation.create', ['personnels' => $personnels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->attestation != '') {
            $file        = $request->attestation;
            //return $file;
            $myFile64    = $this->convertAllFile($file);
            $myExtFile64 = $this->getExtensionFile($file);

            $response = Http::post($this->getUrlServer().'/formations', [
                'nom_formation' => $request->input('nom_formation'),
                'structure'     => $request->input('structure'),
                'description'   => $request->input('description'),
                'lieu'          => $request->input('lieu'),
                'date_debut'    => $request->input('date_debut'),
                'date_fin'      => $request->input('date_fin'),
                'attestation'   => $myFile64,
                'extensionFile' => $myExtFile64,
                'personnel_id'  => $request->input('personnel_id'),
            ]);
        }
        else {  
            $response = Http::post($this->getUrlServer().'/formations', [
                'nom_formation' => $request->input('nom_formation'),
                'structure'     => $request->input('structure'),
                'description'   => $request->input('description'),
                'lieu'          => $request->input('lieu'),
                'date_debut'    => $request->input('date_debut'),
                'date_fin'      => $request->input('date_fin'),
                'personnel_id'  => $request->input('personnel_id'),
            ]);
        }
        return redirect('/formations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response2 = Http::get($this->getUrlServer().'/getFormationWithPersonnelByIdFormation/'.$id);
        $formations = json_decode($response2); 

        return view('formation.show', ['formations' => $formations]);
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

        $response = Http::get($this->getUrlServer().'/getFormationWithPersonnelByIdFormation/'.$id);
        $formations = json_decode($response);  

        return view('formation.edit', ['formations' => $formations, 'personnels' => $personnels]);
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
        $response = Http::put($this->getUrlServer().'/update-formation/'.$id, [
            'nom_formation' => $request->input('nom_formation'),
            'structure'     => $request->input('structure'),
            'description'   => $request->input('description'),
            'lieu'          => $request->input('lieu'),
            'date_debut'    => $request->input('date_debut'),
            'date_fin'      => $request->input('date_fin'),
            'personnel_id'  => $request->input('personnel_id'),
        ]);
        return redirect()->back()->with('message', 'Formation est modifiée avec succés');
    }

    public function updateFileFormation(Request $request, $id)
    {
        $attestation = $request->attestation;
        $myFile      = $this->convertImage($attestation);
        $myExtFile   = $this->getExtensionImage($attestation);

        $response = Http::put($this->getUrlServer().'/update-fileFormation/'.$id, [
            'attestation'   => $myFile,
            'extensionFile' => $myExtFile,
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
        $response = Http::delete($this->getUrlServer().'/delete-formation/'.$id);
        return redirect()->back()->with('message', 'Formation est supprimée avec succés');
    }
}
