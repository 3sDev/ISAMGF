<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\EmploiTeacher;
use App\Models\SalleEmploi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmploiTeacherController extends Controller
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

    public function getAllSeanceFromIdTeacher($id)
    {
        $response = EmploiTeacher::with('classe', 'matiere', 'salle')->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSeanceFromIdTeacherBySemestre($id, $semestre)
    {
        $response = EmploiTeacher::with('classe', 'matiere', 'salle')->where("teacher_id", "=", $id)
        ->where("semestre", "=", $semestre)->get();
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
        //Add seance
        $teacher = new EmploiTeacher;
        $teacher->classe_id   = $request->input('classe_id');
        $teacher->matiere_id  = $request->input('matiere_id');
        $teacher->salle_id    = $request->input('salle_id');
        $teacher->teacher_id  = $request->input('teacher_id');
        $teacher->jour        = $request->input('jour'); 
        $teacher->heure_debut = $request->input('heure_debut'); 
        $teacher->heure_fin   = $request->input('heure_fin');
        $teacher->type_seance = $request->input('type_seance');
        $teacher->semestre    = $request->input('semestre');
    
        $mySemestre  = $request->input('semestre');
        $startTime   = $request->input('heure_debut'); 
        $endTime     = $request->input('heure_fin');
        $type_seance = $request->input('type_seance');
        $intervalTable = ["08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30"];
        $keyStart = array_search($startTime, $intervalTable);
        $keyEnd   = array_search($endTime, $intervalTable)-$keyStart;
        $ids = array_slice($intervalTable, $keyStart, $keyEnd);
        // create sql part for IN condition by imploding comma after each id
        $in = '(\'' . implode('\',\'', $ids) .'\')';
        
        if ($mySemestre == '1') {
            $statutSalle = DB::select('select statut, id from salle_emplois where jour = ? and heure_debut IN '.$in.' and salle_id = ?',[$teacher->jour, $teacher->salle_id]);
        
            for($i = 0; $i <= count($ids); $i++){

                if ($statutSalle[$i]->statut == 0 && $type_seance == "15") {
                    $sql = DB::update('update salle_emplois set statut = 2 where id = ?', [$statutSalle[$i]->id]);
                }
                elseif ($statutSalle[$i]->statut == 2 && $type_seance == "15") {
                    $sql = DB::update('update salle_emplois set statut = 1 where id = ?', [$statutSalle[$i]->id]);
                }
                elseif ($statutSalle[$i]->statut == 0 && $type_seance == "1") {
                    $sql = DB::update('update salle_emplois set statut = 1 where id = ?', [$statutSalle[$i]->id]);
                }
                $teacher->save();
            }
        } 
        
        else {
            $statutSalle = DB::select('select statut, id from salle_emplois_2 where jour = ? and heure_debut IN '.$in.' and salle_id = ?',[$teacher->jour, $teacher->salle_id]);
        
            for($i = 0; $i <= count($ids); $i++){

                if ($statutSalle[$i]->statut == 0 && $type_seance == "15") {
                    $sql = DB::update('update salle_emplois_2 set statut = 2 where id = ?', [$statutSalle[$i]->id]);
                }
                elseif ($statutSalle[$i]->statut == 2 && $type_seance == "15") {
                    $sql = DB::update('update salle_emplois_2 set statut = 1 where id = ?', [$statutSalle[$i]->id]);
                }
                elseif ($statutSalle[$i]->statut == 0 && $type_seance == "1") {
                    $sql = DB::update('update salle_emplois_2 set statut = 1 where id = ?', [$statutSalle[$i]->id]);
                }
                $teacher->save();
            }
        }

        //return $teacher;
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
   		//Update statut of salle
        $seance = EmploiTeacher::find($id);
        $seanceDebut = $seance->heure_debut;
        $seanceFin   = $seance->heure_fin;
        $seanceJour  = $seance->jour;
        $seanceSalle = $seance->salle_id;
        $type_seance = $seance->type_seance;

        $statutSalle = DB::select('select statut from salle_emplois where jour = ? and heure_debut = ? and heure_fin = ? and salle_id = ?',[$seanceJour, $seanceDebut, $seanceFin, $seanceSalle]);
        
        if ($statutSalle[0]->statut == 1 && $type_seance == "15") {
            DB::update('update salle_emplois set statut = ? where jour = ? and heure_debut = ? and heure_fin = ?
            and salle_id = ?',[2, $seanceJour, $seanceDebut, $seanceFin, $seanceSalle]);
        }
        elseif ($statutSalle[0]->statut == 2 && $type_seance == "15") {
            DB::update('update salle_emplois set statut = ? where jour = ? and heure_debut = ? and heure_fin = ?
            and salle_id = ?',[0, $seanceJour, $seanceDebut, $seanceFin, $seanceSalle]);
        }
        if ($statutSalle[0]->statut == 1 && $type_seance == "1") {
            DB::update('update salle_emplois set statut = ? where jour = ? and heure_debut = ? and heure_fin = ?
            and salle_id = ?',[0, $seanceJour, $seanceDebut, $seanceFin, $seanceSalle]);
        }
        
        //Delete seance
        return EmploiTeacher::destroy($id);
    }

    public function destroySeanceFromSemestre($id)
    {
        //Get info from seance
        $seance = EmploiTeacher::find($id);
        $seanceDebut = $seance->heure_debut;
        $seanceFin   = $seance->heure_fin;
        $seanceJour  = $seance->jour;
        $seanceSalle = $seance->salle_id;
    
        $mySemestre  = $seance->semestre;
        $startTime   = $seanceDebut;
        $endTime     = $seanceFin ;
        $type_seance = $seance->type_seance;
        $intervalTable = ["08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30"];
        $keyStart = array_search($startTime, $intervalTable);
        $keyEnd   = array_search($endTime, $intervalTable);
        $ids = array_slice($intervalTable, $keyStart, $keyEnd);
        // create sql part for IN condition by imploding comma after each id
        $in = '(\'' . implode('\',\'', $ids) .'\')';

        if ($mySemestre == "1") {
            $statutSalle = DB::select('select statut, id from salle_emplois where jour = ? and heure_debut IN '.$in.' and salle_id = ?',[$seanceJour, $seanceSalle]);
        
            for($i = 0; $i <= count($ids); $i++){

                if ($statutSalle[$i]->statut == 1 && $type_seance == "15") {
                    $sql = DB::update('update salle_emplois set statut = 2 where id = ?', [$statutSalle[$i]->id]);
                }
                elseif ($statutSalle[$i]->statut == 2 && $type_seance == "15") {
                    $sql = DB::update('update salle_emplois set statut = 0 where id = ?', [$statutSalle[$i]->id]);
                }
                elseif ($statutSalle[$i]->statut == 1 && $type_seance == "1") {
                    $sql = DB::update('update salle_emplois set statut = 0 where id = ?', [$statutSalle[$i]->id]);
                }
                EmploiTeacher::destroy($id);
            }
        } 
        
        else {
            $statutSalle = DB::select('select statut, id from salle_emplois_2 where jour = ? and heure_debut IN '.$in.' and salle_id = ?',[$seanceJour, $seanceSalle]);
        
            for($i = 0; $i <= count($ids); $i++){

                if ($statutSalle[$i]->statut == 1 && $type_seance == "15") {
                    $sql = DB::update('update salle_emplois_2 set statut = 2 where id = ?', [$statutSalle[$i]->id]);
                }
                elseif ($statutSalle[$i]->statut == 2 && $type_seance == "15") {
                    $sql = DB::update('update salle_emplois_2 set statut = 0 where id = ?', [$statutSalle[$i]->id]);
                }
                elseif ($statutSalle[$i]->statut == 1 && $type_seance == "1") {
                    $sql = DB::update('update salle_emplois_2 set statut = 0 where id = ?', [$statutSalle[$i]->id]);
                }
                EmploiTeacher::destroy($id);
            }
            
        }
    //Delete seance
    //return EmploiTeacher::destroy($id);
    }
}
