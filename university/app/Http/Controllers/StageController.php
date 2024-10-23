<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Student;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Stage::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllStages()
    {
        $response = Stage::orderBy("created_at", "DESC")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getStageWithStudent($id)
    {
        //$response = Stage::with('student','profileStudent')->where("id", "=", $id)->get();
        //$response = Student::with('stages')->where("id", "=", $id)->get();
        $response = Student::with('demandesStudents')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllStageWithStudent()
    {
        //$response = Stage::with('student','profileStudent','classe')->get();
        $response = Stage::with('student','classe')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllStageWithStudentFromIdStage($id)
    {
        //$response = Stage::with('student','profileStudent','classe', 'user')->where("id", "=", $id)->get();
        $response = Stage::with('student','classe', 'user')->where("id", "=", $id)->get();
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
        //Service Convert rapport
        $extRapport  = $request->extRapport;
        $dataRapport = base64_decode($request->rapport_file); //decode base64 string
        $nameRapport = time().".$extRapport";
        $rapport     = "upload/stages/".$nameRapport;
        $moveRapport = file_put_contents($rapport, $dataRapport);

        //Service Convert attestation
        $extAttes    = $request->extAttestation;
        $dataAttes   = base64_decode($request->fichier); //decode base64 string
        $nameAttes   = time().".$extAttes";
        $attestation = "upload/stages/".$nameAttes;
        $moveAttes   = file_put_contents($attestation, $dataAttes);

        $stage                    = new Stage;
        $stage->type              = $request->input('type');
        $stage->nom_socite        = $request->input('nom_socite');
        $stage->info_socite       = $request->input('info_socite');
        $stage->encadrant_societe = $request->input('encadrant_societe');
        $stage->sujet             = $request->input('sujet');
        $stage->date_debut        = $request->input('date_debut');
        $stage->date_fin          = $request->input('date_fin');

        $stage->rapport_file      = $nameRapport;
        $stage->attesstation_file = $nameAttes;

        $stage->statut            = $request->input('statut');
        $stage->student_id        = $request->input('student_id');
        $stage->classe_id         = $request->input('classe_id');

        $stage->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Stage::destroy($id);
    }
}
