<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Telechargement;
use App\Models\TelechargementPersonnel;
use Illuminate\Http\Request;

class TelechargementPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = TelechargementPersonnel::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllDownloadsPersonnels()
    {
        $response = TelechargementPersonnel::all();
        $data = json_decode($response);
        return $data;
    }
    
    public function getAllDownloadsWithPersonnels()
    {
        $response = TelechargementPersonnel::with('personnel')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllDownloadsWithPersonnelByIdPersonnel($id)
    {
        $response = TelechargementPersonnel::with("personnel")->where("personnel_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getDownloadWithPersonnelByIdDownload($id)
    {
        $response = TelechargementPersonnel::with("personnel")->where("id", "=", $id)->get();
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
            $dataFile = base64_decode($request->fichier); //decode base64 string
            $nameFile = time().".$extFile";
            $file     = "upload/personnels/downloads/".$nameFile;
            $moveFile = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $download = new TelechargementPersonnel;
        $download->nom_fichier  = $request->input('nom_fichier');
        $download->description  = $request->input('description');
        $download->fichier      = $nameFile;
        $download->personnel_id = $request->input('personnel_id');

        $download->save();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return TelechargementPersonnel::destroy($id);
    }

    public function destroyServiceStage($id)
    {
        return Telechargement::destroy($id);
    }
}
