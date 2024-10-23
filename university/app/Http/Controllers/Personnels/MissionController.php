<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Mission::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getAllConges()
    {
        $response = Mission::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllMissions()
    {
        $response = Mission::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllMissionsWithPersonnels()
    {
        $response = Mission::with('personnel', 'profilePersonnel')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllMissionsFromIdPersonnel($id)
    {
        $response = Mission::with('personnel', 'profilePersonnel')->where("personnel_id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllMissionsFromIdMission($id)
    {
        $response = Mission::with('personnel', 'profilePersonnel')->where("id", "=", $id)->get();
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
        if ($request->extensionFile != '') {
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/missions/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $mission = new Mission;
        $mission->titre        = $request->input('titre');
        $mission->date_debut   = $request->input('date_debut');
        $mission->date_fin     = $request->input('date_fin');
        $mission->personnel_id = $request->input('personnel_id');
        $mission->fichier      = $nameFile;

        $mission->save();
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
        $mission = Mission::find($id);

        $mission->titre      = $request->input('titre');
        $mission->date_debut = $request->input('date_debut');
        $mission->date_fin   = $request->input('date_fin');
        $mission->personnel_id = $request->input('personnel_id');

        $mission->update();
    }

    public function updateFileMission(Request $request, $id)
    {
        $mission = Mission::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/missions/'.$mission->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/missions/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $mission->fichier; }
        $mission->fichier = $nameFile3; 
        $mission->update();   
    }

        // //Service Convert PDF
        // $extFile  = $request->extensionFile;
        // $dataFile = base64_decode($request->fichier); //decode base64 string
        // $nameFile = time().".$extFile";
        // $file     = "upload/missions/".$nameFile;
        // $moveFile = file_put_contents($file, $dataFile);

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Mission::destroy($id);
    }
}
