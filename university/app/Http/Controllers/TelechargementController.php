<?php

namespace App\Http\Controllers;

use App\Models\Telechargement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TelechargementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Telechargement::all();
        $data = json_decode($response);
        return $data;
    }


    public function getFileById($id)
    {
        $response = Telechargement::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getFileByCategory($category)
    {
        $response = Telechargement::where("categorie", "=", $category)->get();
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
         // Service Convert PDF
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/telechargements/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);

        $download              = new Telechargement;
        $download->titre       = $request->input('titre');
        $download->description = $request->input('description');
        $download->categorie   = $request->input('categorie');

        $download->fichier     = $nameFile;

        $download->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Telechargement  $telechargement
     * @return \Illuminate\Http\Response
     */
    public function show(Telechargement $telechargement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Telechargement  $telechargement
     * @return \Illuminate\Http\Response
     */
    public function edit(Telechargement $telechargement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telechargement  $telechargement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $download=Telechargement::find($id);
        $download->update($request->all());
    }

    public function updateFileDownload(Request $request, $id)
    {
        $download = Telechargement::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/telechargements/'.$download->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/telechargements/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $download->fichier; }
        $download->fichier = $nameFile3; 
        $download->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telechargement  $telechargement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Telechargement::destroy($id);
    }
}
