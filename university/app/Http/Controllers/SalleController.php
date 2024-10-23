<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departements;
use App\Models\EmploiTeacher;
use App\Models\Salle;
use App\Models\SalleEmploi;
use App\Models\SalleEmploiSemestreTwo;
use Illuminate\Support\Facades\DB;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //$response = Salle::with('departements')->where("id", "=", $id)->get();
        // $departements = Departements::all();
        // $salles = Departements::join('salles', 'salles.department_id', '=', 'departements.id')->where('salles.id', $id)
        // ->get(['salles.id', 'salles.fullName', 'salles.abbreviation', 'salles.created_at', 'salles.updated_at',
        // 'salles.department_id', 'departements.departmentLabel']);
        $response = Salle::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSallesWithDep()
    {
        $response = Salle::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSalleFromDisponible()
    {
        $response = Salle::with('salleEmplois')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSalleFromDisponibleByIdSalle($id)
    {
        $response = SalleEmploi::with('salle')->where('salle_id', '=', $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function allSallesFromTableEmploiSalles()
    {
        $response = Salle::with('salleEmplois')->orderBy('created_at', 'DESC')->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getAllSalleFromDisponibleByStatut()
    {
        $response = SalleEmploi::with('salle')->where('statut', '=', 0)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSalleFromDisponibleByIdSalleSemestre1($id)
    {
        $response = SalleEmploi::with('salle')->where('salle_id', '=', $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSalleFromDisponibleByIdSalleSemestre2($id)
    {
        $response = SalleEmploiSemestreTwo::with('salle')->where('salle_id', '=', $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSeanceFromIdSalleByDayAndSemestre($id, $jour, $semestre)
    {
        $response   = EmploiTeacher::with('classe', 'matiere', 'salle', 'teacher')->where("salle_id", "=", $id)
        ->where("semestre", "=", $semestre)->where("jour", "=", $jour)->orderBy("heure_debut")->get();
        $data = json_decode($response);
        return $data;
    }
    //**************************************************************************** */
    public function disponibiliteAllSallesByDay($day)
    {
        $response = SalleEmploi::where('jour', '=', $day)->get();
        $data = json_decode($response);
        return $data;
    }

    public function disponibiliteAllSallesByDayAndIdSalle($day, $id)
    {
        $response = DB::select('SELECT * FROM salle_emplois INNER JOIN salles WHERE salle_emplois.jour = ? AND salle_emplois.salle_id = ? AND salle_emplois.salle_id = salles.id',[$day, $id]);
        return $response;
    }

    public function getAllDataFromSalleEmplois()
    {
        $response = DB::select('SELECT * FROM salles INNER JOIN salle_emplois WHERE salles.id = salle_emplois.salle_id');
        return $response;
    }

    public function getAllDataFromSalleEmploiS2()
    {
        $response = DB::select('SELECT * FROM salles INNER JOIN salle_emplois_2 WHERE salles.id = salle_emplois_2.salle_id');
        return $response;
    }

    public function disponibiliteAllSallesByDayAndIdSalleSemestreOne($day, $id)
    {
        $response = DB::select('SELECT * FROM salle_emplois INNER JOIN salles WHERE salle_emplois.jour = ? AND salle_emplois.salle_id = ? AND salle_emplois.salle_id = salles.id',[$day, $id]);
        return $response;
    }

    public function disponibiliteAllSallesByDayAndIdSalleSemestreTwo($day, $id)
    {
        $response = DB::select('SELECT * FROM salle_emplois_2 INNER JOIN salles WHERE salle_emplois_2.jour = ? AND salle_emplois_2.salle_id = ? AND salle_emplois_2.salle_id = salles.id',[$day, $id]);
        return $response;
    }
   //**************************************************************************** */ 

    public function getAllSeancesFromDisponibleWithIdSalle($id)
    {
        $response = SalleEmploi::with('salle')->where("salle_id", "=", $id)->where('statut', '=', 0)->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getSeanceFromSalleIdSeance($id)
    {
        $response = SalleEmploi::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSeanceFromIdSalleByDay($id, $jour)
    {
        $response   = EmploiTeacher::with('classe', 'matiere', 'salle', 'teacher')->where("salle_id", "=", $id)
        ->where("jour", "=", $jour)->orderBy("heure_debut")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getHeureByDay($id_salle, $nom_jour){
        $response   = SalleEmploi::where("salle_id", "=", $id_salle)
        ->where("jour", "=", $nom_jour)->where("statut", "=", 0)->orderBy("heure_debut")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getSalleDisponibleWithSeanceAndDay($seance, $day){
        $response   = SalleEmploi::with('salle')->where("heure_debut", "=", $seance)
        ->where("jour", "=", $day)->where("statut", "=", 0)->orderBy("heure_debut")->get();
        $data = json_decode($response);
        return $data;
    }

    public function disponibiliteSalle($debutSeance, $finSeance, $day)
    {
        // array of $ids that you need to select
        $startTime = $debutSeance;
        $endTime = $finSeance;
        $intervalTable = ["08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", 
        "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30"];
        $keyStart = array_search($startTime, $intervalTable);
        $keyEnd   = array_search($endTime, $intervalTable);
        $ids = array_slice($intervalTable, $keyStart, $keyEnd);
        // create sql part for IN condition by imploding comma after each id
        $in = '(\'' . implode('\',\'', $ids) .'\')';
        // create sql
        $sql = DB::select('SELECT salle_id, heure_debut, statut FROM salle_emplois WHERE jour="'.$day.'" AND heure_debut IN ' . $in);


        $resFilter = $sql; 
        $testLeng = count($ids);  // le nombre des séances 
        $newTableR = [];

        $newFT = array_chunk($resFilter, $testLeng);
        foreach($resFilter as $key => $value) {
            if ($value->statut == 0) {
                array_push($newTableR, $value->salle_id);               
            }
        }
        //print_r( $newTableR);

        $newTableFinal = array_count_values($newTableR);
        //print_r( $newTableFinal);
        $tableSalleId = [];
        foreach($newTableFinal as $key => $value) {
            if ($value == $testLeng) {
                array_push($tableSalleId, $key);               
            }
        }

        // create sql part for IN condition by imploding comma after each id
        $in2 = '(\'' . implode('\',\'', $tableSalleId) .'\')';
        // create sql
        $sql2 = DB::select('SELECT id, fullNAme FROM salles WHERE id IN ' . $in2);
        $listeSalles = $sql2;
        return $listeSalles;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salle = new Salle;
        $salle->fullName = $request->input('fullName');
        $salle->emplacement = $request->input('emplacement');
        $salle->type_salle = $request->input('type_salle');

        $salle->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Salle $salle)
    {
        return view('salle.show', compact('salle'));
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
        $salles = Departements::join('salles', 'salles.department_id', '=', 'departements.id')
        ->get(['departements.departmentLabel', 'salles.id', 'salles.fullName', 'salles.abbreviation'])
        ->find($id);
        return view('salle.edit', ['salles' => $salles, 'departements' => $departements]);
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
        $salle = Salle::find($id);
        $salle->fullName    = $request->input('fullName');
        $salle->emplacement = $request->input('emplacement');
        $salle->type_salle  = $request->input('type_salle');

        $salle->update();
    }

    public function updateSeanceSalle(Request $request, $id)
    {
        $salleEmploi = SalleEmploi::find($id);
        $salleEmploi->jour   = $request->input('jour');
        $salleEmploi->heure  = $request->input('heure');
        $salleEmploi->seance = $request->input('seance');

        $salleEmploi->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Salle::destroy($id); 
    }
}