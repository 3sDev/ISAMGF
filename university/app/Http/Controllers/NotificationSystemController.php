<?php

namespace App\Http\Controllers;

use App\Models\Notifsystem;
use Illuminate\Http\Request;

class NotificationSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Notifsystem::with('notifmodel', 'event')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getNotifWithModelAndEventByID($id)
    {
        $MyNotifModel = Notifsystem::where('id', $id)->value('notifmodel_id');
        
        if ($MyNotifModel == '1') {
            $response = Notifsystem::with('notifmodel', 'event')->where('id', $id)->get();
            $data = json_decode($response);
            return $data;
        }
        elseif ($MyNotifModel == '2') {
            $response = Notifsystem::with('notifmodel', 'avis')->where('id', $id)->get();
            $data = json_decode($response);
            return $data;
        }
        else {
            $response = Notifsystem::with('notifmodel', 'news')->where('id', $id)->get();
            $data = json_decode($response);
            return $data;
        }
    }

    public function getNotifWithModelAndEvent()
    {
        $notifs = Notifsystem::with('notifmodel')->get();
        $notificationsArray = [];
        foreach ($notifs as $notif) {
            if ($notif->notifmodel_id == '1') {
                $response = Notifsystem::with('notifmodel', 'event')->get();
                $data = json_decode($response);
            }
            elseif ($notif->notifmodel_id == '2') {
                $response = Notifsystem::with('notifmodel', 'avis')->get();
                $data = json_decode($response);
            }
            else {
                $response = Notifsystem::with('notifmodel', 'news')->get();
                $data = json_decode($response);
            }

            $notificationsArray[] = $data;

        }

        return $notificationsArray;

    }

    public function getAllMatiersFromTeacherWithID($id)
    {
        //$response = Student::with('attendances')->where("id", "=", $id)->get();
        $response = Teacher::with('matieres', 'profileTeacher')->where("id", "=", $id)->get();
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
        //
    }
}
