<?php

namespace App\Http\Controllers;

use App\Models\RoomBlockStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomBlockStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $sql = DB::select('SELECT room_block_students.id as idBlock, students.id as idBlocked, students.nom as nomBlocked, students.prenom as prenomBlocked, 
        classes.abbreviation as classeBlocked, students.profile_image as photoBlocked FROM room_block_students INNER JOIN students INNER JOIN classes
        WHERE students.id = room_block_students.student_blocked_id AND classes.id = students.classe_id 
        AND room_block_students.student_blocker_id = '.$id.'');
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
    public function store(Request $request)
    {
        try {
            $blocked = new RoomBlockStudent;
            $blocked->student_blocked_id = $request->input('student_blocked_id');
            $blocked->student_blocker_id = $request->input('student_blocker_id');
            $blocked->statut = '0';
            $blocked->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['Error to save block student'],400);
        }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomBlockStudent  $roomBlockStudent
     * @return \Illuminate\Http\Response
     */
    public function show(RoomBlockStudent $roomBlockStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomBlockStudent  $roomBlockStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomBlockStudent $roomBlockStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomBlockStudent  $roomBlockStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomBlockStudent $roomBlockStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomBlockStudent  $roomBlockStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomBlockStudent $roomBlockStudent, $idBlock)
    {
        try {
            RoomBlockStudent::destroy($idBlock);
            return response()->json(['Delete block student'],200);
        } 
        
        catch(\Exception $e){
            //error_log($e->getMessage());
            return response()->json([
                'Error delete block by student!!'
            ],500);
        }
    }
}
