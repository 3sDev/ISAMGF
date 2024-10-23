<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentFormRequest;
use App\Models\Student;
use App\Models\Classe;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

//use App\Http\Controllers\showNotification;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $response = Student::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllStudents()
    {
        $response = Student::all();
        $data = json_decode($response);
        return $data;
    }
    
  	public function getAllStudentsWithProfiles()
    {
        $response = Student::all();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllStudentsWithClasse()
    {
        $response = Student::with('classe')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllStudentsWithClasseFromIdClasse($id)
    {
        $response = Student::with('classe')->where("classe_id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getStudentWithProfileFromId($id)
    {
        $response = Student::with('classe')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getProfileWithStudent($id)
    {
        //$response = Student::with('profileStudent')->where("id", "=", $id)->get();
        $response = Student::where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getStudentWithClasseFromId($id)
    {
        $response = Student::with('classe')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('paid');
        });
    }

    public function getClasseWithStudentFromId($id)
    {
        $response = Classe::with('student')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getClasseWithAllStudentsFromId($id)
    {
        $response = Classe::with('students')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllAttendanceWithStudentFromId($id)
    {
        $response = Student::with('attendances')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
    }

    //Get name of class from management student list (Dashboard)
    public function getNameOfclass($id)
    {
        $response = Classe::where("id", "=", $id)->get();
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
       // return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeNew(StudentFormRequest $request)
    {
        //error_log('test recieved data');
         //Service Convert Image
         $extImage  = $request->extensionImg;
         $dataImage = base64_decode($request->profile_image); //decode base64 string
         $nameImage = time().".$extImage";
         $file      = "upload/students/".$nameImage;
         $moveImage = file_put_contents($file, $dataImage);
 
         //Service Convert PDF - CIN Face 1
         $extFileCIN  = $request->extensionFile;
         $dataFileCIN = base64_decode($request->cin_file); //decode base64 string
         $nameFileCIN = time().".$extFileCIN";
         $fileCIN     = "upload/students/cin/".$nameFileCIN;
         $moveMyCin1  = file_put_contents($fileCIN, $dataFileCIN);

        //Service Convert PDF - CIN Face 2
        $extFileCIN1  = $request->extensionFile1;
        $dataFileCIN1 = base64_decode($request->cin_file_2); //decode base64 string
        $nameFileCIN1 = time().".$extFileCIN1";
        $fileCIN1     = "upload/students/cinFace2/".$nameFileCIN1;
        $moveMyCin2   = file_put_contents($fileCIN1, $dataFileCIN1);

        //Service Convert PDF - FICHE INSCRIPTION
        $extFileINSCRIT  = $request->extensionFile2;
        $dataFileINSCRIT = base64_decode($request->paiement_file); //decode base64 string
        $nameFileINSCRIT = time().".$extFileINSCRIT";
        $fileINSCRIT     = "upload/students/inscription/".$nameFileINSCRIT;
        $moveFile2       = file_put_contents($fileINSCRIT, $dataFileINSCRIT);

        //Service Convert PDF - Derniere rélevée des notes
        if ($request->extensionDerniereRNote != '') {
            $extReleveeNote  = $request->extensionDerniereRNote;
            $dataReleveeNote = base64_decode($request->derniere_relevee_file); //decode base64 string
            $nameReleveeNote = time().".$extReleveeNote";
            $ReleveeNote     = "upload/students/derniereReleveeNotes/".$nameReleveeNote;
            $moveFile2       = file_put_contents($ReleveeNote, $dataReleveeNote);
        }
        else { $nameReleveeNote = null; }
        

        //Service Convert PDF - Mutation
        if ($request->extensionMutation != '') {
        $extMutation  = $request->extensionMutation;
        $dataMutation = base64_decode($request->mutation_file); //decode base64 string
        $nameMutation = time().".$extMutation";
        $Mutation     = "upload/students/mutation/".$nameMutation;
        $moveFile2       = file_put_contents($Mutation, $dataMutation);
        }
        else { $nameMutation = null; }

        //Service Convert PDF - Quite L'institut
        if ($request->extensionSortie != '') {
        $extSortie  = $request->extensionSortie;
        $dataSortie = base64_decode($request->sortie_file); //decode base64 string
        $nameSortie = time().".$extSortie";
        $Sortie     = "upload/students/quiteInstitut/".$nameSortie;
        $moveFile2       = file_put_contents($Sortie, $dataSortie);
        }
        else { $nameSortie = null; }

        //Service Convert PDF - Réorientation
        if ($request->extensionReorientation != '') {
        $extReorientation  = $request->extensionReorientation;
        $dataReorientation = base64_decode($request->reorientation_file); //decode base64 string
        $nameReorientation = time().".$extReorientation";
        $Reorientation     = "upload/students/reorientation/".$nameReorientation;
        $moveFile2       = file_put_contents($Reorientation, $dataReorientation);
        }
        else { $nameReorientation = null; }

        //Service Convert PDF - Réorientation
        if ($request->extensionReintegration != '') {
        $extReintegration  = $request->extensionReintegration;
        $dataReintegration = base64_decode($request->reintegration_file); //decode base64 string
        $nameReintegration = time().".$extReintegration";
        $Reintegration     = "upload/students/reintegration/".$nameReintegration;
        $moveFile2       = file_put_contents($Reintegration, $dataReintegration);
        }
        else { $nameReintegration = null; }

        //Service Convert PDF - Demande Ecrite
        if ($request->extensionDemande != '') {
        $extDemande  = $request->extensionDemande;
        $dataDemande = base64_decode($request->demande_ecrit_file); //decode base64 string
        $nameDemande = time().".$extDemande";
        $Demande     = "upload/students/demandeEcrite/".$nameDemande;
        $moveFile2       = file_put_contents($Demande, $dataDemande);
        }
        else { $nameDemande = null; }

        //Service Convert PDF - Recu Paiement Total
        if ($request->extensionRecuPay != '') {
        $extRecuPay  = $request->extensionRecuPay;
        $dataRecuPay = base64_decode($request->recu_paiement_file); //decode base64 string
        $nameRecuPay = time().".$extRecuPay";
        $RecuPay     = "upload/students/recuPaimentComplet/".$nameRecuPay;
        $moveFile2       = file_put_contents($RecuPay, $dataRecuPay);
        }
        else { $nameRecuPay = null; }

        $student                      = new Student;
        $student->type_inscription    = $request->input('type_inscription');
        $student->prenom              = $request->input('prenom');
        $student->prenom_ar           = $request->input('prenom_ar');
        $student->nom                 = $request->input('nom');
        $student->nom_ar              = $request->input('nom_ar');
        $student->full_name           = $request->input('full_name');
        $student->matricule           = $request->input('matricule');
        $student->lieu_naissance      = $request->input('lieu_naissance');
        $student->ddn                 = $request->input('ddn');
        $student->etat_civil          = $request->input('etat_civil');
        $student->genre               = $request->input('genre');
        $student->cin                 = $request->input('cin');
        $student->passport            = $request->input('passport');
        $student->nationalite         = $request->input('nationalite');
        $student->prenom_pere         = $request->input('prenom_pere');
        $student->prenom_mere         = $request->input('prenom_mere');
        $student->profession_pere     = $request->input('profession_pere');
        $student->gov                 = $request->input('gov');
        $student->municipality        = $request->input('municipality');
        $student->codepostal_etudiant = $request->input('codepostal_etudiant');
        $student->rue_etudiant        = $request->input('rue_etudiant');
        $student->rue_etudiant_ar     = $request->input('rue_etudiant_ar');
        $student->tel1_etudiant       = $request->input('tel1_etudiant');
        $student->tel2_etudiant       = $request->input('tel2_etudiant');
        $student->email               = $request->input('email');
        $student->password            = Hash::make($request->input('password'));
        $student->session_bac         = $request->input('session_bac');
        $student->section_bac         = $request->input('section_bac');
        $student->annee_bac           = $request->input('annee_bac');
        $student->moyenne_bac         = $request->input('moyenne_bac');
        $student->filiere             = $request->input('filiere');
        $student->diplome             = $request->input('diplome');
        $student->active              = $request->input('active');
        //$student->qrcode              = $request->input('qrcode');
        $student->qrcode              = str_replace ('/', '', Hash::make($request->input('qrcode')));

        $student->profile_image       = $nameImage;
        $student->cin_file            = $nameFileCIN;
        $student->cin_file_2          = $nameFileCIN1;
        $student->paiement_file       = $nameFileINSCRIT;

        $student->derniere_relevee_file = $nameReleveeNote;
        $student->mutation_file         = $nameMutation;
        $student->sortie_file           = $nameSortie;
        $student->reorientation_file    = $nameReorientation;
        $student->reintegration_file    = $nameReintegration;
        $student->demande_ecrit_file    = $nameDemande;
        $student->recu_paiement_file    = $nameRecuPay;

        $student->classe_id           = '38';
        $student->save();
    
        return $student;
    }

    var $skey = "yourSecretKey"; // you can change it

    public  function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function store(StudentFormRequest $request)
    {
        //Service Convert Image
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->profile_image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/students/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        //Service Convert PDF - CIN Face 1
        $extFileCIN  = $request->extensionFile;
        $dataFileCIN = base64_decode($request->cin_file); //decode base64 string
        $nameFileCIN = time().".$extFileCIN";
        $fileCIN     = "upload/students/cin/".$nameFileCIN;
        $moveMyCin1  = file_put_contents($fileCIN, $dataFileCIN);

        //Service Convert PDF - CIN Face 2
        $extFileCIN1  = $request->extensionFile1;
        $dataFileCIN1 = base64_decode($request->cin_file_2); //decode base64 string
        $nameFileCIN1 = time().".$extFileCIN1";
        $fileCIN1     = "upload/students/cinFace2/".$nameFileCIN1;
        $moveMyCin2   = file_put_contents($fileCIN1, $dataFileCIN1);

        //Service Convert PDF - FICHE INSCRIPTION
        $extFileINSCRIT  = $request->extensionFile2;
        $dataFileINSCRIT = base64_decode($request->paiement_file); //decode base64 string
        $nameFileINSCRIT = time().".$extFileINSCRIT";
        $fileINSCRIT     = "upload/students/inscription/".$nameFileINSCRIT;
        $moveFile2       = file_put_contents($fileINSCRIT, $dataFileINSCRIT);

        $student                      = new Student;
        $student->prenom              = $request->input('prenom');
        $student->prenom_ar           = $request->input('prenom_ar');
        $student->nom                 = $request->input('nom');
        $student->nom_ar              = $request->input('nom_ar');
        $student->full_name           = $request->input('full_name');
        $student->matricule           = $request->input('matricule');
        $student->lieu_naissance      = $request->input('lieu_naissance');
        $student->ddn                 = $request->input('ddn');
        $student->etat_civil          = $request->input('etat_civil');
        $student->genre               = $request->input('genre');
        $student->cin                 = $request->input('cin');
        $student->prenom_pere         = $request->input('prenom_pere');
        $student->prenom_mere         = $request->input('prenom_mere');
        $student->profession_pere     = $request->input('profession_pere');
        $student->gov                 = $request->input('gov');
        $student->codepostal_etudiant = $request->input('codepostal_etudiant');
        $student->rue_etudiant        = $request->input('rue_etudiant');
        $student->tel1_etudiant       = $request->input('tel1_etudiant');
        $student->email               = $request->input('email');
        $student->password            = Hash::make('student123');
        $student->session_bac         = $request->input('session_bac');
        $student->section_bac         = $request->input('section_bac');
        $student->annee_bac           = $request->input('annee_bac');
        $student->moyenne_bac         = $request->input('moyenne_bac');
        $student->filiere             = $request->input('filiere');
        $student->active              = $request->input('active');
        $student->qrcode              = $request->input('qrcode');
        //$student->qrcode              = Hash::make($request->input('qrcode'));

        $student->profile_image       = $nameImage;
        $student->cin_file            = $nameFileCIN;
        $student->cin_file_2          = $nameFileCIN1;
        $student->paiement_file       = $nameFileINSCRIT;
    
        $student->classe_id           = '38';
    
        $student->save();
    
        return $student;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //return view('student.edit', compact('student'));
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
        $student=Student::find($id);
        $student->matricule = $request->input('matricule');
        $student->nom       = $request->input('nom');
        $student->prenom    = $request->input('prenom');
        $student->nom_ar    = $request->input('nom_ar');
        $student->prenom_ar = $request->input('prenom_ar');
        $student->full_name = $request->input('full_name');
        $student->email     = $request->input('email');
        $student->password  = Hash::make($request->input('password'));
        $student->classe_id = $request->input('classe_id');

        $student->update();
    }

    public function updateAccount(Request $request, $id)
    {
        $student=Student::find($id);
        if ($student->active == 0) {
            $student->active = 1;
        }
        else {
            $student->active = 0;
        }   
        $student->update();     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Student::destroy($id);
    }
}