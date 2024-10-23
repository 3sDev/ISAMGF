<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
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

    public function storeMessage(Request $request)
    {
        $now = new \DateTime();
        $created_at = $now->format('Y-m-d H:i:s');
        $studentSender   = $request->input('student_id_sender');
        $studentReciever = $request->input('student_id_receiver');

        $sql = DB::select('SELECT * FROM room_students WHERE  (student_id_sender = '.$studentSender.' AND student_id_receiver = '.$studentReciever.')OR (student_id_sender = '.$studentReciever.' AND student_id_receiver = '.$studentSender.')');
        if ($sql == []) {

            $room_student_id = Room::insertGetId([
                'label'      => "Room_".$studentSender."_".$studentReciever,
                'vue'        => "0",
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);

            $datasave = [
                    'room_id'             => $room_student_id,
                    'student_id_sender'   => $request->input('student_id_sender'),
                    'student_id_receiver' => $request->input('student_id_receiver'),
                    'message'             => $request->input('message'),
                    'vue'                 => '0',
                    'archive'             => '0',
                    'created_at'          => $created_at,
                    'updated_at'          => $created_at,
                ];
                DB::table('room_students')->insert($datasave);
            }
        else {
            return $sql;
            $datasave = [
                'room_id'             => $room_student_id,
                'student_id_sender'   => $request->input('student_id_sender'),
                'student_id_receiver' => $request->input('student_id_receiver'),
                'message'             => $request->input('message'),
                'vue'                 => '0',
                'archive'             => '0',
                'created_at'          => $created_at,
                'updated_at'          => $created_at,
            ];
            DB::table('room_students')->insert($datasave);
        }
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
