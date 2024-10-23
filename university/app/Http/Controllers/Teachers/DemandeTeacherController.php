<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\DemandeTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DemandeTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Teacher::with('demandesTeachers')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function demandefromteacher($id)
    {
        $response = DemandeTeacher::with('teacher')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function AllDemandesWithTeacherFromID($id)
    {
        $response = DemandeTeacher::with('teacher')->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }
  
    public function getAllDemandes()
    {
        $response = DemandeTeacher::all();
        $data = json_decode($response);
        return $data;
    }

  	public function getAllDemandesFromteacher()
    {
        $response = DemandeTeacher::with('teacher')->get();
        $data = json_decode($response);
       	return $data;
    }
  
  	public function getAllTeachersFromDemandes()
    {
        $response = Teacher::with('demandesTeachers')->get();
        $data = json_decode($response);
       	return $data;
    }

    //count
    public function getCountDemandesTeachers($statut)
    {
        $response = DemandeTeacher::where("statut", "=", $statut)->count();
        $data = json_decode($response);
        return $data;
    }
    public function countAlldemandsTeachers()
    {
        $response = DemandeTeacher::count();
        $data = json_decode($response);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        //Service Convert PDF - RIB
        if ($request->extensionRib != '') {
            $extRIB  = $request->extensionRib;
            $dataRib = base64_decode($request->file_rib); //decode base64 string
            $nameRib = time().".$extRIB";
            $RIB     = "upload/demandesTeachers/rib/".$nameRib;
            $moveFile1       = file_put_contents($RIB, $dataRib);
        }
        else { $nameRib = null; }

        //Service Convert PDF - Main levée
        if ($request->extensionMainLevee != '') {
            $extMainLevee  = $request->extensionMainLevee;
            $dataMainLevee = base64_decode($request->file_main_levee); //decode base64 string
            $nameMainLevee = time().".$extMainLevee";
            $MAINLEVEE     = "upload/demandesTeachers/mainLevee/".$nameMainLevee;
            $moveFile2     = file_put_contents($MAINLEVEE, $dataMainLevee);
            }
        else { $nameMainLevee = null; }

        //Service Convert PDF - Domiciliation salaire
        if ($request->extensionDomicialisation != '') {
            $extDomicialisation  = $request->extensionDomicialisation;
            $dataDomicialisation = base64_decode($request->file_domicialisation_salaire); //decode base64 string
            $nameDomicialisation = time().".$extDomicialisation";
            $DOMICIALISATION     = "upload/demandesTeachers/domicialisationSalaire/".$nameDomicialisation;
            $moveFile3           = file_put_contents($DOMICIALISATION, $dataDomicialisation);
            }
        else { $nameDomicialisation = null; }

        $demande                          = new DemandeTeacher;
        $demande->type                    = $request->input('type');
        $demande->statut                  = 'En cours';
        $demande->langue                  = $request->input('langue');
        $demande->nombre_mois             = $request->input('nombre_mois');
        $demande->raison                  = $request->input('raison');
        $demande->ancien_compte           = $request->input('ancien_compte');
        $demande->nouveau_compte          = $request->input('nouveau_compte');
        $demande->years                   = $request->input('years');
        $demande->nom_epoux               = $request->input('nom_epoux');
        $demande->nationalite_epoux       = $request->input('nationalite_epoux');
        $demande->travaille_epoux         = $request->input('travaille_epoux');
        $demande->freelance_epoux         = $request->input('freelance_epoux');
        $demande->metier_epoux            = $request->input('metier_epoux');
        $demande->societe_epoux           = $request->input('societe_epoux');
        $demande->uid_epoux               = $request->input('uid_epoux');
        $demande->matiers                 = $request->input('matiers');
        $demande->heures_demandees        = $request->input('heures_demandees');
        $demande->heures_semaine          = $request->input('heures_semaine');
        $demande->institut_demandee       = $request->input('institut_demandee');
        $demande->heures_semaine_demandee = $request->input('heures_semaine_demandee');
        $demande->periode_etude           = $request->input('periode_etude');
        $demande->teacher_id              = $request->input('teacher_id');

        $demande->file_rib                     = $nameRib;
        $demande->file_main_levee              = $nameMainLevee;
        $demande->file_domicialisation_salaire = $nameDomicialisation;

        $demande->save();
        error_log('save demande teacher--------------------------------------------'.$demande);
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
        $demandeTeacher=DemandeTeacher::find($id);
        $demandeTeacher->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DemandeTeacher::destroy($id);
    }
}