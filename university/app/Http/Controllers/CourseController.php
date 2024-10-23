<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//$Sections->teachers()->attach($request->teacher_id);

        // $response = User::with('courses')->get();
        // $data = json_decode($response);
        // return $data;

        //For all users
        // $users = User::all();
        // foreach ($users as $user)
        // {
        //     echo $user->name."<br>";

        //     foreach ($user->courses as $course)
        //     {
        //         echo $course->title."<br>";
        //     }
        // }

        //For specific user
        // $user = User::find($id);
        // foreach ($user->courses as $course)
        // {
        //     echo $course->title."<br>";
        // }

        // $courses = Course::all();
        // foreach($courses as $course)
        // {
        //     echo $course->title."<br>";
        //     foreach ($course->users as $user)
        //     {
        //         echo $user->name."<br>";
        //     }
        // }

        // $courses = Course::all();
        // $course = Course::find(3);
        // foreach ($course->users as $user)
        // {
        //     echo $user->name."<br>";
        // }

        $response = User::with('courses')->get();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
