<?php

namespace App\Http\Controllers;

use App\Models\Notifmodel;
use App\Models\Student;
use App\Models\StudentOneSignal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = User::with('departement')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllAdmins()
    {
        $response = User::with('departement')->get();
        $data = json_decode($response);
        return $data;
    }

    public function addOneSignalKeyStudent(Request $request, $id)
    {
        $student = Student::find($id);
        $student->api_onesignal = $request->input('api_onesignal');
        $student->update();
        return $student->api_onesignal;
    }

    public function getStudentOneSignalById($id)
    {
        $response = Student::with('onesignal')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllModelsNotification()
    {
        $response = Notifmodel::all();
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
        $user = new User;
        $user->name               = $request->input('name');
        $user->role               = $request->input('role');
        $user->email              = $request->input('email');
        $user->profile_photo_path = $request->input('profile_photo_path');
        $user->password           = Hash::make($request->input('password'));
        $user->lockout_time       = $request->input('lockout_time');
        $user->departement_id     = $request->input('departement_id');
        $user->save();
    }

    public function storeOneSignal(Request $request)
    {
        $studentOneSignal = new StudentOneSignal();
        $studentOneSignal->student_id    = $request->input('student_id');
        $studentOneSignal->api_onesignal = $request->input('api_onesignal');
        $studentOneSignal->uuid          = $request->input('uuid');
        $studentOneSignal->save();
        return ["student_id" => $studentOneSignal->student_id, "api_onesignal" => $studentOneSignal->api_onesignal, 
                "uuid" => $studentOneSignal->uuid];
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
        $user = User::find($id);
        $user->name               = $request->input('name');
        $user->role               = $request->input('role');
        $user->email              = $request->input('email');
        $user->lockout_time       = $request->input('lockout_time');
        $user->departement_id     = $request->input('departement_id');
        $user->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
