<?php

namespace App\Http\Controllers\Teachers;

use App\Models\ProfileTeacher;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ProfileTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Teacher::with('ProfileTeacher')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllProfileTeachers()
    {
        $response = ProfileTeacher::with('teacher')->get();
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
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->profile_image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/teachers/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        $profile             = new ProfileTeacher();
        $profile->ddn        = $request->input('ddn');
        $profile->genre      = $request->input('genre');
        $profile->phone      = $request->input('phone');
        $profile->gov        = $request->input('gov');
        $profile->rue        = $request->input('rue');
        $profile->codepostal = $request->input('codepostal');
        $profile->teacher_id = $request->input('teacher_id');

        $profile->profile_image = $nameImage;

        $profile->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfileTeacher  $profileTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileTeacher $profileTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfileTeacher  $profileTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileTeacher $profileTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfileTeacher  $profileTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileTeacher $profileTeacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfileTeacher  $profileTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileTeacher $profileTeacher)
    {
        //
    }
}
