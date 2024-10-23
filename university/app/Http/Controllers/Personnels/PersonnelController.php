<?php

namespace App\Http\Controllers\Personnels;

use App\Models\Personnel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $response = Personnel::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPersonnels()
    {
        $response = Personnel::all();
        $data = json_decode($response);
        return $data;
    }
    
  	public function getAllPersonnelsWithProfiles()
    {
        $response = Personnel::with('profilePersonnel')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getPersonnelWithProfileFromId($id)
    {
        $response = Personnel::with('profilePersonnel')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getProfileWithPersonnel()
    {
        $response = Personnel::with('profilePersonnel')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('paid');
        });
    }

    public function getAllAttendanceWithPersonnelFromId($id)
    {
        $response = Personnel::with('attendancesPersonnels')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }
    
    //count
    public function countAllNombrePersonnels()
    {
        $response = Personnel::count();
        $data = json_decode($response);
        return $data;
    }

    public function countAllNombreAdmins()
    {
        $response = User::count();
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
        if ($request->extensionImg != '') {
            //Service Convert File(image)
            $extFile  = $request->extensionImg;
            $dataFile = base64_decode($request->profile_image); //decode base64 string
            $nameFile = time().".$extFile";
            $file     = "upload/personnels/".$nameFile;
            $moveFile1   = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $personnel                       = new Personnel();
        $personnel->mat_cnrps            = $request->input('mat_cnrps');
        $personnel->matricule            = $request->input('matricule');
        $personnel->cin                  = $request->input('cin');
        $personnel->nom                  = $request->input('nom');
        $personnel->prenom               = $request->input('prenom');
        $personnel->nom_ar               = $request->input('nom_ar');
        $personnel->prenom_ar            = $request->input('prenom_ar');
        $personnel->full_name            = $request->input('full_name');
        $personnel->email                = $request->input('email');
        $personnel->password             = Hash::make($request->input('password'));
        $personnel->active               = $request->input('active');
        $personnel->ddn                  = $request->input('ddn');
        $personnel->gov                  = $request->input('gov');
        $personnel->gov_ar               = $request->input('gov_ar');
        $personnel->genre                = $request->input('genre');
        $personnel->nationnalite         = $request->input('nationnalite');
        $personnel->date_recrutement     = $request->input('date_recrutement');
        $personnel->grade                = $request->input('grade');
        $personnel->grade_date           = $request->input('grade_date');
        $personnel->poste                = $request->input('poste');
        $personnel->rue_personnel        = $request->input('rue_personnel');
        $personnel->rue_personnel_ar     = $request->input('rue_personnel_ar');
        $personnel->categorie            = $request->input('categorie');
        $personnel->codepostal_personnel = $request->input('codepostal_personnel');
        $personnel->tel1_personnel       = $request->input('tel1_personnel');
        $personnel->tel2_personnel       = $request->input('tel2_personnel');
        $personnel->etat_civil           = $request->input('etat_civil');
        $personnel->nom_garant           = $request->input('nom_garant');
        $personnel->profession_garant    = $request->input('profession_garant');
        $personnel->nbr_enfant           = $request->input('nbr_enfant');
        $personnel->autre                = $request->input('autre');
        $personnel->cin_date             = $request->input('cin_date');
        $personnel->rib_perso            = $request->input('rib_perso');

        $personnel->save();
		
		// $newIdPersonnel = $personnel->id;
        // $sql = DB::insert('insert into conge_personnels (annee, conge_annual, conge_exceptionnel, conge_compensatoire, conge_maladie, personnel_id) 
        // values ("2023", "30", "10", "5", "7", ?)', [$newIdPersonnel]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $personnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnel $personnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $personnel=Personnel::find($id);
        $personnel->mat_cnrps          = $request->input('mat_cnrps');
        $personnel->matricule          = $request->input('matricule');
        $personnel->cin                = $request->input('cin');
        $personnel->nom                = $request->input('nom');
        $personnel->prenom             = $request->input('prenom');
        $personnel->nom_ar             = $request->input('nom_ar');
        $personnel->prenom_ar          = $request->input('prenom_ar');
        $personnel->full_name          = $request->input('full_name');
        $personnel->email              = $request->input('email');
        $personnel->tel1_personnel     = $request->input('tel1_personnel');
        $personnel->tel2_personnel     = $request->input('tel2_personnel');
        $personnel->active             = $request->input('active');
        $personnel->etat_civil         = $request->input('etat_civil');
        $personnel->ddn                = $request->input('ddn');
        $personnel->gov                = $request->input('gov');
        $personnel->gov_ar             = $request->input('gov_ar');
        $personnel->rue_personnel      = $request->input('rue_personnel');
        $personnel->rue_personnel_ar   = $request->input('rue_personnel_ar');
        $personnel->categorie          = $request->input('categorie');
        $personnel->codepostal_personnel= $request->input('codepostal_personnel');
        $personnel->genre              = $request->input('genre');
        $personnel->nationnalite       = $request->input('nationnalite');
        $personnel->grade_date         = $request->input('grade_date');
        $personnel->grade              = $request->input('grade');
        $personnel->poste              = $request->input('poste');
        $personnel->date_recrutement   = $request->input('date_recrutement');
        $personnel->nom_garant         = $request->input('nom_garant');
        $personnel->profession_garant  = $request->input('profession_garant');
        $personnel->nbr_enfant         = $request->input('nbr_enfant');
        $personnel->autre              = $request->input('autre');
        $personnel->cin_date           = $request->input('cin_date');
        $personnel->rib_perso          = $request->input('rib_perso');

        $personnel->update();
    }

    public function updateProfilePersonnel(Request $request, $id)
    {
        $personnel = Personnel::find($id);
        //Service Convert File
        if ($request->extensionProfile != '') {
            File::delete('upload/personnels/'.$personnel->profile_image);
            $extFile   = $request->extensionProfile;
            $dataImage = base64_decode($request->profile_image); //decode base64 string
            $nameFile4 = time().".$extFile";
            $file      = "upload/personnels/".$nameFile4;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile4 = $personnel->profile_image; }
        $personnel->profile_image = $nameFile4;
        $personnel->update();   
    }

    public function updatePasswordFromPersonnel(Request $request, $id)
    {
        $personnel = Personnel::find($id);
        $personnelPassword = $personnel->password;

        $currentPassword  = $request->current_password;
        $newPassword      = $request->new_password;
        $confirmPassword  = $request->confirm_password;

        if (Hash::check($currentPassword, $personnelPassword) && $newPassword == $confirmPassword) {
            $personnel->password = Hash::make($newPassword);
            $personnel->update();
            return $msg = ['msg' => 'Password change successfully.'];
        }
        else {
            return $msg = ['msg' => 'Password invalid.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Personnel::destroy($id);
    }
}
