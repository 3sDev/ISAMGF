<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\ReclamationTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ReclamationTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
         $response = Teacher::with('reclamationsteachers')->where("id", "=", $id)->get();
         $data = json_decode($response);
         return $data;
    }

    public function getAllReclams()
    {
        $response = ReclamationTeacher::with('teacher')->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getReclamWithTeacher($id)
    {
        $response = ReclamationTeacher::with('teacher')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getReclamWithTeacherFilter($id, $statut)
    {
        $response = ReclamationTeacher::where("teacher_id", "=", $id)->where("statut", "=", $statut)->get();
        $data = json_decode($response);
        return $data;
    }

    //count
    public function getCountReclamationsTeachers($statut)
    {
        $response = ReclamationTeacher::where("statut", "=", $statut)->count();
        $data = json_decode($response);
        return $data;
    }
    public function countAllReclamationsTeachers()
    {
        $response = ReclamationTeacher::count();
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
        if ($request->extensionImg != '') {
            //Service Convert Image
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->post_image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/reclamationsTeachers/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameImage = null; }

       $reclamation = new ReclamationTeacher;
       $reclamation->description = $request->input('description');
       $reclamation->post_image  = $nameImage;
       //$reclamation->statut      = $request->input('statut');
       $reclamation->statut      = 'En cours';
       $reclamation->teacher_id  = $request->input('teacher_id');

       $reclamation->save();
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
        $reclamationTeacher=ReclamationTeacher::find($id);
        $reclamationTeacher->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ReclamationTeacher::destroy($id);
    }
}
