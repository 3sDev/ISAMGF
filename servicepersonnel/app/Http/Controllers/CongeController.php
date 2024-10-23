<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CongeController extends Controller
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
        $response = Http::get($this->getUrlServer().'/all-conges-personnels');
        $conges   = json_decode($response);  

        return view('conge.index', ['conges' => $conges]);
    }

    public function indexSolde()
    {
        $response   = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response);   

        $response2 = Http::get($this->getUrlServer().'/getAllSoldesFromPersonnels');
        $soldes    = json_decode($response2);   

        return view('conge.indexSolde', ['soldes' => $soldes, 'personnels' => $personnels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/all-categories-conge');
        $categories = json_decode($response2); 

        $response3 = Http::get($this->getUrlServer().'/getAllYears');
        $years = json_decode($response3); 

        return view('conge.create', ['personnels' => $personnels, 'categories' => $categories, 'years' => $years]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/conges', [
            'personnel_id'        => $request->input('personnel_id'),
            'categorie_conges_id' => $request->input('categorie_conges_id'),
            'annee'               => $request->input('annee'),
            'date_debut'          => $request->input('date_debut'),
            'date_fin'            => $request->input('date_fin'),
            'solde'               => $request->input('solde'),
            'duree'               => $request->input('duree'),
        ]);
        return redirect('/conges');
    }

    public function getSoldePersonnelAjax(Request $request, $idPersonnel, $idCategorie, $annee)
    {
        // $soldes = DB::select('SELECT id, date_debut, date_fin, duree, solde FROM `conges` WHERE personnel_id = ? AND categorie_conges_id = ? AND annee = ? ORDER BY id DESC LIMIT 1', [$idPersonnel, $idCategorie, $annee]);
        // $soldes = DB::select('SELECT id, date_debut, date_fin, duree, solde FROM `conges` WHERE personnel_id = ? AND categorie_conges_id = ? ORDER BY id DESC LIMIT 1', [$idPersonnel, $idCategorie]);
        // if ($soldes == []) {
        if ($idCategorie == '1') {
            $sql = DB::select('SELECT sum(conge_annual) as conge_annual FROM conge_personnels WHERE personnel_id = ? ', [$idPersonnel]);
            $data1 = $sql[0]->conge_annual;
            return array(["solde" => $data1]);
        } 
        elseif ($idCategorie == '2'){
            $sql = DB::select('SELECT sum(conge_exceptionnel) as conge_exceptionnel FROM conge_personnels WHERE personnel_id = ? ', [$idPersonnel]);
            $data1 = $sql[0]->conge_exceptionnel;
            return array(["solde" => $data1]);
        }
        elseif ($idCategorie == '3'){
            $sql = DB::select('SELECT sum(conge_compensatoire) as conge_compensatoire FROM conge_personnels WHERE personnel_id = ? ', [$idPersonnel]);
            $data1 = $sql[0]->conge_compensatoire;
            return array(["solde" => $data1]);
        }
        else{
            $sql = DB::select('SELECT sum(conge_maladie) as conge_maladie FROM conge_personnels WHERE personnel_id = ? ', [$idPersonnel]);
            $data1 = $sql[0]->conge_maladie;
            return array(["solde" => "$data1"]);
        }
        // } 
        // else {
        //     return response()->json($soldes);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response2 = Http::get($this->getUrlServer().'/mission-personnel/'.$id);
        $missions = json_decode($response2); 

        return view('conge.show', ['missions' => $missions]);
    }

    public function showDemandeConge($id, $personnel)
    {
        $response = Http::get($this->getUrlServer().'/personnel/'.$personnel);
        $personnels = json_decode($response); 
        $response1 = Http::get($this->getUrlServer().'/conges/'.$id);
        $conges = json_decode($response1);  
        $response2 = Http::get($this->getUrlServer().'/all-categories-conge');
        $categories = json_decode($response2); 


        return view('conge.show-demande', ['conges' => $conges, 'personnels' => $personnels, 'categories' => $categories]);
    }

    //Page Details + Add Soldes Personnel By Id
    public function addSoldeAndAnnee(Request $request)
    {
        $idPersonnel = $request->personnel_id;
        $req1 = DB::select('SELECT sum(conge_annual)as conge_annual, sum(conge_exceptionnel)as conge_exceptionnel, 
        sum(conge_compensatoire)as conge_compensatoire, sum(conge_maladie)as conge_maladie  FROM `conge_personnels` WHERE personnel_id = ? ', [$idPersonnel]);
        $allSoldeAnnual = $req1[0]->conge_annual;
        $allSoldeExceptionnel = $req1[0]->conge_exceptionnel;
        $allSoldeCompensatoire = $req1[0]->conge_compensatoire;
        $allSoldeMaladie = $req1[0]->conge_maladie;

        $response = Http::get($this->getUrlServer().'/personnel-profile/'.$idPersonnel);
        $personnel = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/getAllSoldesByIdPersonnel/'.$idPersonnel);
        $soldes = json_decode($response2);

        $years = DB::select('select * from years v where not exists (select * from conge_personnels e where e.annee = v.annee and e.personnel_id ="'.$idPersonnel.'")');

        return view('conge.editSoldeAnnee', ['personnel' => $personnel, 'soldes' => $soldes, 'allSoldeAnnual' => $allSoldeAnnual,
        'allSoldeExceptionnel' => $allSoldeExceptionnel, 'allSoldeCompensatoire' => $allSoldeCompensatoire, 'years' => $years, 
        'allSoldeMaladie' => $allSoldeMaladie]);
    }

    public function saveSoldePersonnel(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/saveSoldePersonnel', [
            'personnel_id'        => $request->input('personnel_id'),
            'annee'               => $request->input('annee'),
            'conge_annual'        => $request->input('conge_annual'),
            'conge_exceptionnel'  => $request->input('conge_exceptionnel'),
            'conge_compensatoire' => $request->input('conge_compensatoire'),
            'conge_maladie'       => $request->input('conge_maladie'),
        ]);
        error_log("Save solde congé =======================================".$response);
        $idPersonnel = $request->input('personnel_id');
        $req1 = DB::select('SELECT sum(conge_annual)as conge_annual, sum(conge_exceptionnel)as conge_exceptionnel, 
        sum(conge_compensatoire)as conge_compensatoire, sum(conge_maladie)as conge_maladie  FROM `conge_personnels` WHERE personnel_id = ? ', [$idPersonnel]);
        $allSoldeAnnual = $req1[0]->conge_annual;
        $allSoldeExceptionnel = $req1[0]->conge_exceptionnel;
        $allSoldeCompensatoire = $req1[0]->conge_compensatoire;
        $allSoldeMaladie = $req1[0]->conge_maladie;

        $response2 = Http::get($this->getUrlServer().'/personnel-profile/'.$idPersonnel);
        $personnel = json_decode($response2); 

        $response3 = Http::get($this->getUrlServer().'/getAllSoldesByIdPersonnel/'.$idPersonnel);
        $soldes = json_decode($response3);

        $years = DB::select('select * from years v where not exists (select * from conge_personnels e where e.annee = v.annee and e.personnel_id ="'.$idPersonnel.'")');

        
        return view('conge.editSoldeAnnee', ['personnel' => $personnel, 'soldes' => $soldes, 'allSoldeAnnual' => $allSoldeAnnual,
        'allSoldeExceptionnel' => $allSoldeExceptionnel, 'allSoldeCompensatoire' => $allSoldeCompensatoire, 'years' => $years,
        'allSoldeMaladie' => $allSoldeMaladie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $personnel)
    {
        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response); 
        $response1 = Http::get($this->getUrlServer().'/conges/'.$id);
        $conges = json_decode($response1);  
        $response2 = Http::get($this->getUrlServer().'/all-categories-conge');
        $categories = json_decode($response2); 

        //Count all congés

        $req1 = DB::select('SELECT sum(conge_annual)as conge_annual, sum(conge_exceptionnel)as conge_exceptionnel, 
        sum(conge_compensatoire)as conge_compensatoire, sum(conge_maladie)as conge_maladie  FROM `conge_personnels` WHERE personnel_id = ? ', [$personnel]);
        $allSoldeAnnual = $req1[0]->conge_annual;
        $allSoldeExceptionnel = $req1[0]->conge_exceptionnel;
        $allSoldeCompensatoire = $req1[0]->conge_compensatoire;
        $allSoldeMaladie = $req1[0]->conge_maladie;

        return view('conge.edit', ['conges' => $conges, 'personnels' => $personnels, 'categories' => $categories, 'allSoldeAnnual' => $allSoldeAnnual,
        'allSoldeExceptionnel' => $allSoldeExceptionnel, 'allSoldeCompensatoire' => $allSoldeCompensatoire, 'allSoldeMaladie' => $allSoldeMaladie]);
    }

    public function editSolde($id)
    {
        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response); 
        $response1 = Http::get($this->getUrlServer().'/getSoldePersonnelByIdSolde/'.$id);
        $soldes = json_decode($response1);  

        return view('conge.editSolde', ['soldes' => $soldes, 'personnels' => $personnels]);
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
        $response = Http::put($this->getUrlServer().'/update-conge/'.$id, [
            'personnel_id'        => $request->input('personnel_id'),
            'categorie_conges_id' => $request->input('categorie_conges_id'),
            'date_debut'          => $request->input('date_debut'),
            'date_fin'            => $request->input('date_fin'),
            'annee'               => $request->input('annee'),
            'duree'               => $request->input('duree'),
            'statut'              => $request->input('statut'),
        ]);
        return redirect()->back()->with('message', 'Congé est modifié avec succés');
    }

    public function updateSolde(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-solde/'.$id, [
            'conge_annual'        => $request->input('conge_annual'),
            'conge_exceptionnel'  => $request->input('conge_exceptionnel'),
            'conge_compensatoire' => $request->input('conge_compensatoire'),
            'conge_maladie'       => $request->input('conge_maladie'),
        ]);
        return redirect()->back()->with('message', 'Solde de congé est modifié avec succés');
    }

    public function updateFileConge(Request $request, $id)
    {
        $file      = $request->fichier;
        $myFile    = $this->convertImage($file);
        $myExtFile = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-fileConge/'.$id, [
            'fichier'       => $myFile,
            'extensionFile' => $myExtFile,
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
        $response = Http::delete($this->getUrlServer().'/delete-conge/'.$id);
        return redirect()->back()->with('message', 'Congé est supprimé avec succés');
    }

    public function destroySoldePersonnel($id, $idPersonnel)
    {
        $response = Http::delete($this->getUrlServer().'/delete-elementSolde/'.$id);

        $req1 = DB::select('SELECT sum(conge_annual)as conge_annual, sum(conge_exceptionnel)as conge_exceptionnel, 
        sum(conge_compensatoire)as conge_compensatoire, sum(conge_maladie)as conge_maladie  FROM `conge_personnels` WHERE personnel_id = ? ', [$idPersonnel]);
        $allSoldeAnnual = $req1[0]->conge_annual;
        $allSoldeExceptionnel = $req1[0]->conge_exceptionnel;
        $allSoldeCompensatoire = $req1[0]->conge_compensatoire;
        $allSoldeMaladie = $req1[0]->conge_maladie;

        $response = Http::get($this->getUrlServer().'/personnel-profile/'.$idPersonnel);
        $personnel = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/getAllSoldesByIdPersonnel/'.$idPersonnel);
        $soldes = json_decode($response2);

        $years = DB::select('select * from years v where not exists (select * from conge_personnels e where e.annee = v.annee and e.personnel_id ="'.$idPersonnel.'")');


        return view('conge.editSoldeAnnee', ['personnel' => $personnel, 'soldes' => $soldes, 'allSoldeAnnual' => $allSoldeAnnual,
        'allSoldeExceptionnel' => $allSoldeExceptionnel, 'allSoldeCompensatoire' => $allSoldeCompensatoire, 'years' => $years,
        'allSoldeMaladie' => $allSoldeMaladie]);
    }

    
}
