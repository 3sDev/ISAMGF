<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InscriptionController extends Controller
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
        return view('auth.inscription');
    }

    public function indexNew()
    {
        return view('auth.inscription-nouveau');
    }

    public function verify()
    {
        return view('auth.verify');
    }

    public function verification(Request $request)
    {
        $tel = $request->tel;
        $cin = $request->cin;

        $student = Student::where('tel1_etudiant', '=', $tel)->where('cin', '=', $cin)->first();

        if ($student === null) {
            return redirect('login-verify')->with('student', $student)->with('successMsg','Team is updated .');
        }
        else {
            //return $student;
            $studentResult = array($student);
            return view('auth.fiche-inscription', ['myStudent' => $studentResult]);
        }
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
    public function storeNew(Request $request)
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
        //$myPassword = $request->input('cin').$request->input('tel1_etudiant');
        
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

           return view('auth.fiche-inscription', ['myStudent' => $myStudent]);
        //return redirect('/login')->with('message', 'Votre inscription a été envoyée avec succés');;
    }

    public function store(Request $request)
    {
        $myImage       = $request->profile_image;
        $imageConvert  = $this->convertImage($myImage);
        $imgExtension  = $this->getExtensionImage($myImage);

        $myCin1        = $request->cin_file;
        $cinConvert1   = $this->convertImage($myCin1);
        $cinExtension1 = $this->getExtensionFile($myCin1);

        $myCin2        = $request->cin_file_2;
        $cinConvert2   = $this->convertImage($myCin2);
        $cinExtension2 = $this->getExtensionFile($myCin2);

        $myInscrit        = $request->paiement_file;
        $inscritConvert   = $this->convertImage($myInscrit);
        $inscritExtension = $this->getExtensionFile($myInscrit);

        //$randomMatricule = mt_rand(10000000, 99999999);
      	$fullName = $request->input('nom').' '.$request->input('prenom');
      	$qrCODE   = $request->input('nom').$request->input('prenom').$request->input('cin').date("Y-m-d h:i:sa");
        
        $response = Http::post($this->getUrlServer().'/inscription-new', [
            'prenom'              => $request->input('prenom'),
            'prenom_ar'           => $request->input('prenom_ar'),
            'nom'                 => $request->input('nom'),
            'nom_ar'              => $request->input('nom_ar'),
            'full_name'           => $fullName,
            'matricule'           => $request->input('matricule'),
            'lieu_naissance'      => $request->input('lieu_naissance'),
            'ddn'                 => $request->input('ddn'),
            'etat_civil'          => $request->input('etat_civil'),
            'genre'               => $request->input('genre'),
            'cin'                 => $request->input('cin'),
            'prenom_pere'         => $request->input('prenom_pere'),
            'prenom_mere'         => $request->input('prenom_mere'),
            'profession_pere'     => $request->input('profession_pere'),
            'gov'                 => $request->input('gov'),
            'codepostal_etudiant' => $request->input('codepostal_etudiant'),
            'rue_etudiant'        => $request->input('rue_etudiant'),
            'tel1_etudiant'       => $request->input('tel1_etudiant'),
            'email'               => $request->input('email'),
            'password'            => 'student123',
            'session_bac'         => $request->input('session_bac'),
            'section_bac'         => $request->input('section_bac'),
            'annee_bac'           => $request->input('annee_bac'),
            'moyenne_bac'         => $request->input('moyenne_bac'),
            'filiere'             => $request->input('filiere'),
            'active'              => '0',
            'classe_id'           => '38',
            'profile_image'       => $imageConvert,
            'extensionImg'        => $imgExtension,
            'cin_file'            => $cinConvert1,
            'extensionFile'       => $cinExtension1,
            'cin_file_2'          => $cinConvert2,
            'extensionFile1'      => $cinExtension2,
            'paiement_file'       => $inscritConvert,
            'extensionFile2'      => $inscritExtension,
            'qrcode'              => $qrCODE,
           ]);

           $getLastStudent = json_decode($response); 
           $idStudent = $getLastStudent->id;

           $response2 = Http::get($this->getUrlServer().'/student/'.$idStudent);
           $myStudent = json_decode($response2); 

           return view('auth.fiche-inscription', ['myStudent' => $myStudent]);
        //return redirect('/login')->with('message', 'Votre inscription a été envoyée avec succés');;
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
        //
    }
}
