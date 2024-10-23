<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Surveillance;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SurveillanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Surveillance::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSurveillancesWithTeachers()
    {
        $response = Surveillance::with('teacher')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getSurveillanceByIdTeacher($id)
    {
        $response = Teacher::with('surveillances')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getSurveillanceByIdTeacherAndSession($id, $session)
    {
        $response = Surveillance::with('teacher')->where("teacher_id", "=", $id)->where("session", "=", $session)->get();
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
         if ($request->extensionFile != '') {
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile  = time().".$extFile";
            $file      = "upload/surveillances/".$nameFile;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile = null; }
    
        $post = new Surveillance;
        $post->annee_universitaire = $request->input('annee_universitaire');
        $post->semestre            = $request->input('semestre');
        $post->fichier             = $nameFile;
        $post->type                = $request->input('type');
        $post->session             = $request->input('session');
        $post->jour_1              = $request->input('jour_1');
        $post->jour_2              = $request->input('jour_2');
        $post->jour_3              = $request->input('jour_3');
        $post->jour_4              = $request->input('jour_4');
        $post->teacher_id          = $request->input('teacher_id'); 
        $post->save();
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
        $post = Surveillance::find($id);

        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/surveillances/'.$post->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile  = time().".$extFile";
            $file      = "upload/surveillances/".$nameFile;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile = $post->fichier; }

        $post->annee_universitaire = $request->input('annee_universitaire');
        $post->semestre            = $request->input('semestre');
        $post->fichier             = $nameFile;
        $post->type                = $request->input('type');
        $post->session             = $request->input('session');
        $post->jour_1              = $request->input('jour_1');
        $post->jour_2              = $request->input('jour_2');
        $post->jour_3              = $request->input('jour_3');
        $post->jour_4              = $request->input('jour_4');
        $post->teacher_id          = $request->input('teacher_id'); 

        $post->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Surveillance::destroy($id);
    }
}
