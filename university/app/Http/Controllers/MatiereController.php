<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use Illuminate\Support\Facades\File;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Matiere::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllMatiere()
    {
        $response = Matiere::all();
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
        //return view('matiere.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $matiere = new Matiere;
        $matiere->subjectLabel     = $request->input('subjectLabel');
        $matiere->description      = $request->input('description');
        $matiere->volume           = $request->input('volume');
        $matiere->semestre         = $request->input('semestre');
        $matiere->nbr_eliminatoire = $request->input('nbr_eliminatoire');

        $matiere->save();
        //return redirect('/matieres')->with('message', 'Matière est ajoutée avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Matiere $matiere)
    {
        //return view('matiere.show', compact('matiere'));
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
        $matiere=Matiere::find($id);
        $matiere->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Matiere::destroy($id); 
    }
}
