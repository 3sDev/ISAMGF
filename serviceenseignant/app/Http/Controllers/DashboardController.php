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

        $response = Http::get($this->getUrlServer().'/getAllNotesByIdAdmin/'.$idAdmin);
        $agenda = json_decode($response);   
        return view('dashboard', ['agenda' => $agenda]);
    }

    public function countIndicator()
    {
        $idAdmin  = Auth::user()->id;
        $response = Http::get($this->getUrlServer().'/getAllNotesByIdAdmin/'.$idAdmin);
        $agenda = json_decode($response);   

        $response = Http::get($this->getUrlServer().'/getCountDemandesTeachers/En cours');
        $demandeEnCours = json_decode($response);  
        $response2 = Http::get($this->getUrlServer().'/countAlldemandsTeachers');
        $allDemands = json_decode($response2); 
        $response3 = Http::get($this->getUrlServer().'/getCountReclamationsTeachers/En cours');
        $reclamationEnCours = json_decode($response3); 
        $response4 = Http::get($this->getUrlServer().'/countAllReclamationsTeachers');
        $allReclamations = json_decode($response4);
        $response5 = Http::get($this->getUrlServer().'/countAllNombreTeachers');
        $allTeachers = json_decode($response5); 
        $response6 = Http::get($this->getUrlServer().'/getCountRattrapagesTeachersByStatut');
        $rattrapageEncours = json_decode($response6); 
        $response7 = Http::get($this->getUrlServer().'/countAllRattrapagesTeachers');
        $allRattrapages = json_decode($response7); 

        $response8 = Http::get($this->getUrlServer().'/countTeachersByStatut/Permanant');
        $teacherPermanant = json_decode($response8); 
        $response9 = Http::get($this->getUrlServer().'/countTeachersByStatut/Contractuel doctorant');
        $teacherContractuel = json_decode($response9);
        $response10 = Http::get($this->getUrlServer().'/countTeachersByStatut/Expert');
        $teacherExpert = json_decode($response10);
        $response11 = Http::get($this->getUrlServer().'/countTeachersByStatut/Vacation');
        $teacherVacataire = json_decode($response11);
        
        return view('dashboard', ['demandeEnCours' => $demandeEnCours, 'allDemands' => $allDemands, 
        'reclamationEnCours' => $reclamationEnCours, 'allReclamations' => $allReclamations, 'allTeachers' => $allTeachers, 
        'rattrapageEncours' => $rattrapageEncours, 'allRattrapages' => $allRattrapages, 'agenda' => $agenda,
        'teacherPermanant' => $teacherPermanant, 'teacherContractuel' => $teacherContractuel, 'teacherExpert' => $teacherExpert,
        'teacherVacataire' => $teacherVacataire]);
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
