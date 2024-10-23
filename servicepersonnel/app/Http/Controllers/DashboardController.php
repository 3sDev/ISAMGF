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

        $response = Http::get($this->getUrlServer().'/getCountDemandesPersonnelsWithStatut/En cours');
        $demandeEnCours = json_decode($response);  
        $response2 = Http::get($this->getUrlServer().'/countAlldemandsPersonnels');
        $allDemands = json_decode($response2); 
        $response3 = Http::get($this->getUrlServer().'/getCountReclamationsPersonnelsWithStatut/En cours');
        $reclamationEnCours = json_decode($response3); 
        $response4 = Http::get($this->getUrlServer().'/countAllReclamationsPersonnels');
        $allReclamations = json_decode($response4);
        $response5 = Http::get($this->getUrlServer().'/countAllNombrePersonnels');
        $allPersonnels = json_decode($response5); 
        $response7 = Http::get($this->getUrlServer().'/countAllAttendancesPersonnels');
        $allAttendances = json_decode($response7); 
        

        return view('dashboard', ['demandeEnCours' => $demandeEnCours, 'allDemands' => $allDemands, 
        'reclamationEnCours' => $reclamationEnCours, 'allReclamations' => $allReclamations, 'allPersonnels' => $allPersonnels, 
        'allAttendances' => $allAttendances, 'agenda' => $agenda]);
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
