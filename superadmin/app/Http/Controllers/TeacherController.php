<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response);  
        return view('teacher.index', ['teachers' => $teachers]);
    }

    public function scheduleteacher()
    {   
        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response);  
        return view('teacher.scheduleteacher', ['teachers' => $teachers]);
    }

    public function scheduleteacherDetails($id)
    {   
        $inserted = array( 'vide' );
        
        $response = Http::get($this->getUrlServer().'/getVoeuxByIdTeacher/'.$id);
        $voeuxTeachers = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/getEmploiTempsTeacher/'.$id);
        $emploiTeacher = json_decode($response2); 

        $response3 = Http::get($this->getUrlServer().'/teacher/'.$id);
        $teachers = json_decode($response3);  

        $response4 = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response4);

        $response5 = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response5);

        $response6 = Http::get($this->getUrlServer().'/sallesdep');
        $salles = json_decode($response6);

        //get all seances from id Teacher
        $response7 = Http::get($this->getUrlServer().'/emploi-teacher/'.$id);
        $teacherEmploi = json_decode($response7);  
        /*********************************************************************************** */
        $responseLundi = Http::get($this->getUrlServer().'/emploi-teacher-day/'.$id.'/Lundi');
        $teacherEmploiLundi = json_decode($responseLundi);
        $resultLundi = $teacherEmploiLundi;// $this->analyseEmploi($teacherEmploiLundi);
        //array_splice( $resultLundi, 3, 0, $inserted );

        $responseMardi = Http::get($this->getUrlServer().'/emploi-teacher-day/'.$id.'/Mardi');
        $teacherEmploiMardi = json_decode($responseMardi);
        $resultMardi = $teacherEmploiMardi;// $this->analyseEmploi($teacherEmploiMardi);
        //array_splice( $resultMardi, 3, 0, $inserted );

        $responseMercredi = Http::get($this->getUrlServer().'/emploi-teacher-day/'.$id.'/Mercredi');
        $teacherEmploiMercredi = json_decode($responseMercredi);
        $resultMercredi = $teacherEmploiMercredi;// $this->analyseEmploi($teacherEmploiMercredi);
        //array_splice( $resultMercredi, 3, 0, $inserted );

        $responseJeudi = Http::get($this->getUrlServer().'/emploi-teacher-day/'.$id.'/Jeudi');
        $teacherEmploiJeudi = json_decode($responseJeudi);
        $resultJeudi = $teacherEmploiJeudi;// $this->analyseEmploi($teacherEmploiJeudi);
        //array_splice( $resultJeudi, 3, 0, $inserted );

        $responseVendredi = Http::get($this->getUrlServer().'/emploi-teacher-day/'.$id.'/Vendredi');
        $teacherEmploiVendredi = json_decode($responseVendredi);
        $resultVendredi = $teacherEmploiVendredi;//  $this->analyseEmploi($teacherEmploiVendredi);
        //array_splice( $resultVendredi, 3, 0, $inserted );

        $responseSamedi = Http::get($this->getUrlServer().'/emploi-teacher-day/'.$id.'/Samedi');
        $teacherEmploiSamedi = json_decode($responseSamedi);
        $resultSamedi = $teacherEmploiSamedi;// $this->analyseEmploi($teacherEmploiSamedi);
        //array_splice( $resultSamedi, 3, 0, $inserted );

        //$salle_list = DB::table('salle_emplois')->groupBy('salle_id')->get(['salle_id']);
        $salle_list = DB::table('salle_emplois')
                    ->select('salle_emplois.salle_id','salles.fullName')
                    ->join('salles','salles.id','=','salle_emplois.salle_id')
                    ->groupBy('salle_emplois.salle_id','salles.fullName')
                    ->get(['salle_emplois.salle_id','salles.fullName']);

        return view('teacher.scheduledetails', ['teachers' => $teachers, 'matieres' => $matieres,
                                                'teacherEmploiLundi' => $resultLundi, 'teacherEmploiMardi' => $resultMardi, 
                                                'teacherEmploiMercredi' => $resultMercredi, 'teacherEmploiJeudi' => $resultJeudi, 
                                                'teacherEmploiVendredi' => $resultVendredi, 'teacherEmploiSamedi' => $resultSamedi,
                                                'classes' => $classes, 'salles' => $salles, 'teacherEmploi' => $teacherEmploi,
                                                'salle_list' => $salle_list, 'voeuxTeachers' => $voeuxTeachers,
                                                'emploiTeacher' => $emploiTeacher]);
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

    public function fetch(Request $request)
    {
        $select    = $request->get('select');
        $value     = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('salle_emplois')
                    ->where($select, $value)
                    ->groupBy($dependent)
                    ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach ($data as $row) {
            $output .= '<option value="'.row->$dependent.'">'.row->$dependent.'</option>';
        }
        echo $output;
    }

    public function getAllSalles ()
    {
        $salle_list = DB::table('salle_emplois')
                    ->select('salle_emplois.salle_id','salles.fullName')
                    ->join('salles','salles.id','=','salle_emplois.salle_id')
                    ->groupBy('salle_emplois.salle_id','salles.fullName')
                    ->get(['salle_emplois.salle_id','salles.fullName']);
        return view('teacher.dynamic_dependent', ['salle_list' => $salle_list]);
    }

    public function getMatiere(Request $request)
    {
        $states = DB::table("matiere_classes")
                ->select('matiere_classes.matiere_id', 'matieres.subjectLabel', 'matieres.description')
                ->join('matieres','matieres.id','=','matiere_classes.matiere_id')
                ->where("matiere_classes.classe_id", $request->classe_id) //->where("classe_id", 1)
                ->get("matiere_classes.matiere_id", "matieres.subjectLabel", "matieres.description");
                error_log($states);
                //return ($states);
        return response()->json($states);
    }

    public function getHeureByDay($id_salle, $nom_jour)
    {
        $response = Http::get($this->getUrlServer().'/getHeure-salle/'.$id_salle.'/'.$nom_jour);
        $result = json_decode($response);
            //return ($states);
        return response()->json($result);
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
        return view('teacher.create');
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
            'email'              => $request->input('email'),
            'password'           => $request->input('tel1_teacher'),
            'active'             => $request->input('active'),
            'ddn'                => $request->input('ddn'),
            'gov'                => $request->input('gov'),
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
            'profile_image'      => $myFile,
            'extensionImg'       => $myExtFile,
        ]);
        error_log("Add new Teacher---------------------------------------------------".$response);
        return redirect('/teachers')->with('message', 'Enseignant est ajouté avec succés');    
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

        $response4 = Http::get($this->getUrlServer().'/reclamations/'.$id);
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

    public function addprofileStore(Request $request)
    {
        $image      = $request->profile_image;
        $myImage64  = $this->convertImage($image);
        $myExtImg64 = $this->getExtensionImage($image);

        $response = Http::post($this->getUrlServer().'/profiles', [
            'ddn'           => $request->input('ddn'),
            'genre'         => $request->input('genre'),
            'phone'         => $request->input('phone'),
            'gov'           => $request->input('gov'),
            'rue'           => $request->input('rue'),
            'codepostal'    => $request->input('codepostal'),
            'profile_image' => $myImage64,
            'extensionImg'  => $myExtImg64,
            'teacher_id'    => $request->input('teacher_id'),
        ]);

        return redirect('/teachers')->with('message', 'Profil enseignant est ajouté avec succés');
    }

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

        return view('teacher.edit', ['profiles' => $profiles]);
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
        ]);

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
