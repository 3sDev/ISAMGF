<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\NotificationStudent;
use Illuminate\Http\Request;

class NotificationController extends Controller
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

    public function getAllNotifications()
    {
        $response = NotificationStudent::with('notifModel', 'attendances')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllNotificationsViewsFromAttendances($view)
    {
        $response = NotificationStudent::with('notifModel', 'attendances', 'demandes', 'reclamations')->where("readed", "=", $view)->orderBy('id', 'DESC')->get();
        $data = json_decode($response);
        return $data;
    }
  
    public function getAllNotificationsByIdStudent($id)
    {
        $response = NotificationStudent::with('notifModel', 'attendances', 'demandes', 'reclamations')->where("student_id", "=", $id)->orderBy('id', 'DESC')->get();
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

    public function updateViewsNotificationAttendances(Request $request, $id)
    {
        $notifAttendance=NotificationStudent::find($id);
        if ($notifAttendance->readed == 0) {
            $notifAttendance->readed = 1;
        }
        // else {
        //     $notifAttendance->readed = 0;
        // }   
        $notifAttendance->update();     
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return NotificationStudent::destroy($id);
    }
}
