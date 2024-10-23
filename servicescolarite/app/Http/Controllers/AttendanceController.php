<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

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

    public function classeAttendance()
    {
        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendance-details');
        $attendances = json_decode($response2); 

        return view('attendance.class', ['classes' => $classes, 'attendances' => $attendances]);
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
        $arrayIndexPresence   = [];
        $arrayValuesPresence  = [];
        $arrayValueId         = [];
        $ids       = $request->input('student_id');
        $presences = $request->input('presence');

        //Get index of array when presence = A
        foreach ($presences as $key => $value) {
            if ($value == 'A') {
                array_push($arrayIndexPresence, $key);
            }
        }

        //Get array when presence = A
        foreach ($presences as $key => $value) {
            if ($value == 'A') {
                array_push($arrayValuesPresence, $value);
            }
        }
        
        //Get value of array from index presence
        for($i = 0; $i < count($arrayIndexPresence); $i++) {
            array_push($arrayValueId, $ids[$arrayIndexPresence[$i]]);
        }

        $response = Http::post($this->getUrlServer().'/attendances-students', [
            'classe_id'               => $request->input('classe_id'),
            'matiere_id'              => $request->input('matiere_id'),
            'student_id'              => $arrayValueId,
            'teacher_id'              => $request->input('teacher_id'),
            'date_absence'            => $request->input('date_absence'),
            'seance_absence_debut'    => $request->input('attendance_seance_debut'),
            'seance_absence_fin'      => $request->input('attendance_seance_fin'),
            'presence'                => $arrayValuesPresence,
            'qui_save_absent'         => 'Admin',
        ]);
        error_log("Save Attendances Students: ".$response);
        //error_log("Presence-----------------------------> ".$request->input('presence'));

        $response1 = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response1); 
        $response2 = Http::get($this->getUrlServer().'/attendance-details');
        $attendances = json_decode($response2); 

        return redirect('classe-student-attendance')->with('status', 'Les absences sont ajoutés avec succés!');
        //return view('attendance.class', ['classes' => $classes, 'attendances' => $attendances]);
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

        $mySemestre = $request->dateattendance;
        $semestreTest = date('m-d', strtotime($mySemestre));
        $Semestre_1_DateBegin = date('m-d', strtotime('09/01'));
        $Semestre_1_DateEnd   = date('m-d', strtotime('12/31'));
        if ($semestreTest >= $Semestre_1_DateBegin && $semestreTest <= $Semestre_1_DateEnd){
            $semestre = "1";
        }
        else {
            $semestre = "2";
        }

        $dateAbs = $request->dateattendance;
        //$seanceAbs = $request->seanceattendance;
        $thisDay = date('l', strtotime($dateAbs));
        if ($thisDay == 'Monday') {
            $seanceAbs = 'Lundi';
        }
        elseif ($thisDay == 'Tuesday') {
            $seanceAbs = 'Mardi';
        }
        elseif ($thisDay == 'Wednesday') {
            $seanceAbs = 'Mercredi';
        }
        elseif ($thisDay == 'Thursday') {
            $seanceAbs = 'Jeudi';
        }
        elseif ($thisDay == 'Friday') {
            $seanceAbs = 'Vendredi';
        }
        elseif ($thisDay == 'Saturday') {
            $seanceAbs = 'Samedi';
        }
        else {
            $seanceAbs = 'Dimanche';
        }

        $response = Http::get($this->getUrlServer().'/name-classe/'.$classe);
        $classResult = json_decode($response);

        $response2 = Http::get($this->getUrlServer().'/students-classes/'.$classe);
        $students  = json_decode($response2);

        $response3 = Http::get($this->getUrlServer().'/teachers');
        $teachers  = json_decode($response3);

        $response4 = Http::get($this->getUrlServer().'/matieres');
        $matieres  = json_decode($response4);

        $response5 = Http::get($this->getUrlServer().'/emploi-classe-day-semestre/'.$classe.'/'.$seanceAbs.'/'.$semestre);
        $seancesClass  = json_decode($response5);

        return view('attendance.create', ['classeId' => $classe, 'classResult' => $classResult, 'dateAbs' => $dateAbs, 
        'students' => $students, 'seanceAbs' => $seanceAbs, 'teachers' => $teachers, 
        'matieres' => $matieres, 'seancesClass' => $seancesClass, 'semestre' => $semestre]);
    }

    public function showJustification(Request $request)
    {
        $classe  = $request->classe_id;
        $dateAbs = $request->dateattendance;

        $response = Http::get($this->getUrlServer().'/name-classe/'.$classe);
        $classResult = json_decode($response);

        $response = Http::get($this->getUrlServer().'/students-classes/'.$classe);
        $students = json_decode($response);

        // if ($dateAbs) {
            //return print('myDate = '.$dateAbs.'hello if');
        $response3 = Http::get($this->getUrlServer().'/attendance-details-classe/'.$classe);
        $attendances = json_decode($response3);
        //return $attendances;
        return view('attendance.justification_class', ['classResult' => $classResult, 'dateAbs' => $dateAbs
        , 'students' => $students, 'attendances' => $attendances]);
        // }

        // else {
        //     $response3 = Http::get($this->getUrlServer().'/attendance-details-classe/'.$classe);
        //     $attendances = json_decode($response3);

        //     return view('attendance.justification_class', ['classResult' => $classResult, 'dateAbs' => $dateAbs
        //     , 'students' => $students, 'attendances' => $attendances]);
        // }

        
    }
    
    public function selectJustification()
    {
        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendance-details');
        $attendances = json_decode($response2); 
        //return $attendances;
        return view('attendance.justification_index', ['classes' => $classes, 'attendances' => $attendances]);
    }



    public function selectElimination()
    {
        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response); 

        return view('attendance.elimination', ['classes' => $classes]);
    }
    public function getMatiere(Request $request)
    {
        $states = DB::table("matiere_classes")
                ->select('matiere_classes.matiere_id', 'matieres.subjectLabel', 'matieres.description', 'matieres.semestre', 'matieres.nbr_eliminatoire')
                ->join('matieres','matieres.id','=','matiere_classes.matiere_id')
                ->where("matiere_classes.classe_id", $request->classe_id) //->where("classe_id", 1)
                ->where("matieres.semestre", "=", $request->semestre)
                ->get("matiere_classes.matiere_id", "matieres.subjectLabel", "matieres.description", "matieres.nbr_eliminatoire");
                error_log($states);
                //return ($states);
        return response()->json($states);
    }
    public function getElimination(Request $request)
    {
        $idClasse  = $request->classe_id;
        $semestre  = $request->semestre;
        $matiere = $request->matiere_id;
        
        $idMatiere = explode("/", $matiere)[0];
        $nombreElimination = explode("/", $matiere)[1];

        $listeStudents = DB::select('SELECT DISTINCT(s.cin) as cin,s.id as idStudent, s.nom as nomStudent, s.prenom as prenomStudent, s.profile_image as photoStudent, (SELECT COUNT(a.attendance_statut) 
        from attendances as a WHERE a.attendance_statut = "A" and s.id = a.student_id and a.matiere_id = ?) as nbr
        FROM students s
        JOIN classes c  ON s.classe_id = c.id
        LEFT JOIN  attendances a ON s.id = a.student_id
        LEFT JOIN  matieres m ON m.id = a.matiere_id
        WHERE  c.id = ?', [$idMatiere , $idClasse]);

        $response = Http::get($this->getUrlServer().'/name-classe/'.$idClasse);
        $classResult = json_decode($response);
        $response2 = Http::get($this->getUrlServer().'/matiere/'.$idMatiere);
        $dataMatiere = json_decode($response2);

        return view('attendance.elimination-details', ['idClasse' => $idClasse, 'semestre' => $semestre, 'dataMatiere' => $dataMatiere,
        'nombreElimination' => $nombreElimination, 'classResult' => $classResult, 'listeStudents' => $listeStudents]);
    }



    public function disponibiliteSalle()
    {

        // array of $ids that you need to select

        $startTime = "08:30";
        $endTime = "10:00";
        $intervalTable = ["08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", 
        "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30"];
        $keyStart = array_search($startTime, $intervalTable);
        $keyEnd   = array_search($endTime, $intervalTable);
        $ids = array_slice($intervalTable, $keyStart, $keyEnd);
        // create sql part for IN condition by imploding comma after each id
        $in = '(\'' . implode('\',\'', $ids) .'\')';
        // create sql
        $sql = DB::select('SELECT salle_id, heure_debut, statut FROM salle_emplois WHERE jour="Lundi" AND heure_debut IN ' . $in);


        $resFilter = $sql; 
        $testLeng = count($ids);  // le nombre des séances 
        $newTableR = [];

        $newFT = array_chunk($resFilter, $testLeng);
        foreach($resFilter as $key => $value) {
            if ($value->statut == 0) {
                array_push($newTableR, $value->salle_id);               
            }
        }
        //print_r( $newTableR);

        $newTableFinal = array_count_values($newTableR);
        //print_r( $newTableFinal);
        $tableSalleId = [];
        foreach($newTableFinal as $key => $value) {
            if ($value == $testLeng) {
                array_push($tableSalleId, $key);               
            }
        }

        // create sql part for IN condition by imploding comma after each id
        $in2 = '(\'' . implode('\',\'', $tableSalleId) .'\')';
        // create sql
        $sql2 = DB::select('SELECT id, fullNAme FROM salles WHERE id IN ' . $in2);
        $listeSalles = $sql2;
        return $listeSalles;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/attendance-details/'.$id);
        $attendances = json_decode($response);
        //return $attendances;

        return view('attendance.edit', ['attendances' => $attendances]);
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
        $response = Http::put($this->getUrlServer().'/attendance/'.$id, [
            'justification'      => $request->input('justification'),
            'date_justification' => $request->input('date_justification'),
        ]);
        return redirect()->back()->with('message', 'Absence est modifiée avec succés');
    }

    public function requeteAttendance() {

        $sql = DB::select('SELECT DISTINCT(s.cin) as cin,s.id as idStudent,(SELECT COUNT(a.attendance_statut) from attendances as a WHERE a.attendance_statut = "A" and s.id = a.student_id and a.matiere_id = 3) as nbr
                            FROM students s
                            JOIN classes c  ON s.classe_id = c.id
                            LEFT JOIN  attendances a ON s.id = a.student_id
                            LEFT JOIN  matieres m ON m.id = a.matiere_id
                            WHERE  c.id = 1');

        $resFilter = $sql; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-attendance-student/'.$id);
        return redirect()->back()->with('message', 'Absence est supprimée avec succés');
    }
}
