<?php

namespace App\Http\Controllers\Emploi;

use App\Http\Controllers\Controller;
use App\Models\EmploiExamenFileTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmploiExamenFileTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = EmploiExamenFileTeacher::with("teacher")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getEmploiExamenTeacherByIdTeacher($id)
    {
        $response = EmploiExamenFileTeacher::with("teacher")->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getEmploiExamenTeacherByIdEmploi($id)
    {
        $response = EmploiExamenFileTeacher::with("teacher")->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    //count
    public function getCountEmploiExamenTeacher()
    {
        $response = EmploiExamenFileTeacher::count();
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
        $file      = "upload/emploi-examen-teacher/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        $emploi = new EmploiExamenFileTeacher;
        $emploi->annee_universitaire = $request->input('annee_universitaire');
        $emploi->semestre            = $request->input('semestre');
        $emploi->type                = $request->input('type');
        $emploi->session             = $request->input('session');
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
        $emploi = EmploiExamenFileTeacher::find($id);

        $emploi->annee_universitaire = $request->input('annee_universitaire');
        $emploi->semestre            = $request->input('semestre');
        $emploi->type                = $request->input('type');
        $emploi->session             = $request->input('session');
        $emploi->description         = $request->input('description');
        $emploi->teacher_id          = $request->input('teacher_id');

        $emploi->update(); 
    }

    public function updatePhotoEmploiExamen(Request $request, $id)
    {
        $emploi = EmploiExamenFileTeacher::find($id);
        //Service Convert File
        if ($request->extensionImg != '') {
            File::delete('upload/emploi-examen-teacher/'.$emploi->fichier);
            $extFile   = $request->extensionImg;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile = time().".$extFile";
            $file      = "upload/emploi-examen-teacher/".$nameFile;
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
        return EmploiExamenFileTeacher::destroy($id);
    }
}
