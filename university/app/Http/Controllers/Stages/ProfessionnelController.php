<?php

namespace App\Http\Controllers\Stages;

use App\Http\Controllers\Controller;
use App\Models\DemandeStudent;
use App\Models\Room;
use App\Models\RoomStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProfessionnelController extends Controller
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
    public function proDirection(Request $request, $id)
    {
        $pro = DemandeStudent::find($id);
        $pro->stage_company           = $request->input('stage_company');
        $pro->stage_info_company      = $request->input('stage_info_company');
        $pro->stage_encadreur_campany = $request->input('stage_encadreur_campany');
        $pro->stage_sujet             = $request->input('stage_sujet');
        $pro->stage_description       = $request->input('stage_description');
        $pro->stage_debut             = $request->input('stage_debut');
        $pro->stage_fin               = $request->input('stage_fin');
        $pro->stage_duree             = $request->input('stage_duree');
        $pro->stage_soutenance        = $request->input('stage_soutenance');
        $pro->statut                  = $request->input('statut');
        $pro->update();
    }

    public function updatePropositionStagePro(Request $request, $id)
    {
        $stage = DemandeStudent::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/demandesStudents/stagePro/propositions/'.$stage->stage_proposition_file);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->stage_proposition_file); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/demandesStudents/stagePro/propositions/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $stage->stage_proposition_file; }
        $stage->stage_proposition_file = $nameFile3; 
        $stage->update();   
    }

    public function updateAttestationStagePro(Request $request, $id)
    {
        $stage = DemandeStudent::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/demandesStudents/stagePro/attestations/'.$stage->stage_attestation_file);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->stage_attestation_file); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/demandesStudents/stagePro/attestations/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $stage->stage_attestation_file; }
        $stage->stage_attestation_file = $nameFile3; 
        $stage->update();   
    }
    
    public function updateRapportStagePro(Request $request, $id)
    {
        $stage = DemandeStudent::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/demandesStudents/stagePro/rapports/'.$stage->stage_rapport_file);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->stage_rapport_file); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/demandesStudents/stagePro/rapports/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $stage->stage_rapport_file; }
        $stage->stage_rapport_file = $nameFile3; 
        $stage->update();   
    }
    
    public function updateStagePro(Request $request, $id)
    {
        $stagePro = DemandeStudent::find($id);
        if ($stagePro->accepter == 0) {
            $stagePro->accepter = 1;
            $stagePro->statut = 'Traitée';
        }
        else {
            $stagePro->accepter = 0;
        }   
        $stagePro->update();     
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
