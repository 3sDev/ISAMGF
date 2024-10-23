<?php

namespace App\Http\Controllers\Stages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\MyTrait;
use App\Http\Controllers\Services\ConvertBase64;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProfessionnelController extends Controller
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
        $response = Http::get($this->getUrlServer().'/getAllDemandesFromStudentByCategoryStage/اجراء تربص مهني عامل/اجراء تربص مهني تقني');
        $Stagesprofessionnel = json_decode($response);   
        return view('stagepro.index', ['Stagesprofessionnel' => $Stagesprofessionnel]);
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

        return view('stagepro.show', ['demandes' => $demandes]);
    }

    public function showProTechnicien($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes = json_decode($response);

        return view('stagepro.showProTechnicien', ['demandes' => $demandes]);
    }

    public function showProOuvrier($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes = json_decode($response);

        return view('stagepro.showProOuvrier', ['demandes' => $demandes]);
    }

    public function showAffectTechnicien($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes = json_decode($response);

        return view('stagepro.showAffectTechnicien', ['demandes' => $demandes]);
    }

    public function showAffectOuvrier($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes = json_decode($response);

        return view('stagepro.showAffectOuvrier', ['demandes' => $demandes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandes = json_decode($response);

        return view('stagepro.edit', ['demandes' => $demandes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePro(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-proDirection/'.$id, [
            'stage_company'           => $request->input('stage_company'),
            'stage_info_company'      => $request->input('stage_info_company'),
            'stage_encadreur_campany' => $request->input('stage_encadreur_campany'),
            'stage_sujet'             => $request->input('stage_sujet'),
            'stage_description'       => $request->input('stage_description'),
            'stage_debut'             => $request->input('stage_debut'),
            'stage_fin'               => $request->input('stage_fin'),
            'stage_duree'             => $request->input('stage_duree'),
            'stage_soutenance'        => $request->input('stage_soutenance'),
            'statut'                  => $request->input('statut'),
        ]);
        error_log("-------------------------------------------------------".$response);
        return redirect()->back()->with('message', 'Stage pro est modifié avec succés');
    }

    public function updatePropositionStagePro(Request $request, $id)
    {
        $file      = $request->stage_proposition_file;
        $myFile    = $this->convertImage($file);
        $myExtFile = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-propositionStagePro/'.$id, [
            'stage_proposition_file' => $myFile,
            'extensionFile'   => $myExtFile,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier est modifié avec succés'); 
    }

    public function updateAttestationStagePro(Request $request, $id)
    {
        $file      = $request->stage_attestation_file;
        $myFile    = $this->convertImage($file);
        $myExtFile = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-attestationStagePro/'.$id, [
            'stage_attestation_file' => $myFile,
            'extensionFile'         => $myExtFile,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier est modifié avec succés'); 
    }

    public function updateRapportStagePro(Request $request, $id)
    {
        $file      = $request->stage_rapport_file;
        $myFile    = $this->convertImage($file);
        $myExtFile = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-rapportStagePro/'.$id, [
            'stage_rapport_file' => $myFile,
            'extensionFile'        => $myExtFile,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Le fichier est modifié avec succés'); 
    }



    public function updateStagePro(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-updateStagePro/'.$id, [
            'accepter' => $request->input('accepter'),
        ]);
        error_log('Acceptation----------------------------------'.$response);
        return redirect()->back();
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
