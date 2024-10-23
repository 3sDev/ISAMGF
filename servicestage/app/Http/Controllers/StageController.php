<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Classe;
use App\Models\Departements;
use App\Models\Section;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Http;

class StageController extends Controller
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
        $response = Http::get($this->getUrlServer().'/all-stages-student');
        $stages = json_decode($response);        
        return view('stage.index', ['stages' => $stages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = Departements::all();
        $classes = Classe::all();
        $levels = Level::all();

        $lvls = DB::table("levels")->pluck("levelLabel", "id");
        $cls = DB::table("classes")->pluck("classeName", "id");
        $users = User::all();

        return view('stage.create', ['levels' => $levels, 'classes' => $classes, 'departements' => $departements
        , 'lvls' => $lvls, 'cls' => $cls, 'users' => $users]);
    }

    public function getStudent(Request $request)
    {
        $states = DB::table("students")
            ->where("classe_id", $request->classe_id) //->where("classe_id", 1)
            ->pluck("full_name", "id");
        return response()->json($states);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idAdmin  = FacadesAuth::user()->id;

        //Rapport de stage
        $file1        = $request->rapport_file;
        $myRapport    = $this->convertAllFile($file1);
        $myExtRapport = $this->getExtensionFile($file1);
        //Attestation de stage
        $file2            = $request->attesstation_file;
        $myAttestation    = $this->convertAllFile($file2);
        $myExtAttestation = $this->getExtensionFile($file2);

        $response = Http::post($this->getUrlServer().'/stages', [
            'type'               => $request->input('type'),
            'nom_socite'         => $request->input('nom_socite'),
            'info_socite'        => $request->input('info_socite'),
            'encadrant_societe'  => $request->input('encadrant_societe'),
            'sujet'              => $request->input('sujet'),
            'date_debut'         => $request->input('date_debut'),
            'date_fin'           => $request->input('date_fin'),
            'statut'             => 'En cours',
            'rapport_file'       => $myRapport,
            'extRapport'         => $myExtRapport,
            'attesstation_file'  => $myAttestation,
            'extAttestation'     => $myExtAttestation,
            'student_id'         => $request->input('student_id'),
            'classe_id'          => $request->input('classe_id'),
            'user_id'            => $idAdmin,            
        ]);

        return redirect('/stages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/all-stages-student/'.$id);
        $stages = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/users/'.$id);
        $users = json_decode($response2); 

        return view('stage.show', ['stages' => $stages, 'users' => $users]);
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
        $classes = Classe::all();
        $levels = Level::all();

        $lvls = DB::table("levels")->pluck("levelLabel", "id");
        $cls = DB::table("classes")->pluck("classeName", "id");
        $users = User::all();

        $response = Http::get($this->getUrlServer().'/all-stages-student/'.$id);
        $stages = json_decode($response); 

        return view('stage.edit', ['levels' => $levels, 'classes' => $classes, 'departements' => $departements
        , 'lvls' => $lvls, 'cls' => $cls, 'users' => $users, 'stages' => $stages]);
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
        $image      = $request->image;
        $myImage64  = $this->convertImage($image);
        $myExtImg64 = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-stage/'.$id, [
            'titre'        => $request->input('titre'),
            'description'  => $request->input('description'),
            'date'         => $request->input('date'),
            'adresse'      => $request->input('adresse'),
            'rating'       => $request->input('rating'),
            'views'        => $request->input('views'),
            'image'        => $myImage64,
            'extensionImg' => $myExtImg64,
           ]);
        return redirect()->back()->with('message', 'Stage est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-stage/'.$id);
        return redirect()->back()->with('message', 'Stage est supprimée avec succés'); 
    }
}
