<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\AttendancePersonnel;
use App\Models\Personnel;
use Illuminate\Http\Request;

class AttendancePersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAllAttendanceWithPersonnelFromId($id)
    {
        $response = Personnel::with('attendancespersonnels')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function attendancePersonnels()
    {
        $response = AttendancePersonnel::with('personnel')->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function attendancePersonnel($id)
    {
        $response = AttendancePersonnel::with('personnel')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function attendancePersonnelWithDayAndDate($jour, $date)
    {
        $response = AttendancePersonnel::with('personnel')->where("jour", "=", $jour)
                                        ->where("attendance_date", "=", $date)->get();
        $data = json_decode($response);
        return $data;
    }

    //count
    public function countAllAttendancesPersonnels()
    {
        $response = AttendancePersonnel::count();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return AttendancePersonnel::destroy($id);
    }
}
