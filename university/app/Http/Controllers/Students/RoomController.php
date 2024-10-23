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
        $response = RoomStudent::with('messageFiles')->where('room_id', '=', $idRoom)->get();
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

/*     select room_id as roomId, message,id as messageId, vue as messageView, created_at as messageDate from room_students where room_id in (SELECT DISTINCT room_students.room_id as roomID FROM room_students INNER JOIN students ON students.id = room_students.student_id_sender OR (students.id = room_students.student_id_receiver) WHERE (room_students.student_id_sender = 15 OR room_students.student_id_receiver = 15) AND students.id <> 15) GROUP BY id ORDER BY `roomId` ASC 
 */
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
        //$room->vue   = $request->input('vue');
    
        $room->save();
    }

    public function storeMessage(Request $request)
    {
        $dateNow         = new \DateTime();
        $created_at      = $dateNow->format('Y-m-d H:i:s');
        $studentSender   = $request->input('student_id_sender');
        $studentReceiver = $request->input('student_id_receiver');

        $sql = DB::select('SELECT * FROM room_students WHERE (student_id_sender = '.$studentSender.' AND 
        student_id_receiver = '.$studentReceiver.') OR (student_id_sender = '.$studentReceiver.' AND 
        student_id_receiver = '.$studentSender.')');
        
        if ($sql == []) {
            $room_student_id = Room::insertGetId([
                'label'      => 'Room_'.$studentSender.'_'.$studentReceiver,
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
    
            $room_message_id = RoomStudent::insertGetId([
                'room_id'             => $room_student_id,
                'student_id_sender'   => $studentSender,
                'student_id_receiver' => $studentReceiver,
                'message'             => $request->input('message'),
                'archive'             => '0',
                'created_at'          => $created_at,
                'updated_at'          => $created_at,
            ]);
        
            $files = $request->input('files');
            $file_destination_path = public_path('upload/messages/students/files');
            $files_paths = array();

            foreach($files as $file){

                // Decoding base64 file data
                //$file_data = str_replace(substr($file['file'], 0, 22), '', $file['file']);
                //$file_data = str_replace(' ', '+', $file_data);
                $file_data = $file['file'];
                $file_binary_data = base64_decode($file_data);

                // generating unique id for file
                $ran_bytes = random_bytes(15);
                $uid = bin2hex($ran_bytes);

                $file_name = $uid.'.'.$file['extension'];
                error_log($file_name);

                // Saving file into files folder
                file_put_contents($file_destination_path . '/' . $file_name, $file_binary_data);
                error_log("File saved succussfully into the server");
                $file_path = 'upload/messages/students/files/' . $file_name;
                $fileRecord = array(
                    'path' => $file_path,
                    'room_student_id' => $room_message_id,
                );

                array_push($files_paths, $file_path);
                $savedFile = DB::table('room_files')->insert($fileRecord);
            }

        }
        else {
            //return print_r($sql);
            $id_room = $sql[0]->room_id;
            $room_message_id = RoomStudent::insertGetId([
                'room_id'             => $id_room,
                'student_id_sender'   => $studentSender,
                'student_id_receiver' => $studentReceiver,
                'message'             => $request->input('message'),
                'archive'             => '0',
                'created_at'          => $created_at,
                'updated_at'          => $created_at,
            ]);

            $files = $request->input('files');
            $file_destination_path = public_path('upload/messages/students/files');
            $files_paths = array();

            foreach($files as $file){

                // Decoding base64 file data
                //$file_data = str_replace(substr($file['file'], 0, 22), '', $file['file']);
                //$file_data = str_replace(' ', '+', $file_data);
                $file_data = $file['file'];
                $file_binary_data = base64_decode($file_data);

                // generating unique id for file
                $ran_bytes = random_bytes(15);
                $uid = bin2hex($ran_bytes);

                $file_name = $uid.'.'.$file['extension'];
                error_log($file_name);

                // Saving file into files folder
                file_put_contents($file_destination_path . '/' . $file_name, $file_binary_data);
                error_log("File saved succussfully into the server");
                $file_path = 'upload/messages/students/files/' . $file_name;
                $fileRecord = array(
                    'path' => $file_path,
                    'room_student_id' => $room_message_id,
                );

                array_push($files_paths, $file_path);
                $savedFile = DB::table('room_files')->insert($fileRecord);
            }
        }
    }

    public function storeMessageRecherche(Request $request, $sender, $receiver)
    {
        $dateNow         = new \DateTime();
        $created_at      = $dateNow->format('Y-m-d H:i:s');
        $studentSender   = $sender;
        $studentReceiver = $receiver;

        $sql = DB::select('SELECT * FROM rooms WHERE (label LIKE "room_'.$studentSender.'_'.$studentReceiver.'" OR 
        label LIKE "room_'.$studentReceiver.'_'.$studentSender.'")');
        
        return $sql;

        // if ($sql == []) {
        //     $room_student_id = Room::insertGetId([
        //         'label'      => 'Room_'.$studentSender.'_'.$studentReceiver,
        //         'vue'        => '0',
        //         'created_at' => $created_at,
        //         'updated_at' => $created_at,
        //     ]);
    
        //     $datasave = [
        //         'room_id'             => $room_student_id,
        //         'student_id_sender'   => $studentSender,
        //         'student_id_receiver' => $studentReceiver,
        //         'message'             => $request->input('message'),
        //         'vue'                 => '0',
        //         'archive'             => '0',
        //         'created_at'          => $created_at,
        //         'updated_at'          => $created_at,
        //     ];
        //     DB::table('room_students')->insert($datasave);
        // }
        // else {
        //     //return print_r($sql);
        //     $id_room = $sql[0]->room_id;
        //     $datasave = [
        //         'room_id'             => $id_room,
        //         'student_id_sender'   => $studentSender,
        //         'student_id_receiver' => $studentReceiver,
        //         'message'             => $request->input('message'),
        //         'vue'                 => '0',
        //         'archive'             => '0',
        //         'created_at'          => $created_at,
        //         'updated_at'          => $created_at,
        //     ];
        //     DB::table('room_students')->insert($datasave);
        // }
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

    public function deleteMessageStudent(Request $request, $id, $student)
    {
        try {
            $msg = RoomStudent::find($id);
            if ($msg->student_id_sender == $student){
                if ($msg->delete_receiver == 1) {
                    RoomStudent::destroy($id);
                    return response()->json(['Message deleted by sender'],200);
                } else {
                    $msg->delete_sender = '1';
                    $msg->update();
                    return response()->json(['Message updated(delete) by sender'],200);
                }
            }
            elseif ($msg->student_id_receiver == $student) {
                if ($msg->delete_sender == 1) {
                    RoomStudent::destroy($id);
                    return response()->json(['Message deleted by receiver'],200);
                } else {
                    $msg->delete_receiver = '1';
                    $msg->update();
                    return response()->json(['Message updated(delete) by receiver'],200);
                }
            }
            else {
                return response()->json([
                    'Message or idStudent not found'
                ],200);
            }
        } catch(\Exception $e){
            //error_log($e->getMessage());
            return response()->json([
                'Error delete message by student!!'
            ],500);
        }

    }

    public function archiveRoomStudent(Request $request, $id, $student)
    {
        try {
            $room = Room::find($id);
            $roomLabel = $room->label;

            //get id sender by label room
            if (preg_match('/^[^_]+_(\w+)_\w*$/', $roomLabel, $matches)) {
                $senderIdLabelRoom = $matches[1];
            }
             //get id receiver by label room
            $receiverIdLabelRoom = preg_replace("/.*_([^_]*)/", "$1", $roomLabel,1);

            if ($senderIdLabelRoom == $student){
