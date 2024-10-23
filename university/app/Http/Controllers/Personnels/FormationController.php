<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Formation::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllFormations()
    {
        $response = Formation::all();
        $data = json_decode($response);
        return $data;
    }
    
    public function getAllFormationsWithPersonnels()
    {
        $response = Formation::with('personnel')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllFormationsWithPersonnelByIdPersonnel($id)
    {
        $response = Formation::with("personnel")->where("personnel_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getFormationWithPersonnelByIdFormation($id)
    {
        $response = Formation::with("personnel")->where("id", "=", $id)->get();
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
            $dataFile = base64_decode($request->attestation); //decode base64 string
            $nameFile = time().".$extFile";
            $file     = "upload/personnels/formations/".$nameFile;
            $moveFile = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $formation = new Formation;
        $formation->nom_formation = $request->input('nom_formation');
        $formation->structure     = $request->input('structure');
        $formation->description   = $request->input('description');
        $formation->lieu          = $request->input('lieu');
        $formation->attestation   = $nameFile;
        $formation->date_debut    = $request->input('date_debut');
        $formation->date_fin      = $request->input('date_fin');
        $formation->personnel_id  = $request->input('personnel_id');

        $formation->save();
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
        $formations=Formation::find($id);
        $formations->nom_formation = $request->input('nom_formation');
        $formations->structure     = $request->input('structure');
        $formations->description   = $request->input('description');
        $formations->lieu          = $request->input('lieu');
        $formations->date_debut    = $request->input('date_debut');
        $formations->date_fin      = $request->input('date_fin');
        $formations->personnel_id  = $request->input('personnel_id');

        $formations->update();
    }

    
    public function updateFileFormation(Request $request, $id)
    {
        $formation = Formation::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/personnels/formations/'.$formation->attestation);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->attestation); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/personnels/formations/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $formation->attestation; }
        $formation->attestation = $nameFile3; 
        $formation->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Formation::destroy($id);
    }
}
