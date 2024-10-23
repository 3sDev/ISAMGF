<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AttendanceController extends Controller
{
    use Services\MyTrait;
    use Services\ConvertBase64;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/students-classes');
        $students = json_decode($response);   
        return view('attendance.index', ['students' => $students]);
    }

    public function listOfTeachers()
    {
        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response);   
        return view('presence.index', ['teachers' => $teachers]);
    }

    public function saisirPresence($id)
    {
        $response = Http::get($this->getUrlServer().'/teacher/'.$id);
        $teachers = json_decode($response);   

        $response2 = Http::get($this->getUrlServer().'/attendance-teacher-new/'.$id);
        $attendances = json_decode($response2);

        return view('presence.create', ['teachers' => $teachers, 'attendances' => $attendances]);
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
        $response = Http::post($this->getUrlServer().'/add-attendance-teacher', [
            'teacher_id'      => $request->input('teacher_id'),
            'attendance_date' => $request->input('attendance_date'),
        ]);
    
        return redirect()->back();  
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $classe  = $request->classe_id;
        $dateAbs = $request->dateattendance;

        $response = Http::get($this->getUrlServer().'/name-classe/'.$classe);
        $classResult = json_decode($response);

        $response = Http::get($this->getUrlServer().'/students-classes/'.$classe);
        $students = json_decode($response);

        return view('attendance.show', ['classResult' => $classResult, 'dateAbs' => $dateAbs, 'students' => $students]);
    }

    public function showJustification(Request $request)
    {
        $classe  = $request->classe_id;
        $dateAbs = $request->dateattendance;

        $response = Http::get($this->getUrlServer().'/name-classe/'.$classe);
        $classResult = json_decode($response);

        $response = Http::get($this->getUrlServer().'/students-classes/'.$classe);
        $students = json_decode($response);

        //return $dateAbs;

        if ($dateAbs != '') {
            //return print('myDate = '.$dateAbs.'hello if');
            $response3 = Http::get($this->getUrlServer().'/attendance-details/'.$dateAbs.'/'.$classe);
            $attendances = json_decode($response3);
            return view('attendance.justification_class', ['classResult' => $classResult, 'dateAbs' => $dateAbs
            , 'students' => $students, 'attendances' => $attendances]);
        }
        else {
            //return print('myDate = '.$dateAbs.'hello else');
            $response3 = Http::get($this->getUrlServer().'/attendance-details-classe/'.$classe);
            $attendances = json_decode($response3);
            return view('attendance.justification_class', ['classResult' => $classResult, 'dateAbs' => $dateAbs
            , 'students' => $students, 'attendances' => $attendances]);
        }

        
    }

    public function selectJustification()
    {
        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendance-details');
        $attendances = json_decode($response2); 

        return view('attendance.justification_index', ['classes' => $classes, 'attendances' => $attendances]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/attendance-details-teacher/'.$id);
        $attendances = json_decode($response);

        return view('presence.edit', ['attendances' => $attendances]);
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
        $response = Http::put($this->getUrlServer().'/update-attendance-teacher/'.$id, [
            'attendance_date'    => $request->input('attendance_date'),
            'justification'      => $request->input('justification'),
            'date_justification' => $request->input('date_justification'),
           ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-attendance-teacher/'.$id);
        return redirect()->back();
    }

    // public function store(Request $request)
    // {
    //     $now = new \DateTime();
    //     $date_absence = $now->format('Y-m-d H:i:s');

    //     $ID_Classe  = $request->classe_id;
    //     $ID_Matiere = $request->matiere_id;;
    //     $ID_Student = $request->student_id;
    //     foreach ($ID_Student as $key => $insert) {
    //         $datasave = [
    //             'classe_id'         => $ID_Classe[$key],
    //             'matiere_id'        => $ID_Matiere[$key],
    //             'student_id'        => $ID_Student[$key],
    //             'attendance_date'   => $date_absence,
    //             'attendance_statut' => 'absent',
    //         ];
    //         DB::table('attendances')->insert($datasave);
    //     }
    //     return view('attendance.show');
    // }
}
