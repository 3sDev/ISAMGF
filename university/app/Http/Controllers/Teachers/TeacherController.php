<?php

namespace App\Http\Controllers\Teachers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmploiTeacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $response = Teacher::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data; 
    }

    public function getAllTeachers()
    {
        $response = Teacher::with('departement')->get();
        $data = json_decode($response);
        return $data;
    }

    public function teachersWithDepartement($departement)
    {
        //$response = Teacher::with('departement')->where("departement_id", "=", $departement)->orWhere("departement_id", "=", "1")->get();
        $response = Teacher::with('departement')->where("departement_id", "=", $departement)->orWhere("departement_id", "=", "1")->get();
        $data = json_decode($response);
        return $data;
    }
    
  	public function getAllTeachersWithProfiles()
    {
        $response = Teacher::with('profileTeacher')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getTeacherWithProfileFromId($id)
    {
        $response = Teacher::with('departement')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getProfileWithTeacher()
    {
        $response = Teacher::with('profileTeacher')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('paid');
        });
    }

    public function getAllAttendanceWithTeacherFromId($id)
    {
        $response = Teacher::with('attendancesTeachers')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllSeanceFromIdTeacherByDay($id, $jour)
    {
        $response   = EmploiTeacher::with('classe', 'matiere', 'salle', 'teacher')->where("teacher_id", "=", $id)
        ->where("jour", "=", $jour)->orderBy("heure_debut")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllSeanceFromIdTeacherByDayAndSemestre($id, $jour, $semestre)
    {
        $response   = EmploiTeacher::with('classe', 'matiere', 'salle', 'teacher')->where("teacher_id", "=", $id)
        ->where("jour", "=", $jour)->where("semestre", "=", $semestre)->orderBy("heure_debut")->get();
        $data = json_decode($response);
        return $data;
    }

    //count
    public function countAllNombreTeachers()
    {
        $response = Teacher::count();
        $data = json_decode($response);
        return $data;
    }

    public function countTeachersByStatut($statut)
    {
        $response = Teacher::where('type_enseignant', 'like', '%'.$statut.'%')->count();
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

    public function updateAccount(Request $request, $id)
    {
        $teacher=Teacher::find($id);
        if ($teacher->active === 0) {
            $teacher->active = 1;
            $teacher->update();
        }
        else {
            $teacher->active = 0;
            $teacher->update();
        }        
    }
    
    public function disponibiliteSallesSeances($debutSeance, $finSeance, $day, $type_seance)
    {
        // array of $ids that you need to select
        $startTime   = $debutSeance;
        $endTime     = $finSeance;
        $type_seance = $type_seance;
        $intervalTable = ["08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30"];
        $keyStart = array_search($startTime, $intervalTable);
        $keyEnd   = array_search($endTime, $intervalTable);
        $ids = array_slice($intervalTable, $keyStart, $keyEnd);
        // create sql part for IN condition by imploding comma after each id
        $in = '(\'' . implode('\',\'', $ids) .'\')';

        // create sql
        //$sql = DB::select('SELECT salle_id, heure_debut, statut FROM salle_emplois WHERE jour="'.$day.'" AND heure_debut IN ' . $in);
        //$sqlCount = DB::select('SELECT count(salle_id) as nbr FROM salle_emplois WHERE salle_id = "1" AND jour="'.$day.'" AND heure_debut IN ' . $in);

        $sql = DB::select('SELECT salle_id, heure_debut, statut FROM salle_emplois WHERE jour="'.$day.'" AND heure_debut IN ' . $in);
        $resFilter = $sql; 
        $testLeng = count($ids);  // le nombre des séances 
        $newTableR = [];

        // $statutSalle = DB::select('select statut from salle_emplois where jour = ? and heure_debut = ? and heure_fin = ? and salle_id = ?',[$teacher->jour, $teacher->heure_debut, $teacher->heure_fin, $teacher->salle_id]);
        $newFT = array_chunk($resFilter, $testLeng);
        

        foreach($resFilter as $key => $value) {
            if (($value->statut == 0 && $type_seance == '1') || ($value->statut == 0 && $type_seance == '15')
                || ($value->statut == 2 && $type_seance == '15')) {
                array_push($newTableR, $value->salle_id);               
            }
        }
        
        $newTableFinal = array_count_values($newTableR);

        $tableSalleId = [];
        foreach($newTableFinal as $key => $value) {
            if ($value == $testLeng) { //if ($value == $myCountTable) {
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
    
    public function disponibiliteSallesSeancesFromSemestre($debutSeance, $finSeance, $day, $type_seance, $semestre)
    {
        // array of $ids that you need to select
        $semestre    = $semestre;
        $startTime   = $debutSeance;
        $endTime     = $finSeance;
        $type_seance = $type_seance;
        $intervalTable = ["08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30"];
        $keyStart = array_search($startTime, $intervalTable);
        $keyEnd   = array_search($endTime, $intervalTable)-$keyStart;
        $ids = array_slice($intervalTable, $keyStart, $keyEnd);
        // create sql part for IN condition by imploding comma after each id
        $in = '(\'' . implode('\',\'', $ids) .'\')';

        if ($semestre == "1") {
            $sql = DB::select('SELECT salle_id, heure_debut, statut FROM salle_emplois WHERE jour="'.$day.'" AND heure_debut IN ' . $in);
        } else {
            $sql = DB::select('SELECT salle_id, heure_debut, statut FROM salle_emplois_2 WHERE jour="'.$day.'" AND heure_debut IN ' . $in);
        }
        
        $resFilter = $sql; 
        $testLeng = count($ids);  // le nombre des séances 
        $newTableR = [];

        // $statutSalle = DB::select('select statut from salle_emplois where jour = ? and heure_debut = ? and heure_fin = ? and salle_id = ?',[$teacher->jour, $teacher->heure_debut, $teacher->heure_fin, $teacher->salle_id]);
        $newFT = array_chunk($resFilter, $testLeng);
        foreach($resFilter as $key => $value) {
            if (($value->statut == 0 && $type_seance == '1') || ($value->statut == 0 && $type_seance == '15')
                || ($value->statut == 2 && $type_seance == '15')) {
                array_push($newTableR, $value->salle_id);               
            }
        }
        
        $newTableFinal = array_count_values($newTableR);

        $tableSalleId = [];
        foreach($newTableFinal as $key => $value) {
            if ($value == $testLeng) { //if ($value == $myCountTable) {
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->extensionImg != '') {
            //Service Convert File(image)
            $extFile  = $request->extensionImg;
            $dataFile = base64_decode($request->profile_image); //decode base64 string
            $nameFile = time().".$extFile";
            $file     = "upload/teachers/".$nameFile;
            $moveFile1   = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $teacher = new Teacher;
        $teacher->type_enseignant    = $request->input('type_enseignant');
        $teacher->mat_cnrps          = $request->input('mat_cnrps');
        $teacher->matricule          = $request->input('matricule');
        $teacher->cin                = $request->input('cin');
        $teacher->nom                = $request->input('nom');
        $teacher->prenom             = $request->input('prenom');
        $teacher->nom_ar             = $request->input('nom_ar');
        $teacher->prenom_ar          = $request->input('prenom_ar');
        $teacher->full_name          = $request->input('full_name');
        $teacher->email              = $request->input('email');
        $teacher->password           = Hash::make($request->input('password'));
        $teacher->active             = $request->input('active');
        $teacher->ddn                = $request->input('ddn');
        $teacher->gov                = $request->input('gov');
        $teacher->gov_ar             = $request->input('gov_ar');
        $teacher->genre              = $request->input('genre');
        $teacher->nationnalite       = $request->input('nationnalite');
        $teacher->niveau_educat      = $request->input('niveau_educat');
        $teacher->diplome1           = $request->input('diplome1');
        $teacher->diplome_annee1     = $request->input('diplome_annee1');
        $teacher->diplome_etab1      = $request->input('diplome_etab1');
        $teacher->diplome2           = $request->input('diplome2');
        $teacher->diplome_annee2     = $request->input('diplome_annee2');
        $teacher->diplome_etab2      = $request->input('diplome_etab2');
        $teacher->diplome3           = $request->input('diplome3');
        $teacher->diplome_annee3     = $request->input('diplome_annee3');
        $teacher->diplome_etab3      = $request->input('diplome_etab3');
        $teacher->date_recrutement   = $request->input('date_recrutement');
        $teacher->grade              = $request->input('grade');
        $teacher->grade_date         = $request->input('grade_date');
        $teacher->poste              = $request->input('poste');
        $teacher->rue_teacher        = $request->input('rue_teacher');
        $teacher->codepostal_teacher = $request->input('codepostal_teacher');
        $teacher->tel1_teacher       = $request->input('tel1_teacher');
        $teacher->etat_civil         = $request->input('etat_civil');
        $teacher->nom_garant         = $request->input('nom_garant');
        $teacher->profession_garant  = $request->input('profession_garant');
        $teacher->nbr_enfant         = $request->input('nbr_enfant');
        $teacher->autre              = $request->input('autre');
        $teacher->cin_date           = $request->input('cin_date');
        $teacher->specialite_ens     = $request->input('specialite_ens');
        $teacher->departement_id     = $request->input('departement_id');
        $teacher->rib_ens            = $request->input('rib_ens');
        $teacher->tel2_ens           = $request->input('tel2_ens');

       $teacher->profile_image      = $nameFile;
            
       $teacher->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $teacher=Teacher::find($id);
        $teacher->type_enseignant    = $request->input('type_enseignant');
        $teacher->mat_cnrps          = $request->input('mat_cnrps');
        $teacher->matricule          = $request->input('matricule');
        $teacher->cin                = $request->input('cin');
        $teacher->nom                = $request->input('nom');
        $teacher->prenom             = $request->input('prenom');
        $teacher->nom_ar             = $request->input('nom_ar');
        $teacher->prenom_ar          = $request->input('prenom_ar');
        $teacher->full_name          = $request->input('full_name');
        $teacher->email              = $request->input('email');
        //$teacher->password           = Hash::make($request->input('password'));
        $teacher->active             = $request->input('active');
        $teacher->ddn                = $request->input('ddn');
        $teacher->gov                = $request->input('gov');
        $teacher->gov_ar             = $request->input('gov_ar');
        $teacher->genre              = $request->input('genre');
        $teacher->nationnalite       = $request->input('nationnalite');
        $teacher->niveau_educat      = $request->input('niveau_educat');
        $teacher->diplome1           = $request->input('diplome1');
        $teacher->diplome_annee1     = $request->input('diplome_annee1');
        $teacher->diplome_etab1      = $request->input('diplome_etab1');
        $teacher->diplome2           = $request->input('diplome2');
        $teacher->diplome_annee2     = $request->input('diplome_annee2');
        $teacher->diplome_etab2      = $request->input('diplome_etab2');
        $teacher->diplome3           = $request->input('diplome3');
        $teacher->diplome_annee3     = $request->input('diplome_annee3');
        $teacher->diplome_etab3      = $request->input('diplome_etab3');
        $teacher->date_recrutement   = $request->input('date_recrutement');
        $teacher->grade              = $request->input('grade');
        $teacher->grade_date         = $request->input('grade_date');
        $teacher->poste              = $request->input('poste');
        $teacher->rue_teacher        = $request->input('rue_teacher');
        $teacher->codepostal_teacher = $request->input('codepostal_teacher');
        $teacher->tel1_teacher       = $request->input('tel1_teacher');
        $teacher->etat_civil         = $request->input('etat_civil');
        $teacher->nom_garant         = $request->input('nom_garant');
        $teacher->profession_garant  = $request->input('profession_garant');
        $teacher->nbr_enfant         = $request->input('nbr_enfant');
        $teacher->autre              = $request->input('autre');
        $teacher->cin_date           = $request->input('cin_date');
        $teacher->specialite_ens     = $request->input('specialite_ens');
        $teacher->departement_id     = $request->input('departement_id');
        $teacher->rib_ens            = $request->input('rib_ens');
        $teacher->tel2_ens           = $request->input('tel2_ens');

        $teacher->update();
    }

    public function updateProfile(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        //Service Convert File
        if ($request->extensionProfile != '') {
            File::delete('upload/teachers/'.$teacher->profile_image);
            $extFile   = $request->extensionProfile;
            $dataImage = base64_decode($request->profile_image); //decode base64 string
            $nameFile4 = time().".$extFile";
            $file      = "upload/teachers/".$nameFile4;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile4 = $teacher->profile_image; }
        $teacher->profile_image = $nameFile4;
        $teacher->update();   
    }

    public function updatePasswordFromTeacher(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $teacherPassword = $teacher->password;

        $currentPassword  = $request->current_password;
        $newPassword      = $request->new_password;
        $confirmPassword  = $request->confirm_password;

        if (Hash::check($currentPassword, $teacherPassword) && $newPassword == $confirmPassword) {
            $teacher->password = Hash::make($newPassword);
            $teacher->update();
            return $msg = ['msg' => 'Password change successfully.'];
        }
        else {
            return $msg = ['msg' => 'Password invalid.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Teacher::destroy($id);
    }
}
