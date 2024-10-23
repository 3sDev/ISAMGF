<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ClubStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Club::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllClubs()
    {
        $response = Club::all();
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

      //Service Convert PDF - Recu Paiement Total
      if ($request->extensionFile != '') {
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->logo); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/clubs/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $club = new Club;
        $club->nom_ar      = $request->input('nom_ar');
        $club->nom_fr      = $request->input('nom_fr');
        $club->description = $request->input('description');
        $club->statut      = $request->input('statut');
        $club->chef        = $request->input('chef');
        $club->membre_1    = $request->input('membre_1');
        $club->membre_2    = $request->input('membre_2');
        $club->membre_3    = $request->input('membre_3');
        $club->membre_4    = $request->input('membre_4');
        $club->membre_5    = $request->input('membre_5');

        $club->logo      = $nameFile;

        $club->save();
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
        $club = Club::find($id);
        $club->update($request->all());
    }

    public function updateLogoClub(Request $request, $id)
    {
        $club = Club::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/clubs/'.$club->logo);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->logo); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/clubs/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $club->logo; }
        $club->logo = $nameFile3; 
        $club->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Club::destroy($id);
    }
}
