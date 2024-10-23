<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Pointage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PointageController extends Controller
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

    public function getAllPointages()
    {
        $response = Pointage::with('teacher', 'matiere')->where('semestre', '=', '1')->orderBy('created_at', 'DESC')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPointageS2()
    {
        $response = Pointage::with('teacher', 'matiere')->where('semestre', '=', '2')->orderBy('created_at', 'DESC')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPointagesFromTeacher($id)
    {
        $response = Pointage::with('teacher', 'matiere')->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getPointageById($id)
    {
        $response = Pointage::with('teacher', 'matiere')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getHistoriquePointageByDay($teacher, $day)
    {
        $response = Pointage::with('teacher', 'matiere')->where("jour", "=", $day)
                            ->where("teacher_id", "=", $teacher)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getHistoriquePointageByDayAndDate($teacher, $day, $date)
    {
        $response = Pointage::with('teacher', 'matiere')->where("jour", "=", $day)
                            ->where("teacher_id", "=", $teacher)
                            ->where("date_pointage", "like", $date.'%')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getHistoriquePointageByDates($teacher, $date1, $date2)
    {
        $response = Pointage::with('teacher', 'matiere')->where("teacher_id", "=", $teacher)
                            ->whereBetween('date_pointage', [$date1, $date2])->get();
        $data = json_decode($response);
        return $data;
    }


    //count
    public function getCountPointagesToday()
    {
        $response = Pointage::where("created_at", "=", now())->count();
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
        $pointage = new Pointage;
        $pointage->lat           = $request->input('lat');
        $pointage->lng           = $request->input('lng');
        $pointage->nom_classe    = $request->input('nom_classe');
        $pointage->description   = $request->input('description');
        $pointage->jour          = $request->input('jour');
        $pointage->date_pointage = $request->input('date_pointage');
        $pointage->salle         = $request->input('salle');
        $pointage->heure_debut   = $request->input('heure_debut');
        $pointage->heure_fin     = $request->input('heure_fin');
        $pointage->nom_matiere   = $request->input('nom_matiere');
        $pointage->type_matiere  = $request->input('type_matiere');
        $pointage->semestre      = $request->input('semestre');
        
        $pointage->teacher_id    = $request->input('teacher_id');
        $pointage->seance_id     = $request->input('seance_id'); 
        $pointage->save();
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
        $pointage = Pointage::find($id);

        $pointage->lat           = $request->input('lat');
        $pointage->lng           = $request->input('lng');
        $pointage->nom_classe    = $request->input('nom_classe');
        $pointage->description   = $request->input('description');
        $pointage->jour          = $request->input('jour'); 
        $pointage->salle         = $request->input('salle'); 
        $pointage->heure_debut   = $request->input('heure_debut'); 
        $pointage->heure_fin     = $request->input('heure_fin'); 
        $pointage->nom_matiere   = $request->input('nom_matiere'); 
        $pointage->type_matiere  = $request->input('type_matiere'); 
        $pointage->teacher_id    = $request->input('teacher_id'); 
        $pointage->seance_id     = $request->input('seance_id'); 
        $pointage->semestre      = $request->input('semestre');
        $pointage->date_pointage = $request->input('date_pointage');

        $pointage->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Pointage::destroy($id);
    }
}
