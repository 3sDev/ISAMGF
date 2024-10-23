<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Voeu;
use App\Models\VoeuMatiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoeuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Voeu::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllVoeux()
    {
        $response = Voeu::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllVoeuxWithTeacherByIdTeacher($id)
    {
        //$response = Voeu::with('teacher', 'matieres')->get();
        //$data = json_decode($response);
       	//return $data;
        $sql = DB::select('SELECT v.AU as anneeUniversitaire, v.semestre as semestre, v.jour as jourPrefere, v.teacher_id as idTeacher, m.subjectLabel as nomMatiere, m.description as typeMatiere FROM voeus v INNER JOIN voeu_matieres vm INNER JOIN matieres m WHERE v.id = vm.voeu_id and m.id = vm.matiere_id and v.teacher_id = ?', [$id]);
        return $sql;
    }

    public function getAllVoeuxWithTeacherByIdTeacherAndSemestre($id, $semestre)
    {
        $sql = DB::select('SELECT v.AU as anneeUniversitaire, v.semestre as semestre, v.jour as jourPrefere, v.teacher_id as idTeacher, m.subjectLabel as nomMatiere, m.description as typeMatiere FROM voeus v INNER JOIN voeu_matieres vm INNER JOIN matieres m WHERE v.id = vm.voeu_id and m.id = vm.matiere_id and v.semestre = ? and v.teacher_id = ?', [$semestre, $id]);
        return $sql;
    }

    public function getAllTeachersWithVoeux()
    {
        $response = Teacher::with('voeux', 'vouexMatieres')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getVoeuFromIdTeacher($id)
    {
        $response = Teacher::with('voeux', 'vouexMatieres')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getAllVoeuxWithTeacherFromIdTeacher($id)
    {
        $response = Voeu::with('teacher', 'vouexMatieres', 'matieres')->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllVoeuxWithTeacherFromIdVoeu($id)
    {
        $response = Voeu::with('teacher', 'vouexMatieres')->where("id", "=", $id)->get();
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
        $voeu             = new Voeu;
        $voeu->AU         = $request->input('AU');
        $voeu->semestre   = $request->input('semestre');
        $voeu->jour       = $request->input('jour');
        $voeu->teacher_id = $request->input('teacher_id');
       
        $voeu->save();
        return $voeu;
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
        $voeu = Voeu::find($id);
        $voeu->AU         = $request->input('AU');
        $voeu->semestre   = $request->input('semestre');
        $voeu->jour       = $request->input('jour');
        $voeu->teacher_id = $request->input('teacher_id');

        $voeu->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Voeu::destroy($id);
    }
}
