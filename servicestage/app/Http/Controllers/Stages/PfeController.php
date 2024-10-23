<?php

namespace App\Http\Controllers\Stages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\MyTrait;
use App\Http\Controllers\Services\ConvertBase64;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PfeController extends Controller
{
    use MyTrait;
    use ConvertBase64;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/getAllDemandesFromStudentByCategoryStage/اقتراح مشروع تخرج في شركة/اقتراح مشروع تخرج تعليمي');
        $Stagespfe = json_decode($response);   
        return view('stagepfe.index', ['Stagespfe' => $Stagespfe]);
    }

    public function encadrement()
    {
        $response = Http::get($this->getUrlServer().'/getAllDemandesFromStudentByCategoryStage/اقتراح مشروع تخرج في شركة/اقتراح مشروع تخرج تعليمي');
        $Stagespfe = json_decode($response);   
        return view('encadrement.index', ['Stagespfe' => $Stagespfe]);
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
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes = json_decode($response);

        return view('stagepfe.show', ['demandes' => $demandes]);
    }

    public function showAffectation($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes = json_decode($response);

        return view('stagepfe.showAffectation', ['demandes' => $demandes]);
    }

    public function showAffectationBinome($id, $binome)
    {
        $response  = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes  = json_decode($response);
        
        $binome = DB::select('select students.nom as nom, students.prenom as prenom, students.cin as cin, classes.abbreviation as abbreviation 
        from students inner join classes where students.classe_id = classes.id and students.id = ?', [$binome]);

        return view('stagepfe.showBinome', ['demandes' => $demandes, 'binome' => $binome]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response);

        $response2 = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes = json_decode($response2);

        return view('stagepfe.edit', ['demandes' => $demandes, 'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePFE(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-pfeDirection/'.$id, [
            'info_societe_pfe'         => $request->input('info_societe_pfe'),
            'encadrant_industriel_pfe' => $request->input('encadrant_industriel_pfe'),
            'nom_societe_pfe'          => $request->input('nom_societe_pfe'),
            'encadrant_pfe'            => $request->input('encadrant_pfe'),
            'soutenance_pfe'           => $request->input('soutenance_pfe'),
            'datefin_pfe'              => $request->input('datefin_pfe'),
            'datedebut_pfe'            => $request->input('datedebut_pfe'),
            'nom_pfe'                  => $request->input('nom_pfe'),
            'problematique_pfe'        => $request->input('problematique_pfe'),
            'bibliographie_pfe'        => $request->input('bibliographie_pfe'),
            'desicion_pfe'             => $request->input('desicion_pfe'),
            'statut'                   => $request->input('statut')
        ]);
        error_log("-------------------------------------------------------".$response);
        return redirect()->back()->with('message', 'PFE est modifié avec succés');
    }

    public function updateProposition(Request $request, $id)
    {
        $file      = $request->proposition_pfe;
        $myFile    = $this->convertImage($file);
        $myExtFile = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-propositionPFE/'.$id, [
            'proposition_pfe' => $myFile,
            'extensionFile'   => $myExtFile,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier est modifié avec succés'); 
    }

    public function updateAttestation(Request $request, $id)
    {
        $file      = $request->attestation_stage_pfe;
        $myFile    = $this->convertImage($file);
        $myExtFile = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-attestationPFE/'.$id, [
            'attestation_stage_pfe' => $myFile,
            'extensionFile'         => $myExtFile,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier est modifié avec succés'); 
    }

    public function updateRapport(Request $request, $id)
    {
        $file      = $request->rapport_livrable_pfe;
        $myFile    = $this->convertImage($file);
        $myExtFile = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-rapportPFE/'.$id, [
            'rapport_livrable_pfe' => $myFile,
            'extensionFile'        => $myExtFile,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier est modifié avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-pfeDirection/'.$id);
        return redirect()->back(); 
    }
}
