<?php

namespace App\Http\Controllers\Stages;

use App\Http\Controllers\Controller;
use App\Models\DemandeStudent;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PfeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $pfe = DemandeStudent::find($id);
        $pfe->info_societe_pfe         = $request->input('info_societe_pfe');
        $pfe->encadrant_industriel_pfe = $request->input('encadrant_industriel_pfe');
        $pfe->nom_societe_pfe          = $request->input('nom_societe_pfe');
        $pfe->encadrant_pfe            = $request->input('encadrant_pfe');
        $pfe->soutenance_pfe           = $request->input('soutenance_pfe');
        $pfe->datefin_pfe              = $request->input('datefin_pfe');
        $pfe->datedebut_pfe            = $request->input('datedebut_pfe');
        $pfe->nom_pfe                  = $request->input('nom_pfe');
        $pfe->problematique_pfe        = $request->input('problematique_pfe');
        $pfe->bibliographie_pfe        = $request->input('bibliographie_pfe');
        $pfe->desicion_pfe             = $request->input('desicion_pfe');
        $pfe->statut                   = $request->input('statut');
        $pfe->update();
    }

    public function updatePropositionPFE(Request $request, $id)
    {
        $pfe = DemandeStudent::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/demandesStudents/pfe/propositions/'.$pfe->proposition_pfe);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->proposition_pfe); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/demandesStudents/pfe/propositions/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $pfe->proposition_pfe; }
        $pfe->proposition_pfe = $nameFile3; 
        $pfe->update();   
    }

    public function updateAttestationPFE(Request $request, $id)
    {
        $pfe = DemandeStudent::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/demandesStudents/pfe/attestations/'.$pfe->attestation_stage_pfe);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->attestation_stage_pfe); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/demandesStudents/pfe/attestations/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $pfe->attestation_stage_pfe; }
        $pfe->attestation_stage_pfe = $nameFile3; 
        $pfe->update();   
    }
    
    public function updateRapportPFE(Request $request, $id)
    {
        $pfe = DemandeStudent::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/demandesStudents/pfe/rapports/'.$pfe->rapport_livrable_pfe);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->rapport_livrable_pfe); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/demandesStudents/pfe/rapports/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $pfe->rapport_livrable_pfe; }
        $pfe->rapport_livrable_pfe = $nameFile3; 
        $pfe->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DemandeStudent::destroy($id);
    }
}
