<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PersonnelController extends Controller
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
        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response);   
        return view('personnel.index', ['personnels' => $personnels]);
    }

    public function monProfil()
    {   
        return view('profile.show');  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personnel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->profile_image != '') {
            $image      = $request->profile_image;
            $myFile  = $this->convertImage($image);
            $myExtFile = $this->getExtensionImage($image);
        }
        else { 
            $myExtFile = '';
            $myFile    = '';
        }

        $fullName = $request->input('nom').' '.$request->input('prenom');
        $response = Http::post($this->getUrlServer().'/personnels', [
            'mat_cnrps'          => $request->input('mat_cnrps'),
            'matricule'          => $request->input('cin'),
            'cin'                => $request->input('cin'),
            'nom'                => $request->input('nom'),
            'prenom'             => $request->input('prenom'),
            'nom_ar'             => $request->input('nom_ar'),
            'prenom_ar'          => $request->input('prenom_ar'),
            'full_name'          => $fullName,
            'email'              => $request->input('email'),
            'password'           => $request->input('tel1_personnel'),
            'active'             => $request->input('active'),
            'ddn'                => $request->input('ddn'),
            'gov'                => $request->input('gov'),
            'genre'              => $request->input('genre'),
            'nationnalite'       => $request->input('nationnalite'),
            'date_recrutement'   => $request->input('date_recrutement'),
            'grade'              => $request->input('grade'),
            'grade_date'         => $request->input('grade_date'),
            'poste'              => $request->input('poste'),
            'rue_personnel'      => $request->input('rue_personnel'),
            'rue_personnel_ar'   => $request->input('rue_personnel_ar'),
            'categorie'          => $request->input('categorie'),
            'codepostal_personnel'=> $request->input('codepostal_personnel'),
            'tel1_personnel'     => $request->input('tel1_personnel'),
            'tel2_personnel'     => $request->input('tel2_personnel'),
            'etat_civil'         => $request->input('etat_civil'),
            'nom_garant'         => $request->input('nom_garant'),
            'profession_garant'  => $request->input('profession_garant'),
            'nbr_enfant'         => $request->input('nbr_enfant'),
            'autre'              => $request->input('autre'),
            'cin_date'           => $request->input('cin_date'),
            'rib_perso'          => $request->input('rib_perso'),
            'profile_image'      => $myFile,
            'extensionImg'       => $myExtFile,
        ]);

        error_log('myPersonnel= '.$response);

        return redirect('/personnels')->with('message', 'Personnel est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response1 = Http::get($this->getUrlServer().'/alldemandwithpersonnel/'.$id);
        $demandepersonnels = json_decode($response1);  

        $response2 = Http::get($this->getUrlServer().'/attendancePersonnel/'.$id);
        $attendancepersonnels = json_decode($response2);  

        $response3 = Http::get($this->getUrlServer().'/personnel-profile/'.$id);
        $profiles = json_decode($response3);   

        $response4 = Http::get($this->getUrlServer().'/reclamationsPersonnel/'.$id);
        $reclamationpersonnel = json_decode($response4); 

        return view('personnel.show', ['profiles' => $profiles, 'demandepersonnels' => $demandepersonnels,
        'attendancepersonnels' => $attendancepersonnels, 'reclamationpersonnel' => $reclamationpersonnel]);
    }

    public function addprofilePage($id)
    {
        $response3 = Http::get($this->getUrlServer().'/personnel-profile/'.$id);
        $profiles = json_decode($response3);  

        return view('personnel.createProfile', ['profiles' => $profiles]);
    }

    public function addprofileStore(Request $request)
    {
        $image      = $request->profile_image;
        $myImage64  = $this->convertImage($image);
        $myExtImg64 = $this->getExtensionImage($image);

        $response = Http::post($this->getUrlServer().'/profiles-personnels', [
            'ddn'           => $request->input('ddn'),
            'genre'         => $request->input('genre'),
            'phone'         => $request->input('phone'),
            'gov'           => $request->input('gov'),
            'rue'           => $request->input('rue'),
            'codepostal'    => $request->input('codepostal'),
            'profile_image' => $myImage64,
            'extensionImg'  => $myExtImg64,
            'personnel_id'    => $request->input('personnel_id'),
        ]);

        return redirect('/personnels')->with('message', 'Profil personnel est ajouté avec succés');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/personnel-profile/'.$id);
        $profiles = json_decode($response);  

        return view('personnel.edit', ['profiles' => $profiles]);
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
        $response = Http::put($this->getUrlServer().'/update-personnel/'.$id, [
            'mat_cnrps'            => $request->input('mat_cnrps'),
            'matricule'            => $request->input('cin'),
            'cin'                  => $request->input('cin'),
            'nom'                  => $request->input('nom'),
            'prenom'               => $request->input('prenom'),
            'nom_ar'               => $request->input('nom_ar'),
            'prenom_ar'            => $request->input('prenom_ar'),
            'full_name'            => $request->input('full_name'),
            'email'                => $request->input('email'),
            'active'               => $request->input('active'),
            'ddn'                  => $request->input('ddn'),
            'gov'                  => $request->input('gov'),
            'genre'                => $request->input('genre'),
            'nationnalite'         => $request->input('nationnalite'),
            'date_recrutement'     => $request->input('date_recrutement'),
            'grade'                => $request->input('grade'),
            'grade_date'           => $request->input('grade_date'),
            'poste'                => $request->input('poste'),
            'rue_personnel'        => $request->input('rue_personnel'),
            'rue_personnel_ar'     => $request->input('rue_personnel_ar'),
            'categorie'            => $request->input('categorie'),
            'codepostal_personnel' => $request->input('codepostal_personnel'),
            'tel1_personnel'       => $request->input('tel1_personnel'),
            'tel2_personnel'       => $request->input('tel2_personnel'),
            'etat_civil'           => $request->input('etat_civil'),
            'nom_garant'           => $request->input('nom_garant'),
            'profession_garant'    => $request->input('profession_garant'),
            'nbr_enfant'           => $request->input('nbr_enfant'),
            'autre'                => $request->input('autre'),
            'cin_date'             => $request->input('cin_date'),
            'rib_perso'            => $request->input('rib_perso'),
        ]);
        error_log("----------------------------------------------------------------".$response);
        return redirect()->back()->with('message', 'Profil personnel est modifié avec succés!');
    }

    public function updateProfile(Request $request, $id)
    {
        $image       = $request->profile_image;
        $myPhoto     = $this->convertImage($image);
        $myExtPhoto  = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-profilePersonnel/'.$id, [
            'profile_image'     => $myPhoto,
            'extensionProfile'  => $myExtPhoto,
        ]);
        error_log($response);
        return redirect()->back()->with('message', 'Photo de profil est modifiée avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-personnel/'.$id);
        return redirect()->back()->with('message', 'Compte personnel est supprimé avec succés'); 
    }
}
