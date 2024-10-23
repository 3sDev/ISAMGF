<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Rattrapage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ladumor\OneSignal\OneSignal;

class RattrapageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Rattrapage::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllRattrapages()
    {
        $response = Rattrapage::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllRattrapagesWithTeacher()
    {
        $response = Rattrapage::with('teacher', 'classes', 'matieres', 'salles')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllRattrapagesWithTeacherFromIdTeacher($id)
    {
        $response = Rattrapage::with('teacher', 'classes', 'matieres', 'salles')->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getRattrapageByIdRattrapage($id)
    {
        $response = Rattrapage::with('teacher', 'classes', 'matieres', 'salles')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllRattrapagesWithTeacherFromIdClasseE1($id)
    {
        $response = Rattrapage::with('teacher', 'classes', 'matieres', 'salles')->where("classe_id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllRattrapagesWithTeacherFromIdClasseE2($id)
    {
        $sql = DB::select('SELECT rattrapages.id as id,rattrapages.date as date,rattrapages.heure as heure,rattrapages.duree as duree,matieres.subjectLabel as matiere,classes.classeName as classe,salles.fullName as salle,teachers.full_name as teacher FROM rattrapages INNER JOIN matieres ON matieres.id = rattrapages.matiere_id INNER JOIN classes ON classes.id = rattrapages.classe_id INNER JOIN salles ON salles.id = rattrapages.salle_id INNER JOIN teachers ON teachers.id = rattrapages.teacher_id and classes.id = ? ORDER BY rattrapages.date', [$id]);
        return $sql;
    }

    public function getAllRattrapagesWithTeacherFromDate($date)
    {
        $sql = DB::select('SELECT rattrapages.id as id,rattrapages.date as date, rattrapages.heure_debut as heure_debut, rattrapages.heure_fin as heure_fin, rattrapages.duree as duree, matieres.subjectLabel as matiere, matieres.description as matiereDescription, classes.abbreviation as classe,salles.fullName as salle,teachers.full_name as teacher FROM rattrapages INNER JOIN matieres ON matieres.id = rattrapages.matiere_id INNER JOIN classes ON classes.id = rattrapages.classe_id INNER JOIN salles ON salles.id = rattrapages.salle_id INNER JOIN teachers ON teachers.id = rattrapages.teacher_id and rattrapages.date = ? ORDER BY rattrapages.date', [$date]);
        return $sql;
    }

    //count
    public function getCountRattrapagesTeachersByStatut()
    {
        $response = Rattrapage::where("date", ">", now())->count();
        $data = json_decode($response);
        return $data;
    }
    public function countAllRattrapagesTeachers()
    {
        $response = Rattrapage::count();
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
        $rattrapage             = new Rattrapage;
        $rattrapage             = new Rattrapage;
        $rattrapage->date       = $request->input('date');
        $rattrapage->heure_debut= $request->input('heure_debut');
        $rattrapage->heure_fin  = $request->input('heure_fin');
        $rattrapage->duree      = $request->input('duree');
        $rattrapage->matiere_id = $request->input('matiere_id');
        $rattrapage->classe_id  = $request->input('classe_id');
        $rattrapage->salle_id   = $request->input('salle_id');
        $rattrapage->teacher_id = $request->input('teacher_id');
        $rattrapage->save();

        //Notification Attendance Students
        $sqlNotif   = DB::select('select students_onesignal.api_onesignal from students_onesignal inner join students where students_onesignal.student_id = students.id and students.classe_id = ? ',[$rattrapage->classe_id]);
        $sqlMatiere = DB::select('select subjectLabel from matieres where id = ? ', [$rattrapage->matiere_id]);
        $sqlSalle   = DB::select('select fullName from salles where id = ? ', [$rattrapage->salle_id]);
        $sqlTitre   = DB::select('select label from notifmodels where id = 3');
        
        //Fill apiOneSignal by id student
        $resultIDonesignal = [];
        foreach ($sqlNotif as $key => $values) {
            if ($values->api_onesignal) {
                array_push($resultIDonesignal, $values->api_onesignal);
            }
        }

        //Message of notification
        $fullDateRatt = $rattrapage->heure_debut."-".$rattrapage->heure_fin;
        $message = $sqlMatiere[0]->subjectLabel.' - '.$sqlSalle[0]->fullName." : ".$rattrapage->date." / ".$fullDateRatt; 
        
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
        $ratt = Rattrapage::find($id);
        $ratt->date       = $request->input('date');
        $ratt->heure_debut= $request->input('heure_debut');
        $ratt->heure_fin  = $request->input('heure_fin');
        $ratt->duree      = $request->input('duree');
        $ratt->matiere_id = $request->input('matiere_id');
        $ratt->classe_id  = $request->input('classe_id');
        $ratt->salle_id   = $request->input('salle_id');
        $ratt->teacher_id = $request->input('teacher_id');

        $ratt->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Rattrapage::destroy($id);
    }
}
