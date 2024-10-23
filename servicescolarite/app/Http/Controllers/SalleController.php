<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departements;
use App\Models\Salle;

class SalleController extends Controller
{
    use Services\MyTrait;
    // private $urlServer = "http://smartschools.tn/university/public/api";
    // private $urlLocal  = "http://127.0.0.1:8080/api";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departements = Departements::all();
        $salles = Departements::join('salles', 'salles.department_id', '=', 'departements.id')
        ->get(['departements.departmentLabel', 'salles.id', 'salles.fullName', 'salles.abbreviation']);

        return view('salle.index', ['salles' => $salles, 'departements' => $departements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salle = new Salle;
        $salle->fullName = $request->input('fullName');
        $salle->abbreviation = $request->input('abbreviation');
        $salle->department_id = $request->input('department_id');

        $salle->save();
        return redirect('/salles')->with('message', 'Salle est ajoutée avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Salle $salle)
    {
        return view('salle.show', compact('salle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departements = Departements::all();
        $salles = Departements::join('salles', 'salles.department_id', '=', 'departements.id')
        ->get(['departements.departmentLabel', 'salles.id', 'salles.fullName', 'salles.abbreviation'])
        ->find($id);
        return view('salle.edit', ['salles' => $salles, 'departements' => $departements]);
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
        $salle = Salle::find($id);
        $salle->fullName = $request->input('fullName');
        $salle->abbreviation = $request->input('abbreviation');
        $salle->department_id = $request->input('department_id');

        $salle->update();
        return redirect('/salles')->with('message', 'Salle est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();
        return redirect()->back()->with('message', 'Salle est supprimée avec succés');
    }
}
