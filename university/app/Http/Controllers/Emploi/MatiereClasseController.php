<?php

namespace App\Http\Controllers\Emploi;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\MatiereClasse;
use Illuminate\Http\Request;

class MatiereClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$response = Student::with('attendances')->where("id", "=", $id)->get();
        $response = Matiere::with('classes')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllMatiersFromClasseWithID($id)
    {
        //$response = Student::with('attendances')->where("id", "=", $id)->get();
        $response = Classe::with('matieres')->where("id", "=", $id)->get();
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
        return MatiereClasse::destroy($id);
    }
}
