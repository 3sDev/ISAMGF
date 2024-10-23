<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentFormRequest;
use App\Imports\EtudiantImport;
use App\Models\Etudiant;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\showNotification;

class StudentController extends Controller
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
        $response = Http::get($this->getUrlServer().'/students-classes');
        $students = json_decode($response);   
        return view('student.index', ['students' => $students]);

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
        // $departements = Departements::all();
        // $sections = Section::all();
        // $levels = Level::all();
        // $lvls = DB::table("levels")->pluck("levelLabel", "id");
        //return view('student.create', ['levels' => $levels, 'sections' => $sections, 'departements' => $departements , 'lvls' => $lvls]);
        //return view('student.create');
        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response); 
        return view('student.create', ['classes' => $classes]);
    }

    public function classe()
    {
    $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response); 
        return view('student.class', ['classes' => $classes]);
    }

    //liste des étudiants par classe
    public function showclass(Request $request)
    {
        $classe  = $request->classe_id;

        $response = Http::get($this->getUrlServer().'/name-classe/'.$classe);
        $classResult = json_decode($response);

        $response = Http::get($this->getUrlServer().'/students-classes/'.$classe);
        $students = json_decode($response);

        return view('student.showclass', ['classResult' => $classResult, 'students' => $students]);
    }

    //attendance student
    public function classeAttendance()
    {
        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendance-details');
        $attendances = json_decode($response2); 

        return view('attendance.class', ['classes' => $classes, 'attendances' => $attendances]);
    }


    //Import Students
    public function import()
    {
        return view('student.import');
    }

    public function fileImport(Request $request) 
    {
        $validatedData = $request->validate([
            'file' => 'required',
         ]);
        //Excel::import(new EtudiantImport, $request->file('file'));
        return back();
    }

    //Search Student
    public function searchStudent()
    {   
        return view('student.search');  
    }

    public function search(Request $request){

        if($request->ajax()){
    
            $data=Student::with('classe')->where('nom','like','%'.$request->search.'%')
                                          ->orwhere('prenom','like','%'.$request->search.'%')
                                          ->orwhere('cin','like','%'.$request->search.'%')->get();
    
            $output='';
        if(count($data)>0){
    
             $output ='
                <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">CIN</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Voir profil</th>
                </tr>
                </thead>
                <tbody>';
    
                    foreach($data as $row){
                        $output .='
                        <tr>
                        <th scope="row">'.$row->id.'</th>
                        <td>'.$row->nom.' '.$row->prenom.'</td>
                        <td>'.$row->cin.'</td>
                        <td>'.$row->classe->abbreviation.'</td>
                        <td><a href="students/'.$row->id.'" class="">Voir profil</a></td>
                        </tr>
                        ';
                    }
    
             $output .= '
                 </tbody>
                </table>';
        }
        else{ $output .='Aucun résultat'; }
    
        return $output;
    
        }

    }


    public function getClasse(Request $request)
    {
        $states = DB::table("classes")
            ->where("level_id", $request->level_id)
            ->pluck("classeName", "id");
        return response()->json($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 // Photo de profile
 $myImage       = $request->profile_image;
 $imageConvert  = $this->convertImage($myImage);
 $imgExtension  = $this->getExtensionImage($myImage);

 // CIN face 1
 $myCin1        = $request->cin_file;
 $cinConvert1   = $this->convertImage($myCin1);
 $cinExtension1 = $this->getExtensionFile($myCin1);

 // CIN face 2
 $myCin2        = $request->cin_file_2;
 $cinConvert2   = $this->convertImage($myCin2);
 $cinExtension2 = $this->getExtensionFile($myCin2);

 // Paiement INSCRIPTION.TN
 $myInscrit        = $request->paiement_file;
 $inscritConvert   = $this->convertImage($myInscrit);
 $inscritExtension = $this->getExtensionFile($myInscrit);

 // Derniere rélevée des notes
 $myDerniereRNote        = $request->derniere_relevee_file;
 $DerniereRNoteConvert   = $this->convertImage($myDerniereRNote);
 $DerniereRNoteExtension = $this->getExtensionFile($myDerniereRNote);

  // Mutation
  $myMutation        = $request->mutation_file;
  $mutationConvert   = $this->convertImage($myMutation);
  $mutationExtension = $this->getExtensionFile($myMutation);

 // Sortie institut
 $mySortie        = $request->sortie_file;
 $sortieConvert   = $this->convertImage($mySortie);
 $sortieExtension = $this->getExtensionFile($mySortie);

 // Réorientation
 $myReorientation        = $request->reorientation_file;
 $reorientationConvert   = $this->convertImage($myReorientation);
 $reorientationExtension = $this->getExtensionFile($myReorientation);

 // Reintegration
 $myReintegration        = $request->reintegration_file;
 $reintegrationConvert   = $this->convertImage($myReintegration);
 $reintegrationExtension = $this->getExtensionFile($myReintegration);

 // Demande Ecrite
 $myDemande        = $request->demande_ecrit__file;
 $demandeConvert   = $this->convertImage($myDemande);
 $demandeExtension = $this->getExtensionFile($myDemande);

 // Reçu Paiement Complet
 $myRecuPay        = $request->recu_paiement_file;
 $recupayConvert   = $this->convertImage($myRecuPay);
 $recupayExtension = $this->getExtensionFile($myRecuPay);

 //$randomMatricule = mt_rand(10000000, 99999999);
   $fullName   = $request->input('nom').' '.$request->input('prenom');
   $qrCODE     = $request->input('nom').$request->input('prenom').$request->input('cin').date("Y-m-d h:i:sa");
   $myPassword = $request->input('cin').$request->input('tel1_etudiant');
 
 $response = Http::post($this->getUrlServer().'/inscription-new', [
     'type_inscription'       => $request->input('type_inscription'),
     'prenom'                 => $request->input('prenom'),
     'prenom_ar'              => $request->input('prenom_ar'),
     'nom'                    => $request->input('nom'),
     'nom_ar'                 => $request->input('nom_ar'),
     'full_name'              => $fullName,
     'matricule'              => $request->input('cin'),
     'lieu_naissance'         => $request->input('lieu_naissance'),
     'ddn'                    => $request->input('ddn'),
     'etat_civil'             => $request->input('etat_civil'),
     'genre'                  => $request->input('genre'),
     'cin'                    => $request->input('cin'),
     'nationalite'            => $request->input('nationalite'),
     'prenom_pere'            => $request->input('prenom_pere'),
     'prenom_mere'            => $request->input('prenom_mere'),
     'profession_pere'        => $request->input('profession_pere'),
     'gov'                    => $request->input('gov'),
     'municipality'           => $request->input('municipality'),
     'codepostal_etudiant'    => $request->input('codepostal_etudiant'),
     'rue_etudiant'           => $request->input('rue_etudiant'),
     'rue_etudiant_ar'        => $request->input('rue_etudiant_ar'),
     'tel1_etudiant'          => $request->input('tel1_etudiant'),
     'tel2_etudiant'          => $request->input('tel2_etudiant'),
     'email'                  => $request->input('email'),
     'password'               => $myPassword,
     'session_bac'            => $request->input('session_bac'),
     'section_bac'            => $request->input('section_bac'),
     'annee_bac'              => $request->input('annee_bac'),
     'moyenne_bac'            => $request->input('moyenne_bac'),
     'filiere'                => $request->input('filiere'),
     'diplome'                => $request->input('niveau'),
     'active'                 => '0',
     'classe_id'              => '38',
     'profile_image'          => $imageConvert,
     'extensionImg'           => $imgExtension,

     'cin_file'               => $cinConvert1,
     'extensionFile'          => $cinExtension1,

     'cin_file_2'             => $cinConvert2,
     'extensionFile1'         => $cinExtension2,

     'paiement_file'          => $inscritConvert,
     'extensionFile2'         => $inscritExtension,

     'derniere_relevee_file'  => $DerniereRNoteConvert,
     'extensionDerniereRNote' => $DerniereRNoteExtension,

     'mutation_file'          => $mutationConvert,
     'extensionMutation'      => $mutationExtension,

     'sortie_file'            => $sortieConvert,
     'extensionSortie'        => $sortieExtension,

     'reorientation_file'     => $reorientationConvert,
     'extensionReorientation' => $reorientationExtension,

     'reintegration_file'     => $reintegrationConvert,
     'extensionReintegration' => $reintegrationExtension,

     'demande_ecrit_file'     => $demandeConvert,
     'extensionDemande'       => $demandeExtension,

     'recu_paiement_file'     => $recupayConvert,
     'extensionRecuPay'       => $recupayExtension,

     'qrcode'                 => $qrCODE,
    ]);

    $getLastStudent = json_decode($response); 
    //error_log('myIdStudent= '.$getLastStudent);
    error_log('myStudent= '.$response);
    $idStudent = $getLastStudent->id;

    $response2 = Http::get($this->getUrlServer().'/student/'.$idStudent);
    $myStudent = json_decode($response2); 


    return redirect('/students')->with('message', 'Etudiant est ajouté avec succés');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response1 = Http::get($this->getUrlServer().'/alldemandwithstudent/'.$id);
        $demandestudents = json_decode($response1);  

        $response2 = Http::get($this->getUrlServer().'/attendance-student/'.$id);
        $attendancestudents = json_decode($response2);  

        $response3 = Http::get($this->getUrlServer().'/student-profile/'.$id);
        $profiles = json_decode($response3);   

        $response4 = Http::get($this->getUrlServer().'/reclamations/'.$id);
        $reclamationstudent = json_decode($response4); 

        return view('student.show', ['profiles' => $profiles, 'demandestudents' => $demandestudents,
        'attendancestudents' => $attendancestudents, 'reclamationstudent' => $reclamationstudent]);
        //return view('student.show', compact('student'));
    }

    public function addprofilePage($id)
    {
        $response3 = Http::get($this->getUrlServer().'/student-profile/'.$id);
        $profiles = json_decode($response3);  

        return view('student.createProfile', ['profiles' => $profiles]);
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
            'student_id'    => $request->input('student_id'),
        ]);

        return redirect('/students')->with('message', 'Profil étudiant est ajouté avec succés');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/student-profile/'.$id);
        $profiles = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response2);

        return view('student.edit', ['profiles' => $profiles, 'classes' => $classes]);
    }

    public function searchclasse(Request $request)
    {
        if($request->ajax()){
    
            $data=Student::with('classe')->where('classe_id', '=', $request->search)->get();
    
            $output='';
        if(count($data)>0){
    
             $output ='
                <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">CIN</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Voir profil</th>
                </tr>
                </thead>
                <tbody>';
    
                    foreach($data as $row){
                        $output .='
                        <tr>
                        <th scope="row">'.$row->id.'</th>
                        <td>'.$row->nom.' '.$row->prenom.'</td>
                        <td>'.$row->cin.'</td>
                        <td>'.$row->classe->classeName.'</td>
                        <td><a href="students/'.$row->id.'" class="">Voir profil</a></td>
                        </tr>
                        ';
                    }
    
             $output .= '
                 </tbody>
                </table>';
        }
        else{ $output .='Aucun résultat'; }
    
        return $output;
    
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-student/'.$id, [
            'active'              => $request->input('active'),
            'type_inscription'    => $request->input('type_inscription'),
            'matricule'           => $request->input('cin'),
            'diplome'             => $request->input('niveau'),
            'filiere'             => $request->input('filiere'),
            'nationalite'         => $request->input('nationalite'),
            'cin'                 => $request->input('cin'),
            'nom'                 => $request->input('nom'),
            'prenom'              => $request->input('prenom'),
            'nom_ar'              => $request->input('nom_ar'),
            'prenom_ar'           => $request->input('prenom_ar'),
            'full_name'           => $request->input('full_name'),
            'genre'               => $request->input('genre'),
            'ddn'                 => $request->input('ddn'),
            'lieu_naissance'      => $request->input('lieu_naissance'),
            'gov'                 => $request->input('gov'),
            'municipality'        => $request->input('municipality'),
            'etat_civil'          => $request->input('etat_civil'),
            'annee_bac'           => $request->input('annee_bac'),
            'session_bac'         => $request->input('session_bac'),
            'section_bac'         => $request->input('section_bac'),
            'moyenne_bac'         => $request->input('moyenne_bac'),
            'rue_etudiant'        => $request->input('rue_etudiant'),
            'rue_etudiant_ar'     => $request->input('rue_etudiant_ar'),
            'codepostal_etudiant' => $request->input('codepostal_etudiant'),
            'tel1_etudiant'       => $request->input('tel1_etudiant'),
            'tel2_etudiant'       => $request->input('tel2_etudiant'),
            'prenom_pere'         => $request->input('prenom_pere'),
            'profession_pere'     => $request->input('profession_pere'),
            'prenom_mere'         => $request->input('prenom_mere'),
            'email'               => $request->input('email'),
            'classe_id'           => $request->input('classe_id'),
        ]);
        //error_log($response);
        return redirect()->back()->with('message', 'Etudiant(e) est modifié(e) avec succés'); 
    }

    // public function updateProfile(Request $request, $id)
    // {
    //     $response = Http::put($this->getUrlServer().'/update-profilestudent/'.$id, [
    //         'ddn'           => $request->input('ddn'),
    //         'genre'         => $request->input('genre'),
    //         'gov'           => $request->input('gov'),
    //         'rue'           => $request->input('rue'),
    //         'codepostal'    => $request->input('codepostal'),
    //         'profile_image' => $request->input('profile_image'),
    //         'student_id'    => $request->input('student_id'),
    //     ]);
        
    //     return redirect()->back()->with('message', 'Profile étudiant est modifiée avec succés');
    // }

    public function updateAccount(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-accountstudent/'.$id, [
            'active' => $request->input('active'),
        ]);
        
        return redirect()->back();
    }

    public function updateCinF1(Request $request, $id)
    {
        $image     = $request->cin_file;
        $myCin1    = $this->convertImage($image);
        $myExtCin1 = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-cinFace1/'.$id, [
            'cin_file'      => $myCin1,
            'extensionCin1' => $myExtCin1,
        ]);
        error_log($response);
        return redirect()->back()->with('message', 'CIN face 1 est modifié avec succés'); 
    }
    
    public function updateCinF2(Request $request, $id)
    {
        $image     = $request->cin_file_2;
        $myCin2    = $this->convertImage($image);
        $myExtCin2 = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-cinFace2/'.$id, [
            'cin_file_2'    => $myCin2,
            'extensionCin2' => $myExtCin2,
        ]);
        error_log($response);
        return redirect()->back()->with('message', 'CIN face 2 est modifié avec succés'); 
    }

    public function updateFichePay(Request $request, $id)
    {
        $image        = $request->paiement_file;
        $myInscrit    = $this->convertImage($image);
        $myExtInscrit = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-filePay/'.$id, [
            'paiement_file'    => $myInscrit,
            'extensionInscrit' => $myExtInscrit,
        ]);
        error_log($response);
        return redirect()->back()->with('message', 'Fiche d\'inscription est modifié avec succés'); 
    }

    public function updatePhotoPro(Request $request, $id)
    {
        $image      = $request->profile_image;
        $myImg      = $this->convertImage($image);
        $myExtImg   = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-profile/'.$id, [
            'profile_image'    => $myImg,
            'extensionProfile' => $myExtImg,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Photo de profil est modifiée avec succés'); 
    }



// updateCinF2
// updateFichePay
// updatePhotoPro

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $student->delete();
        // return redirect()->back()->with('message', 'Student est supprimé avec succés');
        $response = Http::delete($this->getUrlServer().'/delete-student/'.$id);
        return redirect()->back()->with('message', 'Student est supprimée avec succés'); 
    }
}
