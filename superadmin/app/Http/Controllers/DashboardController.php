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
        $response1   = Http::get($this->getUrlServer().'/countAllCourriersEntrants');
        $allEntrants = json_decode($response1);  
        $response2   = Http::get($this->getUrlServer().'/countAllCourriersSortants');
        $allSortants = json_decode($response2);  
        //Dashboard Cards
        $response3   = Http::get($this->getUrlServer().'/countAllStudents');
        $allStudents = json_decode($response3);  
        $response4   = Http::get($this->getUrlServer().'/countAllNombreTeachers');
        $allTeachers = json_decode($response4);
        $response5   = Http::get($this->getUrlServer().'/countAllNombrePersonnels');
        $allPersonnels = json_decode($response5);
        $response6   = Http::get($this->getUrlServer().'/countAllNombreAdmins');
        $allAdmins   = json_decode($response6);


        return view('dashboard', ['allStudents' => $allStudents, 'allTeachers' => $allTeachers, 'allPersonnels' => $allPersonnels, 
        'allAdmins' => $allAdmins, 'agenda' => $agenda]);
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
