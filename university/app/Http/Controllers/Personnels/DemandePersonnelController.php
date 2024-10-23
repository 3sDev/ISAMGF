<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\DemandePersonnel;
use App\Models\Personnel;
use Illuminate\Http\Request;

class DemandePersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Personnel::with('demandesPersonnels')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function demandefrompersonnel($id)
    {
        $response = DemandePersonnel::with('personnel')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function AllDemandesWithPersonnelFromID($id)
    {
        $response = DemandePersonnel::with('personnel')->where("personnel_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }
  
    public function getAllDemandes()
    {
        $response = DemandePersonnel::with('personnel')->get();
        $data = json_decode($response);
        return $data;
    }

  	public function getAllDemandesFrompersonnel()
    {
        $response = DemandePersonnel::with('personnel')->get();
        $data = json_decode($response);
       	return $data;
    }
  
  	public function getAllPersonnelsFromDemandes()
    {
        $response = Personnel::with('demandesPersonnels')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getCountDemandeInvalide()
    {
        $countDemandePersonnel = DemandePersonnel::where('statut','!=','Traitée')->count();
        $data = json_decode($countDemandePersonnel);
       	return $data;
    }

    public function getCountAllDemandes()
    {
        $countDemandePersonnel = DemandePersonnel::count();
        $data = json_decode($countDemandePersonnel);
       	return $data;
    }

        //count
        public function getCountDemandesPersonnelsWithStatut($statut)
        {
            $response = DemandePersonnel::where("statut", "=", $statut)->count();
            $data = json_decode($response);
            return $data;
        }
        public function countAlldemandsPersonnels()
        {
            $response = DemandePersonnel::count();
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
        //Service Convert PDF - RIB
        if ($request->extensionRib != '') {
            $extRIB  = $request->extensionRib;
            $dataRib = base64_decode($request->file_rib); //decode base64 string
            $nameRib = time().".$extRIB";
            $RIB     = "upload/demandesPersonnels/rib/".$nameRib;
            $moveFile1       = file_put_contents($RIB, $dataRib);
        }
        else { $nameRib = null; }

        //Service Convert PDF - Main levée
        if ($request->extensionMainLevee != '') {
            $extMainLevee  = $request->extensionMainLevee;
            $dataMainLevee = base64_decode($request->file_main_levee); //decode base64 string
            $nameMainLevee = time().".$extMainLevee";
            $MAINLEVEE     = "upload/demandesPersonnels/mainLevee/".$nameMainLevee;
            $moveFile2     = file_put_contents($MAINLEVEE, $dataMainLevee);
            }
        else { $nameMainLevee = null; }

        //Service Convert PDF - Domiciliation salaire
        if ($request->extensionDomicialisation != '') {
            $extDomicialisation  = $request->extensionDomicialisation;
            $dataDomicialisation = base64_decode($request->file_domicialisation_salaire); //decode base64 string
            $nameDomicialisation = time().".$extDomicialisation";
            $DOMICIALISATION     = "upload/demandesPersonnels/domicialisationSalaire/".$nameDomicialisation;
            $moveFile3           = file_put_contents($DOMICIALISATION, $dataDomicialisation);
            }
        else { $nameDomicialisation = null; }
        //Service Convert PDF - Image formation
        if ($request->extensionImg != '') {
            $extImg  = $request->extensionImg;
            $dataImg = base64_decode($request->image_formation); //decode base64 string
            $nameFormation = time().".$extImg";
            $FormationImg     = "upload/demandesPersonnels/formation/".$nameFormation;
            $moveFile1       = file_put_contents($FormationImg, $dataImg);
        }
        else { $nameFormation = null; }

        $demande                          = new DemandePersonnel;
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
        $demande->nom_formation           = $request->input('nom_formation');
        $demande->date_debut_formation    = $request->input('date_debut_formation');
        $demande->date_fin_formation      = $request->input('date_fin_formation');
        $demande->lieu_formation          = $request->input('lieu_formation');
        $demande->volume_formation        = $request->input('volume_formation');
        $demande->structure_formation     = $request->input('structure_formation');
        $demande->prix_formation          = $request->input('prix_formation');
        $demande->personnel_id            = $request->input('personnel_id');

        $demande->dateRepriseTravail      = $request->input('dateRepriseTravail');
        $demande->VacanceType             = $request->input('VacanceType');
        $demande->date_debut_vacance      = $request->input('date_debut_vacance');
        $demande->date_fin_vacance        = $request->input('date_fin_vacance');

        $demande->file_rib                     = $nameRib;
        $demande->file_main_levee              = $nameMainLevee;
        $demande->file_domicialisation_salaire = $nameDomicialisation;

        $demande->image_formation         = $nameFormation;

        $demande->save();
        return $demande;
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
        $demandePersonnel=DemandePersonnel::find($id);
        $demandePersonnel->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DemandePersonnel::destroy($id);
    }
}
