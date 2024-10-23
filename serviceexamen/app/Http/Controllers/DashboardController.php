<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class DashboardController extends Controller
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
        $idAdmin  = Auth::user()->id;

        $response = Http::get($this->getUrlServer().'/all-agenda-users/'.$idAdmin);
        $agenda = json_decode($response);   
        return view('dashboard', ['agenda' => $agenda]);
    }

    public function countIndicator()
    {
        $idAdmin  = Auth::user()->id;
        $response = Http::get($this->getUrlServer().'/getAllNotesByIdAdmin/'.$idAdmin);
        $agenda = json_decode($response);    

        //Statistic Students
        $response5 = Http::get($this->getUrlServer().'/countAllStudents');
        $allStudents = json_decode($response5); 
        //Statistic Demandes Students
        $response1 = Http::get($this->getUrlServer().'/getCountDemandesStudentsByTypeAndStatut/مصلحة الامتحانات/En cours');
        $studentDemandeTypeStatut = json_decode($response1); 
        $response2 = Http::get($this->getUrlServer().'/getCountDemandesStudentsByType/مصلحة الامتحانات');
        $studentDemandeType = json_decode($response2);
        //Statistic Rattrapages Students
        $response10 = Http::get($this->getUrlServer().'/getCountExamenTeacherByStatut/0');
        $allExamens = json_decode($response10); 
        $response11 = Http::get($this->getUrlServer().'/getCountExamenTeacherByStatut/1');
        $examensTraitee = json_decode($response11); 
        //Emploi examen Teachers
        $response12 = Http::get($this->getUrlServer().'/getCountEmploiExamenTeacher');
        $emploisExamen = json_decode($response12);
        //Emploi examen Students
        $response13 = Http::get($this->getUrlServer().'/getCountEmploiExamenStudent');
        $emploisExamenStudents = json_decode($response13);

        return view('dashboard', ['allStudents' => $allStudents, 'studentDemandeType' => $studentDemandeType,
        'studentDemandeTypeStatut' => $studentDemandeTypeStatut, 'agenda' => $agenda,'emploisExamen' => $emploisExamen,
        'emploisExamenStudents' => $emploisExamenStudents, 'allExamens' => $allExamens, 'examensTraitee' => $examensTraitee]);
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
        //
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
