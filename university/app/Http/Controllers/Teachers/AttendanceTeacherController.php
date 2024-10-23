<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\AttendanceTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceTeacherController extends Controller
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

    public function getAllAttendanceWithTeachers()
    {
        $response = AttendanceTeacher::with('teacher', 'seance')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllAttendanceWithTeacherByIdAndDateAndDay($teacher, $day, $date)
    {
        $response = AttendanceTeacher::with('teacher', 'seance')->where("jour", "=", $day)
                                        ->where("teacher_id", "=", $teacher)
                                        ->where("attendance_date", "like", $date.'%')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllAttendanceWithTeacherFromId($id)
    {
        $response = AttendanceTeacher::where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAttendanceTeacherByIdAtt($id)
    {
        $response = AttendanceTeacher::with('teacher', 'seance')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    //count
    public function getCountAttendancesTeachersToday()
    {
        $response = AttendanceTeacher::where("attendance_date", "=", now())->count();
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
        $attendance                  = new AttendanceTeacher;
        $attendance->teacher_id      = $request->input('teacher_id');
        $attendance->attendance_date = $request->input('attendance_date');

        $attendance->save();
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
        $attendanceTeacher = AttendanceTeacher::find($id);
        $attendanceTeacher->attendance_date   = $request->input('attendance_date');
        $attendanceTeacher->jour              = $request->input('jour');
        $attendanceTeacher->heure_debut       = $request->input('heure_debut'); 
        $attendanceTeacher->heure_fin         = $request->input('heure_fin'); 
        $attendanceTeacher->justification     = $request->input('justification'); 
        $attendanceTeacher->date_justification= $request->input('date_justification'); 

        $attendanceTeacher->update();
    }

    public function getSurfaceMap()
    {
        $sql = DB::select('SELECT * From surfacemap');
        //$data = json_decode($sql);
        return $sql;
        //$id_room = $sql[1]->roomID;
        
        //return $id_room;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return AttendanceTeacher::destroy($id);
    }
}
