<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Level;
use App\Models\Classe;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $etudiants = Classe::join('etudiants', 'etudiants.classe_id', '=', 'classes.id')
        ->get(['classes.classeName', 'etudiants.*']);

        return view('etudiant.index', ['etudiants' => $etudiants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();
        $classes = Classe::all();
        return view('etudiant.create', ['levels' => $levels, 'classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $etudiant = new Etudiant();
        $etudiant->matricule = $request->input('matricule');
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->ddn = $request->input('ddn');
        $etudiant->genre = $request->input('genre');
        $etudiant->email = $request->input('email');
        $etudiant->phone = $request->input('phone');
        $etudiant->gov = $request->input('gov');
        $etudiant->rue = $request->input('rue');
        $etudiant->codepostal = $request->input('codepostal');
        $etudiant->login = $request->input('login');
        $etudiant->password = $request->input('password');
        $etudiant->level_id = $request->input('level_id');
        $etudiant->classe_id = $request->input('classe_id');
        
        if($request->hasfile('profile_image'))
        {

        $file = $request->file('profile_image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('upload/students/', $filename);
        $etudiant->profile_image = $filename;
        }

        $etudiant->save();
        return redirect('/etudiants')->with('message', 'Etudiant est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        return view('etudiant.show', compact('etudiant'));
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
