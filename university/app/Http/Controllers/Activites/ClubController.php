<?php

namespace App\Http\Controllers\Activites;

use App\Http\Controllers\Controller;
use App\Models\ClubStudent;
use App\Models\DemandeStudent;
use App\Models\Room;
use App\Models\RoomStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
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

    public function getStudentsByIdClub($idClub)
    {
        $sql = DB::select('SELECT students.id as idStudent, students.nom as nomStudent, students.prenom as prenomStudent, 
        students.profile_image as photoStudent, classes.abbreviation as nomClasse, club_students.id as idClubStudent, club_students.created_at as dateAffectation,
        club_students.demande_id as idDemande, demande_students.activer as etatActive FROM students INNER JOIN club_students INNER JOIN classes 
        INNER JOIN demande_students WHERE demande_students.id = club_students.demande_id AND students.id = club_students.student_id 
        AND club_students.club_id = '.$idClub.' AND classes.id = club_students.club_id');
        return $sql;
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
    
    public function updateClubAccepter(Request $request, $id)
    {
        $clubAccepte = DemandeStudent::find($id);
        if ($clubAccepte->accepter == 0) {
            //update student club (accepter)
            $clubAccepte->accepter = 1;
            $clubAccepte->update(); 

            //add new student to club
            $membre = new ClubStudent;
            $membre->student_id = $request->input('student_id');
            $membre->classe_id  = $request->input('classe_id');
            $membre->club_id    = $request->input('club_id');
            $membre->demande_id = $request->input('demande_id');
            $membre->club       = $request->input('club');
            $membre->save();
        }
        else {
            //update student club (réfuser)
            $clubAccepte->accepter = 0;
            $clubAccepte->update(); 

            //delete student from club
            $demandeId = $request->input('demande_id');
            DB::delete('delete from club_students where demande_id = ?', [$demandeId]);
        }   
            
    }

    public function updateClubActiver(Request $request, $id)
    {
        $clubActive = DemandeStudent::find($id);
        if ($clubActive->activer == 0) {
            $clubActive->activer = 1;
            $clubActive->statut  = 'Traitée';
        }
        else {
            $clubActive->activer = 0;
        }   
        $clubActive->update();     
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

    public function destroyAffectStudent($idAffect, $idDemande)
    {
        //update affectation student club
        $clubAccepte = DemandeStudent::find($idDemande);
        $clubAccepte->accepter = 0;
        $clubAccepte->update();

        //delete affectation student club
        return ClubStudent::destroy($idAffect);
    }
}
