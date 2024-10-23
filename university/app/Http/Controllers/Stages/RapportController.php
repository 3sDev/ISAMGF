<?php

namespace App\Http\Controllers\Stages;

use App\Http\Controllers\Controller;
use App\Models\DemandeStudent;
use App\Models\Room;
use App\Models\RoomStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
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

    public function allRoomsWithStudents()
    {
        $response = Room::with('student')->get();
        $data = json_decode($response);
        return $data;
    }
    // SELECT DISTINCT rooms.id as idRoom, rooms.label as nomRoom, students.id as idStudent, students.nom as nomStudent, students.prenom as prenomStudent, room_students.id as idRoomStudent FROM rooms INNER JOIN room_students ON rooms.id = room_students.room_id INNER JOIN students ON students.id = room_students.student_id_sender INNER JOIN students ON students.id = room_students.student_id_receiver  WHERE room_students.student_id_sender = 15 OR room_students.student_id_receiver = 15
    public function getRoomsByIdStudent($idStudent)
    {
        $sql = DB::select('SELECT DISTINCT students.id as idStudent, students.nom as nomStudent, students.prenom as prenomStudent, students.profile_image as photoStudent, room_students.room_id as roomID FROM room_students INNER JOIN students ON students.id = room_students.student_id_sender OR (students.id = room_students.student_id_receiver) WHERE (room_students.student_id_sender = '.$idStudent.' OR room_students.student_id_receiver = '.$idStudent.') AND students.id <> '.$idStudent.'');
        return $sql;
    }

    public function getMessagesByRoomId($idRoom)
    {
        $response = RoomStudent::where('room_id', '=', $idRoom)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getMaxIdMessageFromRoom($idStudent)
    {
        $sql = DB::select('SELECT DISTINCT students.id as idStudent, students.nom as nomStudent, students.prenom as prenomStudent, students.profile_image as photoStudent, room_students.room_id as roomID FROM room_students INNER JOIN students ON students.id = room_students.student_id_sender OR (students.id = room_students.student_id_receiver) WHERE (room_students.student_id_sender = '.$idStudent.' OR room_students.student_id_receiver = '.$idStudent.') AND students.id <> '.$idStudent.'');
        
        print_r($sql);
        //$id_room = $sql[1]->roomID;
        
        //return $id_room;
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
    public function storeRoom(Request $request)
    {
        $room        = new Room;
        $room->label = $request->input('label');
        $room->vue   = $request->input('vue');
       
        $room->save();
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
    
    public function updateStageRapport(Request $request, $id)
    {
        $stageRapport = DemandeStudent::find($id);
        if ($stageRapport->recuperer == 0) {
            $stageRapport->recuperer = 1;
            $stageRapport->statut = 'Traitée';
        }
        else {
            $stageRapport->recuperer = 0;
        }   
        $stageRapport->update();     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Room::destroy($id);
    }
}
