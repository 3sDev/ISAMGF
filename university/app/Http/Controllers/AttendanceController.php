<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ladumor\OneSignal\OneSignal;

class AttendanceController extends Controller
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

    public function getAllStudentsWithProfiles()
    {
        //$response = Student::with('profileStudent')->get();
        $response = Student::all();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllStudentsWithClasse()
    {
        $response = Student::with('classe')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllAttendanceWithStudentFromId($id)
    {
        $response = Student::with('attendances')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllStudentsWithClasseDetails()
    {
        $response = Attendance::with('student', 'classe', 'matiere', 'teacher')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllStudentsWithClasseDetailsByIDattendance($id)
    {
        $response = Attendance::with('student', 'classe', 'matiere', 'teacher')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    //get All Attendances By Teacher From LastMonth
    public function getAllAttendancesTeacherFromLastMonth($teacher)
    {
        $dateNow   = date("Y-m-d");
        $LastMonth = date("Y-m-d", strtotime("-1 months"));

        $response = Attendance::with('student', 'classe', 'matiere', 'teacher')->where("teacher_id", "=", $teacher)
                              ->whereBetween('attendance_date', [$LastMonth, $dateNow])->get();
        $data = json_decode($response);
       	return $data;
    }

    //get All Attendances By Teacher From Class ID
    public function getAllAttendancesTeacherFromClassId($teacher, $classe)
    {
        $response = Attendance::with('student', 'classe', 'matiere', 'teacher')->where("teacher_id", "=", $teacher)
                                ->where("classe_id", "=", $classe)->get();
        $data = json_decode($response);
       	return $data;
    }

    //get All Attendances By Teacher From Two date
    public function getAllAttendancesTeacherFromAllGroupWithDate($teacher, $dateMin, $dateMax)
    {
        $response = Attendance::with('student', 'classe', 'matiere', 'teacher')->where("teacher_id", "=", $teacher)
                                ->whereBetween('attendance_date', [$dateMin, $dateMax])->get();
        $data = json_decode($response);
            return $data;
    }

    //get All Attendances By Teacher From LastMonth and Class ID
    public function getAllAttendancesTeacherFromLastMonthByIdClass($teacher, $classe, $dateMin, $dateMax)
    {
        $response = Attendance::with('student', 'classe', 'matiere', 'teacher')->where("teacher_id", "=", $teacher)
                                ->whereBetween('attendance_date', [$dateMin, $dateMax])
                                ->where("classe_id", "=", $classe)->get();
        $data = json_decode($response);
            return $data;
    }

    public function getAllStudentsWithClasseDetailsClasse($classe)
    {
        $response = Attendance::with('student', 'classe', 'matiere', 'teacher')->where("classe_id", "=", $classe)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getPresenceParIdEtudiant($id)
    {
        $sql = DB::select('SELECT attendances.attendance_date as date, attendances.attendance_seance_debut as seance_debut, attendances.attendance_seance_fin as seance_fin, attendances.attendance_statut as statut, attendances.justification as justification,attendances.date_justification as datejustification,matieres.subjectLabel as matiere, matieres.description as typeMatiere, matieres.volume as volumeMatiere, matieres.nbr_eliminatoire as nbrEliminatoireMatiere FROM attendances,students,matieres WHERE attendances.student_id = students.id and attendances.matiere_id = matieres.id and students.id = ?', [$id]);
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
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $ID_Classe            = $request->classe_id;
        $ID_Matiere           = $request->matiere_id;
        $ID_Student           = $request->student_id;
        $ID_Teacher           = $request->teacher_id;
        $Presence             = $request->presence;
        $QuiSave              = $request->qui_save_absent;
        $date_absence         = $request->date_absence;
        $seance_absence_debut = $request->seance_absence_debut;
        $seance_absence_fin   = $request->seance_absence_fin;

        //Get array from ids Students without attendance
        $IDin = '(\'' . implode('\',\'', $ID_Student) .'\')';
        $sqlStudentsID = DB::select('select student_id from attendances  where classe_id = '.$ID_Classe.' and matiere_id = '.$ID_Matiere.' 
        and teacher_id = '.$ID_Teacher.' and attendance_date = "'.$date_absence.'" and attendance_seance_debut = "'.$seance_absence_debut.'" 
        and attendance_seance_fin = "'.$seance_absence_fin.'" and student_id in '.$IDin);

        $newTableR = [];
        foreach ($sqlStudentsID as $key => $value) {
            array_push($newTableR, (string)$value->student_id);
        }

        $diff1 = array_diff($newTableR, $ID_Student);
        $diff2 = array_diff($ID_Student, $newTableR);
        $idStudentsUnreserved = array_merge($diff1, $diff2);

        foreach ($idStudentsUnreserved as $key => $insert) {
            if ($Presence[$key] == 'A') {
                $datasave = [
                    'classe_id'               => $ID_Classe,
                    'matiere_id'              => $ID_Matiere,
                    'student_id'              => $idStudentsUnreserved[$key],
                    'teacher_id'              => $ID_Teacher,
                    'attendance_date'         => $date_absence,
                    'attendance_seance_debut' => $seance_absence_debut,
                    'attendance_seance_fin'   => $seance_absence_fin,
                    'attendance_statut'       => $Presence[$key],
                    'qui_save_absent'         => $QuiSave,
                    'created_at'              => now(),
                    'updated_at'              => now(),
                ];
                DB::table('attendances')->insert($datasave);
            }
        }

        //Notification Attendance Students
        $IDin = '(\'' . implode('\',\'', $idStudentsUnreserved) .'\')';
        $resultIDonesignal = [];
        $sqlNotif   = DB::select('select api_onesignal from students_onesignal where student_id in '.$IDin);
        $sqlMatiere = DB::select('select subjectLabel, description from matieres where id = ? ', [$ID_Matiere]);
        $sqlTitre   = DB::select('select label from notifmodels where id = 4');
        //Fill apiOneSignal by id student
        foreach ($sqlNotif as $key => $value) {
            if ($value->api_onesignal) {
                array_push($resultIDonesignal, $value->api_onesignal);
            }
        }
        
        //Message of notification
        $message = $sqlMatiere[0]->subjectLabel.' '.$seance_absence_debut .'-'.$seance_absence_fin.' / '.$date_absence; 
        //Structure notification
        $fields['include_player_ids'] = $resultIDonesignal;
        $fields['contents']           = array("en" => $message);
        $fields['headings']           = array("en" => $sqlTitre[0]->label);
        //Send notification
        OneSignal::sendPush($fields);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $avis = Attendance::find($id);
        $avis->justification      = $request->input('justification');
        $avis->date_justification = $request->input('date_justification');
        $avis->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Attendance::destroy($id);
    }
}
