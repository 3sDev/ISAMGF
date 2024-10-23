<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\CategorieConge;
use App\Models\Conge;
use App\Models\CongePersonnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CongeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Conge::with('personnel', 'categorie')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getAllConges()
    {
        $response = Conge::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllCategoriesOfConge()
    {
        $response = CategorieConge::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllCongesWithPersonnels()
    {
        $response = Conge::with('personnel', 'categorie')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllCongesFromIdPersonnel($id)
    {
        $response = Conge::with('personnel', 'categorie')->where("personnel_id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    //Soldes Personnels
    public function getAllSoldesFromPersonnels()
    {
        $response = CongePersonnel::with('personnel')->groupBy('personnel_id')
        ->selectRaw('sum(conge_annual) as conge_annual, sum(conge_exceptionnel) as conge_exceptionnel 
        , sum(conge_compensatoire) as conge_compensatoire, sum(conge_maladie) as conge_maladie, personnel_id')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSoldesFromPersonnelByIdPersonnel($id)
    {
        $response = CongePersonnel::with('personnel')->where('personnel_id', '=', $id)->groupBy('personnel_id')
        ->selectRaw('sum(conge_annual) as conge_annual, sum(conge_exceptionnel) as conge_exceptionnel 
        , sum(conge_compensatoire) as conge_compensatoire, sum(conge_maladie) as conge_maladie, personnel_id')
        ->get();
        $data = json_decode($response);
        return $data;
    }

    public function getSoldePersonnelByIdSolde($id)
    {
        $response = CongePersonnel::with('personnel')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSoldesByIdPersonnel($id)
    {
        $response = CongePersonnel::with('personnel')->where("personnel_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllYears()
    {
        $sql = DB::select('SELECT annee FROM years');
        return $sql;
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
        $conge                      = new conge;
        $conge->date_debut          = $request->input('date_debut');
        $conge->date_fin            = $request->input('date_fin');
        $conge->solde               = $request->input('solde');
        $conge->annee               = $request->input('annee');
        $conge->duree               = $request->input('duree');
        $conge->personnel_id        = $request->input('personnel_id');
        $conge->categorie_conges_id = $request->input('categorie_conges_id');
        $conge->statut              = 'En cours';

        $conge->save();
        }

    public function saveSoldePersonnel(Request $request)
    {
        $solde                      = new CongePersonnel;
        $solde->personnel_id        = $request->input('personnel_id');
        $solde->annee               = $request->input('annee');
        $solde->conge_annual        = $request->input('conge_annual');
        $solde->conge_exceptionnel  = $request->input('conge_exceptionnel');
        $solde->conge_compensatoire = $request->input('conge_compensatoire');
        $solde->conge_maladie       = $request->input('conge_maladie');

        $solde->save();
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
        $conge = Conge::find($id);
        $oldDuree       = $conge->duree;
        $oldIdPersonnel = $conge->personnel_id;
        $oldCategorie   = $conge->categorie_conges_id;
        $oldStatut      = $conge->statut;

        $newDuree       = $request->input('duree');
        $newIdPersonnel = $request->input('personnel_id');
        $newCategorie   = $request->input('categorie_conges_id');
        $newStatut      = $request->input('statut');

        //Accepté congé personnel au premier lieu
        if ($oldStatut == 'En cours' && $newStatut == 'Accepté' || $oldStatut == 'Réfusé' && $newStatut == 'Accepté' ) {
            if ($conge->categorie_conges_id == 1) {
                $catg1 = CongePersonnel::where("personnel_id", "=", $oldIdPersonnel)->orderBy('annee','asc')->get(['id','conge_annual']);
                $myDuree = $oldDuree;
                for($i = 0; $i <= count($catg1); $i++){
                    $conge = $catg1[$i]->conge_annual;
                    if ($conge < $myDuree) {
                        $sql = DB::update('update conge_personnels set conge_annual = 0 where id = ?', [$conge = $catg1[$i]->id]);
                        $myDuree = $myDuree - $catg1[$i]->conge_annual;
                    }
                    else {
                        $restSolde = $conge - $myDuree;
                        $sql = DB::update('update conge_personnels set conge_annual = ? where id = ?', [$restSolde, $conge = $catg1[$i]->id]);
                        break;
                    }
                }
            } 
            
            elseif ($conge->categorie_conges_id == 2){
                $catg1 = CongePersonnel::where("personnel_id", "=", $oldIdPersonnel)->orderBy('annee','asc')->get(['id','conge_exceptionnel']);
                $myDuree = $oldDuree;
                for($i = 0; $i <= count($catg1); $i++){
                    $conge = $catg1[$i]->conge_exceptionnel;
                    if ($conge < $myDuree) {
                        $sql = DB::update('update conge_personnels set conge_exceptionnel = 0 where id = ?', [$conge = $catg1[$i]->id]);
                        $myDuree = $myDuree - $catg1[$i]->conge_exceptionnel;
                    }
                    else {
                        $restSolde = $conge - $myDuree;
                        $sql = DB::update('update conge_personnels set conge_exceptionnel = ? where id = ?', [$restSolde, $conge = $catg1[$i]->id]);
                        break;
                    }
                }
            } 
            
            elseif ($conge->categorie_conges_id == 3){
                $catg1 = CongePersonnel::where("personnel_id", "=", $oldIdPersonnel)->orderBy('annee','asc')->get(['id','conge_compensatoire']);
                $myDuree = $oldDuree;
                for($i = 0; $i <= count($catg1); $i++){
                    $conge = $catg1[$i]->conge_compensatoire;
                    if ($conge < $myDuree) {
                        $sql = DB::update('update conge_personnels set conge_compensatoire = 0 where id = ?', [$conge = $catg1[$i]->id]);
                        $myDuree = $myDuree - $catg1[$i]->conge_compensatoire;
                    }
                    else {
                        $restSolde = $conge - $myDuree;
                        $sql = DB::update('update conge_personnels set conge_compensatoire = ? where id = ?', [$restSolde, $conge = $catg1[$i]->id]);
                        break;
                    }
                }
            }
            
            else{
                $catg1 = CongePersonnel::where("personnel_id", "=", $oldIdPersonnel)->orderBy('annee','asc')->get(['id','conge_maladie']);
                $myDuree = $oldDuree;
                for($i = 0; $i <= count($catg1); $i++){
                    $conge = $catg1[$i]->conge_maladie;
                    if ($conge < $myDuree) {
                        $sql = DB::update('update conge_personnels set conge_maladie = 0 where id = ?', [$conge = $catg1[$i]->id]);
                        $myDuree = $myDuree - $catg1[$i]->conge_maladie;
                    }
                    else {
                        $restSolde = $conge - $myDuree;
                        $sql = DB::update('update conge_personnels set conge_maladie = ? where id = ?', [$restSolde, $conge = $catg1[$i]->id]);
                        break;
                    }
                }
            }
            $updateStatut = DB::update('update conges set statut = ? where id = ?', [$newStatut, $id]);
        }
        //Réfusé congé personnel au premier lieu
        if ($oldStatut == 'En cours' && $newStatut == 'Réfusé') {
            $updateStatut = DB::update('update conges set statut = ? where id = ?', [$newStatut, $id]);
        }

         //Réfusé congé personnel aprés de l'accepter
        if ($oldStatut == 'Accepté' && $newStatut == 'Réfusé') {
            $updateStatut = DB::update('update conges set statut = ? where id = ?', [$newStatut, $id]);
            
            if ($conge->categorie_conges_id == 1) {
                $updateSolde = DB::update('update conge_personnels set conge_annual = conge_annual+"'.$oldDuree.'" where personnel_id = "'.$oldIdPersonnel.'" ORDER BY id DESC LIMIT 1');
            }

            elseif ($conge->categorie_conges_id == 2){
                $updateSolde = DB::update('update conge_personnels set conge_exceptionnel = conge_exceptionnel+"'.$oldDuree.'" where personnel_id = "'.$oldIdPersonnel.'" ORDER BY id DESC LIMIT 1');
            }

            elseif ($conge->categorie_conges_id == 3){
                $updateSolde = DB::update('update conge_personnels set conge_compensatoire = conge_compensatoire+"'.$oldDuree.'" where personnel_id = "'.$oldIdPersonnel.'" ORDER BY id DESC LIMIT 1');
            }

            elseif ($conge->categorie_conges_id == 4){
                $updateSolde = DB::update('update conge_personnels set conge_maladie = conge_maladie+"'.$oldDuree.'" where personnel_id = "'.$oldIdPersonnel.'" ORDER BY id DESC LIMIT 1');
            }
        }
    }

    public function updateSoldePersonnel(Request $request, $id)
    {
        $conge = CongePersonnel::find($id);
        $conge->conge_annual        = $request->input('conge_annual');
        $conge->conge_exceptionnel  = $request->input('conge_exceptionnel');
        $conge->conge_compensatoire = $request->input('conge_compensatoire');
        $conge->conge_maladie       = $request->input('conge_maladie');
        $conge->update();
    }
    
    public function updateFileConge(Request $request, $id)
    {
        $conge = Conge::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/demandesPersonnels/conge/'.$conge->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/demandesPersonnels/conge/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $conge->fichier; }
        $conge->fichier = $nameFile3; 
        $conge->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Conge::destroy($id);
    }

    public function destroySoldePersonnel($id)
    {
        return CongePersonnel::destroy($id);
    }
    
    /*                Count                       */

    public function getAllCongesOfMaternite($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','1')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    public function getAllCongesOfAnnuel($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','2')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    public function getAllCongesOfNaissanceEnfant($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','3')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    public function getAllCongesOfDecesConjoint($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','4')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    public function getAllCongesOfDecesPMF($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','5')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    public function getAllCongesOfDecesFSPG($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','6')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    public function getAllCongesOfMariageTravailleur($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','7')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    public function getAllCongesOfMariageEnfant($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','8')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    public function getAllCongesOfCirconcision($id)
    {
        $countCongesMaternite = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','9')->sum('duree');
        $data1 = json_decode($countCongesMaternite);
       	return $data1;
    }

    /*                Reste                       */
    public function resteCongesOfMaternite($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "1")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','1')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }

    public function resteCongesOfAnnuel($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "2")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','2')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }

    public function resteCongesOfNaissanceEnfant($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "3")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','3')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }

    public function resteCongesOfDecesConjoint($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "4")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','4')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }

    public function resteCongesOfDecesPMF($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "5")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','5')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }

    public function resteCongesOfDecesFSPG($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "6")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','6')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }

    public function resteCongesOfMariageTravailleur($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "7")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','7')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }

    public function resteCongesOfMariageEnfant($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "8")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','8')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }

    public function resteCongesOfCirconcision($id)
    {
        $allNbrCategory = CategorieConge::where("id", "=", "9")->value('nombre');
        $countConges    = Conge::where("personnel_id", "=", $id)->where('categorie_conges_id','=','9')->sum('duree');
        $rst = $allNbrCategory - $countConges;
        $result = json_decode($rst);
       	return $result;
    }
    
}
