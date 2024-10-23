<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    use Services\MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/classes');
        $classes = json_decode($response);   
        return view('classe.index', ['classes' => $classes]);
    }

    public function affecter($id)
    {
        $response1 = Http::get($this->getUrlServer().'/classe-id/'.$id);
        $classes = json_decode($response1);    

        // $response2 = Http::get($this->getUrlServer().'/getEmploiTempsStudentByIdEmploi/'.$id);
        // $emploiGroupe = json_decode($response2); 

        $response3 = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response3); 

        $response4 = Http::get($this->getUrlServer().'/matieres-classe/'.$id);
        $matieresClasse = json_decode($response4); 

        return view('classe.affecter', ['classes' => $classes, 'matieres' => $matieres
        , 'matieresClasse' => $matieresClasse]);
    }

    public function multiMatiere(Request $request)
    {
        $idClasse = $request->idClasse;
        $IDmatiere = $request->ID_Matiere;
        $dateNow  = Carbon::now();
        foreach ($idClasse as $key => $insert) {
            $datasave = [
                'classe_id'  => $idClasse[$key],
                'matiere_id'  => $IDmatiere[$key],
                'created_at'  => $dateNow,
                'updated_at'  => $dateNow,
            ];
            DB::table('matiere_classes')->insert($datasave);
        }
        //return $datasave;
        return redirect()->back()->with('message', 'Liste des matières est ajoutée avec succés');
    }




    public function getScheduleFromClasse($id)
    {
        $inserted = array( 'vide' );

        //get classe By ID
        $responseClasse = Http::get($this->getUrlServer().'/classe-id/'.$id);
        $classeName = json_decode($responseClasse); 

        //get all seances from id classe(Groupe)
        $response = Http::get($this->getUrlServer().'/emploi-classe/'.$id);
        $classeEmploi = json_decode($response);  

        $responseLundi = Http::get($this->getUrlServer().'/emploi-classe-day/'.$id.'/Lundi');
        $classeEmploiLundi = json_decode($responseLundi);
        $resultLundi = $classeEmploiLundi;//$this->analyseEmploi($classeEmploiLundi);
        //array_splice( $resultLundi, 3, 0, $inserted );

        $responseMardi = Http::get($this->getUrlServer().'/emploi-classe-day/'.$id.'/Mardi');
        $classeEmploiMardi = json_decode($responseMardi);
        $resultMardi = $classeEmploiMardi;//$this->analyseEmploi($classeEmploiMardi);
        //array_splice( $resultMardi, 3, 0, $inserted );

        $responseMercredi = Http::get($this->getUrlServer().'/emploi-classe-day/'.$id.'/Mercredi');
        $classeEmploiMercredi = json_decode($responseMercredi);
        $resultMercredi = $classeEmploiMercredi;//$this->analyseEmploi($classeEmploiMercredi);
        //array_splice( $resultMercredi, 3, 0, $inserted );

        $responseJeudi = Http::get($this->getUrlServer().'/emploi-classe-day/'.$id.'/Jeudi');
        $classeEmploiJeudi = json_decode($responseJeudi);
        $resultJeudi = $classeEmploiJeudi;//$this->analyseEmploi($classeEmploiJeudi);
        //array_splice( $resultJeudi, 3, 0, $inserted );

        $responseVendredi = Http::get($this->getUrlServer().'/emploi-classe-day/'.$id.'/Vendredi');
        $classeEmploiVendredi = json_decode($responseVendredi);
        $resultVendredi = $classeEmploiVendredi;//$this->analyseEmploi($classeEmploiVendredi);
        //array_splice( $resultVendredi, 3, 0, $inserted );

        $responseSamedi = Http::get($this->getUrlServer().'/emploi-classe-day/'.$id.'/Samedi');
        $classeEmploiSamedi = json_decode($responseSamedi);
        $resultSamedi = $classeEmploiSamedi;//$this->analyseEmploi($classeEmploiSamedi);
        //array_splice( $resultSamedi, 3, 0, $inserted );

        //return $resultSamedi;

        $response2 = Http::get($this->getUrlServer().'/getEmploiTempsStudent/'.$id);
        $emploiGroupe = json_decode($response2);

        return view('classe.show', ['classeEmploi' => $classeEmploi, 'classeEmploiLundi' => $resultLundi, 
                                    'classeEmploiMardi' => $resultMardi, 'classeEmploiMercredi' => $resultMercredi,
                                    'classeEmploiJeudi' => $resultJeudi, 'classeEmploiVendredi' => $resultVendredi,
                                    'classeEmploiSamedi' => $resultSamedi, 'classeName' => $classeName, 
                                    'emploiGroupe' => $emploiGroupe ]);
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
        $response1 = Http::get($this->getUrlServer().'/levels');
        $levels = json_decode($response1);    

        $response2 = Http::get($this->getUrlServer().'/sections');
        $sections = json_decode($response2); 

        return view('classe.create', ['levels' => $levels, 'sections' => $sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/classes', [
            'classeName'   => $request->input('classeName'),
            'abbreviation' => $request->input('abbreviation'),
            'level_id'     => $request->input('level_id'),
            'section_id'   => $request->input('section_id'),
        ]);
        error_log("Save classe--------------------------------------".$response);
        return redirect('/all-classes')->with('message', 'Une classe est ajoutée avec succés');
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
        $response1 = Http::delete($this->getUrlServer().'/delete-classe/'.$id);
        return redirect()->back()->with('message', 'Une classe est supprimée avec succés'); 
    }

    public function destroyMatiereFromClasse($id)
    {
        $response1 = Http::delete($this->getUrlServer().'/delete-matiereClasse/'.$id);
        return redirect()->back()->with('message', 'Matière est supprimé avec succés'); 
    }
}
