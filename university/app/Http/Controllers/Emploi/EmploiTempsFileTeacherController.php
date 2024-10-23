<?php

namespace App\Http\Controllers\Emploi;

use App\Http\Controllers\Controller;
use App\Models\EmploiTempsFileTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmploiTempsFileTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = EmploiTempsFileTeacher::with("teacher")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getEmploiTempsTeacherByIdTeacher($id)
    {
        $response = EmploiTempsFileTeacher::with("teacher")->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getEmploiTempsTeacherByIdEmploi($id)
    {
        $response = EmploiTempsFileTeacher::with("teacher")->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getEmploiTempsTeacherBySemestre($id, $semestre)
    {
        $response = EmploiTempsFileTeacher::with("teacher")->where("teacher_id", "=", $id)
        ->where("semestre", "=", $semestre)->get();
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
        //Service Convert Image
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->fichier); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/emploi-teacher-file/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        $emploi = new EmploiTempsFileTeacher;
        $emploi->annee_universitaire = $request->input('annee_universitaire');
        $emploi->semestre            = $request->input('semestre');
        $emploi->description         = $request->input('description');
        $emploi->fichier             = $nameImage;
        $emploi->teacher_id          = $request->input('teacher_id');

        $emploi->save();
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
        $emploi = EmploiTempsFileTeacher::find($id);
        //Service Convert File
        // if ($request->extensionImg != '') {
        //     File::delete('upload/emploi-teacher-file/'.$emploi->fichier);
        //     $extFile   = $request->extensionImg;
        //     $dataImage = base64_decode($request->fichier); //decode base64 string
        //     $nameFile  = time().".$extFile";
        //     $file      = "upload/emploi-teacher-file/".$nameFile;
        //     $moveImage = file_put_contents($file, $dataImage);
        // }
        // else { $nameFile = $emploi->fichier; } 

        $emploi->annee_universitaire = $request->input('annee_universitaire');
        $emploi->semestre            = $request->input('semestre');
        $emploi->description         = $request->input('description');
        $emploi->teacher_id          = $request->input('teacher_id');
        //$emploi->fichier             = $nameFile;

        $emploi->update(); 
    }

    public function updatePhotoEmploi(Request $request, $id)
    {
        $emploi = EmploiTempsFileTeacher::find($id);
        //Service Convert File
        if ($request->extensionImg != '') {
            File::delete('upload/emploi-teacher-file/'.$emploi->fichier);
            $extFile   = $request->extensionImg;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile = time().".$extFile";
            $file      = "upload/emploi-teacher-file/".$nameFile;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile = $emploi->fichier; }
        $emploi->fichier = $nameFile;
        $emploi->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return EmploiTempsFileTeacher::destroy($id);
    }
}
