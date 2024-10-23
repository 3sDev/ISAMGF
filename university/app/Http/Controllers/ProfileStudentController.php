<?php

namespace App\Http\Controllers;

use App\Models\ProfileStudent;
use App\Models\Student;
use Illuminate\Http\Request;

class ProfileStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Student::with('ProfileStudent')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllProfileStudents()
    {
        $response = ProfileStudent::with('student')->get();
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
        // $request->validate([
        //     'service' => 'required',
        //     'description' => 'required',
        //     'statut' => 'required'
        // ]);

         //Service Convert Image
         $extImage  = $request->extensionImg;
         $dataImage = base64_decode($request->profile_image); //decode base64 string
         $nameImage = time().".$extImage";
         $file      = "upload/students/".$nameImage;
         $moveImage = file_put_contents($file, $dataImage);

        $profile                = new ProfileStudent;
        $profile->ddn           = $request->input('ddn');
        $profile->genre         = $request->input('genre');
        $profile->phone         = $request->input('phone');
        $profile->gov           = $request->input('gov');
        $profile->rue           = $request->input('rue');
        $profile->codepostal    = $request->input('codepostal');
        $profile->student_id    = $request->input('student_id');

        $profile->profile_image = $nameImage;

        $profile->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfileStudent  $profileStudent
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileStudent $profileStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfileStudent  $profileStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileStudent $profileStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfileStudent  $profileStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileStudent $profileStudent)
    {
        //
    }

    public function updateProfile(Request $request, $id)
    {
        $profile = ProfileStudent::find($id);
        $profile->ddn           = $request->input('ddn');
        $profile->genre         = $request->input('genre');
        $profile->gov           = $request->input('gov');
        $profile->rue           = $request->input('rue');
        $profile->codepostal    = $request->input('codepostal');
        $profile->profile_image = $request->input('profile_image');
        $profile->student_id    = $request->input('student_id');

        $profile->update();
        //return redirect('/classes')->with('message', 'Classe est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfileStudent  $profileStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileStudent $profileStudent)
    {
        //
    }
}
