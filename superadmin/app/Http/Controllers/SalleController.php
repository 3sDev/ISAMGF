<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Salle;
use App\Models\SalleEmploi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class SalleController extends Controller
{
    use Services\MyTrait;
    // private $urlServer = "http://smartschools.tn/university/public/api";
    // private $urlLocal  = "http://127.0.0.1:8080/api";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/sallesdep');
        $salles = json_decode($response);   
        return view('salle.index', ['salles' => $salles]);
    }

    public function disponibleSalle()
    {
        $response = Http::get($this->getUrlServer().'/sallesdep');
        $salles = json_decode($response);   
        return view('salle.all-salles', ['salles' => $salles]);
    }

    public function emploiSalle($id)
    {
        $inserted = array( 'vide' );
        //get salle By ID
        $responseSalle = Http::get($this->getUrlServer().'/salle/'.$id);
        $salleName = json_decode($responseSalle); 

        $response = Http::get($this->getUrlServer().'/salle/'.$id);
        $salles = json_decode($response);

        $response2 = Http::get($this->getUrlServer().'/all-salles-statut-id/'.$id);
        $salleseance = json_decode($response2);

        /************************************************************************************** */
        $responseLundi = Http::get($this->getUrlServer().'/emploi-salle-day/'.$id.'/Lundi');
        $salleEmploiLundi = json_decode($responseLundi);
        $resultLundi = $salleEmploiLundi;
        //array_splice( $resultLundi, 3, 0, $inserted );

        $responseMardi = Http::get($this->getUrlServer().'/emploi-salle-day/'.$id.'/Mardi');
        $salleEmploiMardi = json_decode($responseMardi);
        $resultMardi = $salleEmploiMardi;
        //array_splice( $resultMardi, 3, 0, $inserted );

        $responseMercredi = Http::get($this->getUrlServer().'/emploi-salle-day/'.$id.'/Mercredi');
        $salleEmploiMercredi = json_decode($responseMercredi);
        $resultMercredi = $salleEmploiMercredi;
        //array_splice( $resultMercredi, 3, 0, $inserted );

        $responseJeudi = Http::get($this->getUrlServer().'/emploi-salle-day/'.$id.'/Jeudi');
        $salleEmploiJeudi = json_decode($responseJeudi);
        $resultJeudi = $salleEmploiJeudi;
        //array_splice( $resultJeudi, 3, 0, $inserted );

        $responseVendredi = Http::get($this->getUrlServer().'/emploi-salle-day/'.$id.'/Vendredi');
        $salleEmploiVendredi = json_decode($responseVendredi);
        $resultVendredi = $salleEmploiVendredi;
        //array_splice( $resultVendredi, 3, 0, $inserted );

        $responseSamedi = Http::get($this->getUrlServer().'/emploi-salle-day/'.$id.'/Samedi');
        $salleEmploiSamedi = json_decode($responseSamedi);
        $resultSamedi = $salleEmploiSamedi;
        //array_splice( $resultSamedi, 3, 0, $inserted );

        return view('salle.emploi-salle', ['salles' => $salles, 'salleseance' => $salleseance, 'salleName' => $salleName,
                                        'salleEmploiLundi' => $resultLundi, 'salleEmploiMardi' => $resultMardi, 
                                        'salleEmploiMercredi' => $resultMercredi, 'salleEmploiJeudi' => $resultJeudi,
                                        'salleEmploiVendredi' => $resultVendredi, 'salleEmploiSamedi' => $resultSamedi]);
    }

    public function analyseEmploi($array)
    {
        $dataArray = [];
        $usedHour  = [];
        
        foreach ($array as $key=> $value) {
            //array_push($dataArray, $value);
            if (!in_array('08:30-10:00', $usedHour)) {
                if ($value->heure=='08:30-10:00') {
                    array_push($dataArray, $value);
                    array_push($usedHour, '08:30-10:00');
                    if (!empty($array[$key+1])) {
                        continue;
                    }
                }
                else {
                    array_push($dataArray, null);
                }
            }
              
            //**************** */
            if (!in_array('10:05-11:35', $usedHour)) {
                if ($value->heure=='10:05-11:35') {
                    array_push($dataArray, $value);
                    array_push($usedHour, '10:05-11:35');
                    if (!empty($array[$key+1])) {
                        continue;
                    }
                }
                else {
                    array_push($dataArray, null);
                }
            }
            //**************** */
            if (!in_array('11:40-13:10', $usedHour)) {
                if ($value->heure=='11:40-13:10') {
                    array_push($dataArray, $value);
                    array_push($usedHour, '11:40-13:10');
                    if (!empty($array[$key+1])) {
                        continue;
                    }
                }
                else {
                    array_push($dataArray, null);
                }
            }
            //**************** */
            if (!in_array('13:15-14:45', $usedHour)) {
                if ($value->heure=='13:15-14:45') {
                    array_push($dataArray, $value);
                    array_push($usedHour, '13:15-14:45');
                    if (!empty($array[$key+1])) {
                        continue;
                    }
                }
                else {
                    array_push($dataArray, null);
                }
            }
            //**************** */
            if (!in_array('14:50-16:20', $usedHour)) {
                if ($value->heure=='14:50-16:20') {
                    array_push($dataArray, $value);
                    array_push($usedHour, '14:50-16:20');
                    if (!empty($array[$key+1])) {
                        continue;
                    }
                }
                else {
                    array_push($dataArray, null);
                }
            }
            //**************** */
            if (!in_array('16:25:17:55', $usedHour)) {
                if ($value->heure=='16:25:17:55') {
                    array_push($dataArray, $value);
                    array_push($usedHour, '16:25:17:55');
                    if (!empty($array[$key+1])) {
                        continue;
                    }
                }
                else {
                    array_push($dataArray, null);
                }
            }
            //******************* */
        }
        $usedHour = array();

        if (count($dataArray) === 0) {
            $dataArray = [null, null, null, null, null, null];
        } 
        return $dataArray;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salle.create');
    }

    public function saisirJourDisponibilite()
    {
        $response1 = Http::get($this->getUrlServer().'/getAllDataFromSalleEmplois');
        $salleEmplois = json_decode($response1);

        $response2 = Http::get($this->getUrlServer().'/getAllDataFromSalleEmploiS2');
        $salleEmploiS2 = json_decode($response2);

        return view('salle.day-disponible', ['salleEmplois' => $salleEmplois, 'salleEmploiS2' => $salleEmploiS2]);
    }

    public function salleDisponibiliteByDay(Request $request)
    {
        $mySemestre = $request->semestre;
        
        $dateAbs    = $request->date_disponible;
        //$seanceAbs = $request->seanceattendance;
        $thisDay = date('l', strtotime($dateAbs));
        if ($thisDay == 'Monday') {
            $seanceAbs = 'Lundi';
        }
        elseif ($thisDay == 'Tuesday') {
            $seanceAbs = 'Mardi';
        }
        elseif ($thisDay == 'Wednesday') {
            $seanceAbs = 'Mercredi';
        }
        elseif ($thisDay == 'Thursday') {
            $seanceAbs = 'Jeudi';
        }
        elseif ($thisDay == 'Friday') {
            $seanceAbs = 'Vendredi';
        }
        elseif ($thisDay == 'Saturday') {
            $seanceAbs = 'Samedi';
        }
        else {
            $seanceAbs = 'Dimanche';
        }

        $response1 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/1');
        $Salle1 = json_decode($response1);

        $response2 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/2');
        $Salle2 = json_decode($response2);

        $response3 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/3');
        $Salle3 = json_decode($response3);

        $response4 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/4');
        $Salle4 = json_decode($response4);

        $response5 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/5');
        $Salle5 = json_decode($response5);

        $response6 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/6');
        $Salle6 = json_decode($response6);

        $response7 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/7');
        $Salle7 = json_decode($response7);

        $response8 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/8');
        $Salle8 = json_decode($response8);

        $response9 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/9');
        $Salle9 = json_decode($response9);

        $response10 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/10');
        $Salle10 = json_decode($response10);

        $response11 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/11');
        $Salle11 = json_decode($response11);

        $response12 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/12');
        $Salle12 = json_decode($response12);

        $response13 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/13');
        $Salle13 = json_decode($response13);

        $response14 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/14');
        $Salle14 = json_decode($response14);

        $response15 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/15');
        $Salle15 = json_decode($response15);

        $response16 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/16');
        $Salle16 = json_decode($response16);

        $response17 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/17');
        $Salle17 = json_decode($response17);

        $response18 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/18');
        $Salle18 = json_decode($response18);

        $response19 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/19');
        $Salle19 = json_decode($response19);

        $response20 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/20');
        $Salle20 = json_decode($response20);

        $response21 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/21');
        $Salle21 = json_decode($response21);

        $response22 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/22');
        $Salle22 = json_decode($response22);

        $response23 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/23');
        $Salle23 = json_decode($response23);

        $response24 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/24');
        $Salle24 = json_decode($response24);

        $response25 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/25');
        $Salle25 = json_decode($response25);

        $response29 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/29');
        $Salle29 = json_decode($response29);

        $response30 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/30');
        $Salle30 = json_decode($response30);

        $response31 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/31');
        $Salle31 = json_decode($response31);

        $response32 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/32');
        $Salle32 = json_decode($response32);

        $response33 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/33');
        $Salle33 = json_decode($response33);

        $response34 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/34');
        $Salle34 = json_decode($response34);

        $response35 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/35');
        $Salle35 = json_decode($response35);

        $response36 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/36');
        $Salle36 = json_decode($response36);

        $response37 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/37');
        $Salle37 = json_decode($response37);

        $response38 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/38');
        $Salle38 = json_decode($response38);

        $response41 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/41');
        $Salle41 = json_decode($response41);

        $response42 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/42');
        $Salle42 = json_decode($response42);

        $response43 = Http::get($this->getUrlServer().'/disponibiliteAllSallesByDayAndIdSalle/'.$seanceAbs.'/43');
        $Salle43 = json_decode($response43);

        $response26 = Http::get($this->getUrlServer().'/getAllRattrapagesWithTeacherFromDate/'.$dateAbs);
        $rattrapages = json_decode($response26);

        return view('salle.salle-disponible', ['Salle1' => $Salle1, 'Salle2' => $Salle2, 'Salle3' => $Salle3,
        'Salle4' => $Salle4, 'Salle5' => $Salle5, 'Salle6' => $Salle6, 'Salle7' => $Salle7, 'Salle8' => $Salle8,
        'Salle5' => $Salle5, 'Salle5' => $Salle5, 'Salle5' => $Salle5, 'Salle5' => $Salle5, 'Salle5' => $Salle5,
        'Salle9' => $Salle9, 'Salle10' => $Salle10, 'Salle11' => $Salle11, 'Salle12' => $Salle12, 'Salle13' => $Salle13,
        'Salle14' => $Salle14, 'Salle15' => $Salle15, 'Salle16' => $Salle16, 'Salle17' => $Salle17, 'Salle18' => $Salle18,
        'Salle19' => $Salle19, 'Salle20' => $Salle20, 'Salle21' => $Salle21, 'Salle22' => $Salle22, 'Salle23' => $Salle23,
        'Salle24' => $Salle24, 'Salle25' => $Salle25, 'Salle29' => $Salle29, 'Salle30' => $Salle30, 'Salle31' => $Salle31, 
        'Salle32' => $Salle32, 'Salle33' => $Salle33, 'Salle34' => $Salle34, 'Salle35' => $Salle35, 'Salle36' => $Salle36,
        'Salle37' => $Salle37, 'Salle38' => $Salle38, 'Salle41' => $Salle41, 'Salle42' => $Salle42, 'Salle43' => $Salle43,
        'dateAbs' => $dateAbs, 'seanceAbs' => $seanceAbs, 'rattrapages' => $rattrapages]);
    }

    public function reserverSalleEmploi()
    {
        $response2 = Http::get($this->getUrlServer().'/sallesdep');
        $salleEmplois = json_decode($response2);

        return view('salle.reserver-disponible', ['salleEmplois' => $salleEmplois]);
    }

    public function reserverSeanceToSalle(Request $request)
    {
        $salleSelected = $request->salle;
        $sql = DB::select('SELECT c.abbreviation as nomClasse, m.subjectLabel as nomMatiere, m.description as typeMatiere, t.full_name as nomEnseignant, e.jour as jour, e.heure_debut as heureDebut, e.heure_fin as heureFin FROM emploi_teachers e INNER JOIN classes c INNER JOIN matieres m INNER JOIN teachers t INNER JOIN salles s WHERE e.classe_id = c.id AND e.matiere_id = m.id AND e.teacher_id = t.id AND e.salle_id = s.id AND e.salle_id = ? ORDER BY e.heure_debut ASC',[$salleSelected]);
        $response2 = Http::get($this->getUrlServer().'/all-salles-statut-id/'.$salleSelected);
        $disponibilite = json_decode($response2);

        $nbAllDisponible     = DB::table('salle_emplois')->where('salle_id', '=', $salleSelected )->count();
        $nbrSeanceDisponible = DB::table('salle_emplois')->where('salle_id', '=', $salleSelected )->where('statut', '=', '1')->count();

        return view('salle.seance-reserver-disponible', ['disponibilite' => $disponibilite, 'emploi' => $sql
                            , 'nbAllDisponible' => $nbAllDisponible, 
                            'nbrSeanceDisponible' => $nbrSeanceDisponible]);
    }

    public function updateStatutSalle(Request $request)
    {
        $idSalle         = $request->salle_id;
        $jourSalle       = $request->jour;
        $statutSalle     = $request->statut;
        $heureDebutSalle = $request->heure_debut;
        $heureFinSalle   = $request->heure_fin;
        $heureFinToTime  = strtotime($heureFinSalle);
        $heureFinSql     = date("H:i", strtotime('-30 minutes', $heureFinToTime));

        $ids = SalleEmploi::where("jour", "=", $jourSalle)->where("salle_id", "=", $idSalle)
        ->whereBetween("heure_debut", [$heureDebutSalle, $heureFinSql])->get(["id"])->toArray();

        $updateStatut        = DB::table('salle_emplois')->whereIn('id', $ids)->update(['statut' => $statutSalle]);
        $nbAllDisponible     = DB::table('salle_emplois')->where('salle_id', '=', $idSalle )->count();
        $nbrSeanceDisponible = DB::table('salle_emplois')->where('salle_id', '=', $idSalle )->where('statut', '=', '1')->count();

        $sql = DB::select('SELECT c.abbreviation as nomClasse, m.subjectLabel as nomMatiere, m.description as typeMatiere, t.full_name as nomEnseignant, e.jour as jour, e.heure_debut as heureDebut, e.heure_fin as heureFin FROM emploi_teachers e INNER JOIN classes c INNER JOIN matieres m INNER JOIN teachers t INNER JOIN salles s WHERE e.classe_id = c.id AND e.matiere_id = m.id AND e.teacher_id = t.id AND e.salle_id = s.id AND e.salle_id = ? ORDER BY e.heure_debut ASC',[$idSalle]);
        $response2 = Http::get($this->getUrlServer().'/all-salles-statut-id/'.$idSalle);
        $disponibilite = json_decode($response2);
        return view('salle.seance-reserver-disponible', ['disponibilite' => $disponibilite,
                                                        'emploi' => $sql, 'nbAllDisponible' => $nbAllDisponible, 
                                                        'nbrSeanceDisponible' => $nbrSeanceDisponible]);      
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/salles', [
            'fullName' => $request->input('fullName'),
            'emplacement'  => $request->input('emplacement'),
            'type_salle'   => $request->input('type_salle'),
        ]);
        return redirect('/salles')->with('message', 'Salle est ajoutée avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Salle $salle)
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
        $response = Http::get($this->getUrlServer().'/salle/'.$id);
        $salles = json_decode($response);  
        return view('salle.edit', ['salles' => $salles]); 
    }

    // public function editSeanceSalle($id)
    // {
    //     $response = Http::get($this->getUrlServer().'/get-seance-salle/'.$id);
    //     $seances = json_decode($response);   

    //     return view('salle.edit-seance', ['seances' => $seances]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-salle/'.$id, [
            'fullName'    => $request->input('fullName'),
            'emplacement' => $request->input('emplacement'),
            'type_salle'  => $request->input('type_salle'),
        ]);
        return redirect()->back()->with('message', 'Salle est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-salle/'.$id);
        return redirect()->back()->with('message', 'Salle est supprimée avec succés');
    }
}
