<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
//use App\Http\Controllers\showNotification;

class TeacherController extends Controller
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
        // $response = Http::get($this->getUrlServer().'/all-voeux-teachers');
        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response);  
        return view('teacher.index', ['teachers' => $teachers]);
    }

    public function scheduleteacher()
    {   
        $response = Http::get($this->getUrlServer().'/all-teachers-voeux');
        $teachers = json_decode($response);  
        return view('teacher.scheduleteacher', ['teachers' => $teachers]);
    }

    public function scheduleteacherDetails($id)
    {   
        $response = Http::get($this->getUrlServer().'/teacher-voeu/'.$id);
        $teachers = json_decode($response);  

        $response = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response);

        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response);

        $response = Http::get($this->getUrlServer().'/sallesdep');
        $salles = json_decode($response);

        //get all seances from id Teacher
        $response = Http::get($this->getUrlServer().'/emploi-teacher/'.$id);
        $teacherEmploi = json_decode($response);  

        return view('teacher.scheduledetails', ['teachers' => $teachers, 'matieres' => $matieres,
        'classes' => $classes, 'salles' => $salles, 'teacherEmploi' => $teacherEmploi]);
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
        $response = Http::get($this->getUrlServer().'/departements');
        $departements = json_decode($response); 
        $response = Http::get($this->getUrlServer().'/specialites');
        $specialites = json_decode($response); 
        
        return view('teacher.create', ['departements' => $departements, 'specialites' => $specialites]);
    }

    public function affecter($id)
    {
        $response1 = Http::get($this->getUrlServer().'/teacher-profile/'.$id);
        $teachers = json_decode($response1);    

        $response4 = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response4); 

        $response4 = Http::get($this->getUrlServer().'/matieres-teacher/'.$id);
        $matieresTeachers = json_decode($response4); 

        return view('teacher.affecter', ['teachers' => $teachers, 'matieres' => $matieres
        , 'matieresTeachers' => $matieresTeachers]);
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
        $response = Http::post($this->getUrlServer().'/teachers', [
            'type_enseignant'    => $request->input('type_enseignant'),
            'mat_cnrps'          => $request->input('mat_cnrps'),
            'matricule'          => $request->input('cin'),
            'cin'                => $request->input('cin'),
            'nom'                => $request->input('nom'),
            'prenom'             => $request->input('prenom'),
            'nom_ar'             => $request->input('nom_ar'),
            'prenom_ar'          => $request->input('prenom_ar'),
            'full_name'          => $fullName,
            'email'             => $request->input('email'),
            'password'          => $request->input('tel1_teacher'),
            'active'             => '0',
            'ddn'                => $request->input('ddn'),
            'gov'                => $request->input('gov'),
            'gov_ar'             => $request->input('gov_ar'),
            'genre'              => $request->input('genre'),
            'nationnalite'       => $request->input('nationnalite'),
            'niveau_educat'      => $request->input('niveau_educat'),
            'diplome1'           => $request->input('diplome1'),
            'diplome_annee1'     => $request->input('diplome_annee1'),
            'diplome_etab1'      => $request->input('diplome_etab1'),
            'diplome2'           => $request->input('diplome2'),
            'diplome_annee2'     => $request->input('diplome_annee2'),
            'diplome_etab2'      => $request->input('diplome_etab2'),
            'diplome3'           => $request->input('diplome3'),
            'diplome_annee3'     => $request->input('diplome_annee3'),
            'diplome_etab3'      => $request->input('diplome_etab3'),
            'date_recrutement'   => $request->input('date_recrutement'),
            'grade'              => $request->input('grade'),
            'grade_date'         => $request->input('grade_date'),
            'poste'              => $request->input('poste'),
            'rue_teacher'        => $request->input('rue_teacher'),
            'codepostal_teacher' => $request->input('codepostal_teacher'),
            'tel1_teacher'       => $request->input('tel1_teacher'),
            'etat_civil'         => $request->input('etat_civil'),
            'nom_garant'         => $request->input('nom_garant'),
            'profession_garant'  => $request->input('profession_garant'),
            'nbr_enfant'         => $request->input('nbr_enfant'),
            'autre'              => $request->input('autre'),
            'cin_date'           => $request->input('cin_date'),
            'specialite_ens'     => $request->input('specialite_ens'),
            'departement_id'     => $request->input('departement_id'),
            'rib_ens'            => $request->input('rib_ens'),
            'tel2_ens'           => $request->input('tel2_ens'),
            'profile_image'      => $myFile,
            'extensionImg'       => $myExtFile,
        ]);

        error_log('myTeacher= '.$response);

        return redirect('/teachers/create')->with('message', 'Enseignant est ajouté avec succés');    
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response1 = Http::get($this->getUrlServer().'/alldemandwithteacher/'.$id);
        $demandetachers = json_decode($response1);  

        $response2 = Http::get($this->getUrlServer().'/attendance-teacher/'.$id);
        $attendanceteachers = json_decode($response2);  

        $response3 = Http::get($this->getUrlServer().'/teacher-profile/'.$id);
        $profiles = json_decode($response3);   

        $response4 = Http::get($this->getUrlServer().'/reclamationsTeacher/'.$id);
        $reclamationteacher = json_decode($response4); 

        return view('teacher.show', ['profiles' => $profiles, 'demandetachers' => $demandetachers,
        'attendanceteachers' => $attendanceteachers, 'reclamationteacher' => $reclamationteacher]);
    }

    public function addprofilePage($id)
    {
        $response3 = Http::get($this->getUrlServer().'/teacher-profile/'.$id);
        $profiles = json_decode($response3);  

        return view('teacher.createProfile', ['profiles' => $profiles]);
    }

    // public function addprofileStore(Request $request)
    // {
    //     $image      = $request->profile_image;
    //     $myImage64  = $this->convertImage($image);
    //     $myExtImg64 = $this->getExtensionImage($image);

    //     $response = Http::post($this->getUrlServer().'/profiles', [
    //         'ddn'           => $request->input('ddn'),
    //         'genre'         => $request->input('genre'),
    //         'phone'         => $request->input('phone'),
    //         'gov'           => $request->input('gov'),
    //         'rue'           => $request->input('rue'),
    //         'codepostal'    => $request->input('codepostal'),
    //         'profile_image' => $myImage64,
    //         'extensionImg'  => $myExtImg64,
    //         'teacher_id'    => $request->input('teacher_id'),
    //     ]);

    //     return redirect('/teachers')->with('message', 'Profil enseignant est ajouté avec succés');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/teacher-profile/'.$id);
        $profiles = json_decode($response);  

        $response1 = Http::get($this->getUrlServer().'/departements');
        $departements = json_decode($response1); 

        $response2 = Http::get($this->getUrlServer().'/specialites');
        $specialites = json_decode($response2); 
        
        return view('teacher.edit', ['profiles' => $profiles, 'departements' => $departements, 'specialites' => $specialites]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fullName = $request->input('nom').' '.$request->input('prenom');
        $response = Http::put($this->getUrlServer().'/update-teacher/'.$id, [
            'type_enseignant'    => $request->input('type_enseignant'),
            'mat_cnrps'          => $request->input('mat_cnrps'),
            'matricule'          => $request->input('cin'),
            'cin'                => $request->input('cin'),
            'nom'                => $request->input('nom'),
            'prenom'             => $request->input('prenom'),
            'nom_ar'             => $request->input('nom_ar'),
            'prenom_ar'          => $request->input('prenom_ar'),
            'full_name'          => $fullName,
            'email'              => $request->input('email'),
            'password '          => $request->input('tel1_teacher'),
            'active'             => $request->input('active'),
            'ddn'                => $request->input('ddn'),
            'gov'                => $request->input('gov'),
            'gov_ar'             => $request->input('gov_ar'),
            'genre'              => $request->input('genre'),
            'nationnalite'       => $request->input('nationnalite'),
            'niveau_educat'      => $request->input('niveau_educat'),
            'diplome1'           => $request->input('diplome1'),
            'diplome_annee1'     => $request->input('diplome_annee1'),
            'diplome_etab1'      => $request->input('diplome_etab1'),
            'diplome2'           => $request->input('diplome2'),
            'diplome_annee2'     => $request->input('diplome_annee2'),
            'diplome_etab2'      => $request->input('diplome_etab2'),
            'diplome3'           => $request->input('diplome3'),
            'diplome_annee3'     => $request->input('diplome_annee3'),
            'diplome_etab3'      => $request->input('diplome_etab3'),
            'date_recrutement'   => $request->input('date_recrutement'),
            'grade'              => $request->input('grade'),
            'grade_date'         => $request->input('grade_date'),
            'poste'              => $request->input('poste'),
            'rue_teacher'        => $request->input('rue_teacher'),
            'codepostal_teacher' => $request->input('codepostal_teacher'),
            'tel1_teacher'       => $request->input('tel1_teacher'),
            'etat_civil'         => $request->input('etat_civil'),
            'nom_garant'         => $request->input('nom_garant'),
            'profession_garant'  => $request->input('profession_garant'),
            'nbr_enfant'         => $request->input('nbr_enfant'),
            'autre'              => $request->input('autre'),
            'cin_date'           => $request->input('cin_date'),
            'specialite_ens'     => $request->input('specialite_ens'),
            'departement_id'     => $request->input('departement_id'),
            'rib_ens'            => $request->input('rib_ens'),
            'tel2_ens'           => $request->input('tel2_ens'),
        ]);
        error_log('myTeacher update = '.$response);
        return redirect()->back()->with('message', 'Profil enseignant est modifié avec succés');
    }

    public function updateProfile(Request $request)
    {
        $image       = $request->profile_image;
        $myPhoto     = $this->convertImage($image);
        $myExtPhoto  = $this->getExtensionImage($image);

        $response = Http::post($this->getUrlServer().'/update-profileTeacher', [
            'profile_image'     => $myPhoto,
            'extensionProfile'  => $myExtPhoto,
        ]);
        error_log($response);
        return redirect()->back()->with('message', 'Photo de profil est modifiée avec succés'); 
    }

    // public function updateProfile(Request $request, $id)
    // {
    //     $response = Http::put($this->getUrlServer().'/update-profileteacher/'.$id, [
    //         'ddn'           => $request->input('ddn'),
    //         'genre'         => $request->input('genre'),
    //         'gov'           => $request->input('gov'),
    //         'rue'           => $request->input('rue'),
    //         'codepostal'    => $request->input('codepostal'),
    //         'profile_image' => $request->input('profile_image'),
    //     ]);
        
    //     return redirect()->back()->with('message', 'Profil enseignant est modifié avec succés');
    // }

    public function updateAccount(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-accountteacher/'.$id, [
            'active' => $request->input('active'),
        ]);
        
        return redirect()->back();
    }

    public function multiMatiere(Request $request)
    {
        $IDteacher = $request->idTeacher;
        $IDmatiere = $request->ID_Matiere;
        $dateNow  = Carbon::now();
        foreach ($IDteacher as $key => $insert) {
            $datasave = [
                'teacher_id'  => $IDteacher[$key],
                'matiere_id'  => $IDmatiere[$key],
                'created_at'  => $dateNow,
                'updated_at'  => $dateNow,
            ];
            DB::table('matiere_teachers')->insert($datasave);
        }
        //return $datasave;
        return redirect()->back()->with('message', 'Liste des matière est ajoutée avec succés');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-teacher/'.$id);
        return redirect()->back()->with('message', 'Compte enseignant est supprimé avec succés'); 
    }

    public function destroyMatiereFromTeacher($id)
    {
        $response1 = Http::delete($this->getUrlServer().'/delete-matiereteacher/'.$id);
        return redirect()->back()->with('message', 'Matière est supprimé avec succés'); 
    }
}
