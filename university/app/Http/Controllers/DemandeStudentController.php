<?php

namespace App\Http\Controllers;

use App\Models\DemandeStudent;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Ladumor\OneSignal\OneSignal;

class DemandeStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Student::with('demandesStudents','classe')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function demandefromstudent($id)
    {
        $response = DemandeStudent::with('student', 'classe')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function AllDemandesWithStudentFromID($id)
    {
        $response = DemandeStudent::with('student', 'classe')->where("student_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getDemandeById($id)
    {
        $response = DemandeStudent::with('student', 'classe')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }
  
    public function getAllDemandes()
    {
        $response = DemandeStudent::all();
        $data = json_decode($response);
        return $data;
    }

  	public function getAllDemandesFromStudent()
    {
        $response = DemandeStudent::with('student', 'classe')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllDemandesFromStudentByCategory($cat)
    {
        $response = DemandeStudent::with('student', 'classe')->where("sous_type", "=", $cat)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllDemandesFromStudentByCategoryStage($cat1, $cat2)
    {
        $response = DemandeStudent::with('student', 'classe')->where('sous_type', '=', $cat1)
        ->orWhere('sous_type', '=', $cat2)->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllDemandesFromStudentByServiceScolarite()
    {
        $response = DemandeStudent::with('student', 'classe')
                                        ->where("type", "=", "مصلحة الطلبة")
                                        ->orWhere("type", "=", "مصلحة الامتحانات")
                                        ->orderby("created_at", "desc")->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllDemandesFromStudentByServiceExamens()
    {
        $response = DemandeStudent::with('student', 'classe')
                                        ->where("type", "=", "مصلحة الامتحانات")->get();
        $data = json_decode($response);
       	return $data;
    }
  
  	public function getAllStudentFromDemandes()
    {
        $response = Student::with('demandesStudents')->get();
        $data = json_decode($response);
       	return $data;
    }

    //count
    public function getCountDemandesStudentsByStatut($statut)
    {
        $response = DemandeStudent::where("statut", "=", $statut)->count();
        $data = json_decode($response);
        return $data;
    }
    public function getCountDemandesStudentsByType($type)
    {
        $response = DemandeStudent::where("type", "=", $type)->count();
        $data = json_decode($response);
        return $data;
    }
    public function getCountDemandesStudentsByTypeAndStatut($type, $statut)
    {
        $response = DemandeStudent::where("type", "=", $type)->where("statut", "=", $statut)->count();
        $data = json_decode($response);
        return $data;
    }
    public function countAllDemandesStudents()
    {
        $response = DemandeStudent::count();
        $data = json_decode($response);
        return $data;
    }

    //count
    public function getCountDemandesStageStudents($sous_type, $accepter)
    {
        $response = DemandeStudent::where("sous_type", "=", $sous_type)->where("accepter", "=", $accepter)->count();
        $data = json_decode($response);
        return $data;
    }
    public function getCountDemandesStageStudents2($sous_type, $recuperer)
    {
        $response = DemandeStudent::where("sous_type", "=", $sous_type)->where("recuperer", "=", $recuperer)->count();
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
        //Service Convert PDF - DocFausse
        if ($request->extensionDocFausse != '') {
            $extDocFausse  = $request->extensionDocFausse;
            $dataDocFausse = base64_decode($request->document_fausse); //decode base64 string
            $nameDocFausse = time().".$extDocFausse";
            $DocFausse     = "upload/demandesStudents/documentFausse/".$nameDocFausse;
            $moveFile1       = file_put_contents($DocFausse, $dataDocFausse);
        }
        else { $nameDocFausse = null; }

        //Service Convert PDF - DocPerdue
        if ($request->extensionDocPerdue != '') {
            $extDocPerdue  = $request->extensionDocPerdue;
            $dataDocPerdue = base64_decode($request->attestation_perdue); //decode base64 string
            $nameDocPerdue = time().".$extDocPerdue";
            $DocPerdue     = "upload/demandesStudents/attestationPerdue/".$nameDocPerdue;
            $moveFile2       = file_put_contents($DocPerdue, $dataDocPerdue);
            }
        else { $nameDocPerdue = null; }

        //Service Convert PDF - ReleveeDesNotes
        if ($request->extensionRelvNote != '') {
            $extRelvNote  = $request->extensionRelvNote;
            $dataRelvNote = base64_decode($request->relevee_notes); //decode base64 string
            $nameRelvNote = time().".$extRelvNote";
            $DocRelvNote     = "upload/demandesStudents/releveeNotes/".$nameRelvNote;
            $moveFile3       = file_put_contents($DocRelvNote, $dataRelvNote);
            }
        else { $nameRelvNote = null; }

        $demande = new DemandeStudent;
        $demande->categorie_demande         = $request->input('categorie_demande');  //SERVICE SCOLARITE || SERVICE DES EXAMENS || SERVICE DES Stages 
        $demande->type                      = $request->input('type');
        $demande->sous_type                 = $request->input('sous_type');
        $demande->annee_universitaire       = $request->input('annee_universitaire');
        // $demande->semestre                  = $request->input('semestre');
        $demande->langue                    = $request->input('langue');
        $demande->raison                    = $request->input('raison'); 

        $demande->type_document             = $request->input('type_document');   //correction + duplicata
        $demande->correction_faute          = $request->input('correction_faute');
        $demande->document_fausse           = $nameDocFausse;  //Fichier

        $demande->attestation_perdue        = $nameDocPerdue;  //Fichier  //duplicata

        $demande->nom_examen                = $request->input('nom_examen'); //nom_examen + Double correction

        $demande->type_etudiant             = $request->input('type_etudiant');  //Add new Field
        $demande->ecole_etudiant            = $request->input('ecole_etudiant'); //Valorisation des module
        $demande->previous_annee            = $request->input('previous_annee');
        $demande->previous_annee_specialite = $request->input('previous_annee_specialite');
        $demande->relevee_notes             = $nameRelvNote; //Fichier

        $demande->type_club                 = $request->input('type_club'); //Inscription aux clubs
        $demande->club_id                   = $request->input('club_id'); //Inscription aux clubs

        $demande->sortie_raison             = $request->input('sortie_raison'); //Organiser une sortie
        $demande->sortie_destination        = $request->input('sortie_destination');
        $demande->sortie_debut              = $request->input('sortie_debut');
        $demande->sortie_fin                = $request->input('sortie_fin');
        $demande->sortie_compagnon          = $request->input('sortie_compagnon');

        $demande->mission_raison            = $request->input('mission_raison'); //faciliter une mission
        $demande->mission_destination       = $request->input('mission_destination');
        $demande->mission_debut             = $request->input('mission_debut');
        $demande->mission_fin               = $request->input('mission_fin');

        $demande->emprunter_rapport_nombre  = $request->input('emprunter_rapport_nombre'); //Emprunter un rapport PFE                             
        $demande->emprunter_rapport_titles  = $request->input('emprunter_rapport_titles');
        $demande->emprunter_rapport_debut   = $request->input('emprunter_rapport_debut');
        $demande->emprunter_rapport_fin     = $request->input('emprunter_rapport_fin');
        
        $demande->stage_company             = $request->input('stage_company'); //Stage Professionnel  
        $demande->stage_info_company        = $request->input('stage_info_company');
        $demande->stage_encadreur_campany   = $request->input('stage_encadreur_campany');
        $demande->stage_sujet               = $request->input('stage_sujet');
        $demande->stage_description         = $request->input('stage_description');
        $demande->stage_debut               = $request->input('stage_debut');
        $demande->stage_fin                 = $request->input('stage_fin');
        $demande->stage_duree               = $request->input('stage_duree');
        $demande->stage_soutenance          = $request->input('stage_soutenance');

        $demande->nom_pfe                   = $request->input('nom_pfe'); //Proposition du Stage PFE
        $demande->problematique_pfe         = $request->input('problematique_pfe');
        $demande->bibliographie_pfe         = $request->input('bibliographie_pfe');
        $demande->desicion_pfe              = $request->input('desicion_pfe');
        $demande->datedebut_pfe             = $request->input('datedebut_pfe');
        $demande->datefin_pfe               = $request->input('datefin_pfe');
        $demande->duree_pfe                 = $request->input('duree_pfe');
        $demande->encadrant_pfe             = $request->input('encadrant_pfe');
        $demande->nom_societe_pfe           = $request->input('nom_societe_pfe');
        $demande->info_societe_pfe          = $request->input('info_societe_pfe');
        $demande->binome_pfe                = $request->input('binome_pfe');
        $demande->binome_id                 = $request->input('binome_id');
    
        $demande->statut                    = $request->input('statut');
        $demande->student_id                = $request->input('student_id');
        $demande->classe_id                 = $request->input('classe_id');

        $demande->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DemandeStudent  $demandeStudent
     * @return \Illuminate\Http\Response
     */
    public function show(DemandeStudent $demandeStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DemandeStudent  $demandeStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(DemandeStudent $demandeStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DemandeStudent  $demandeStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $demandeStudent = DemandeStudent::find($id);
        $demandeStudent->update($request->all());
        $idStudent      = $demandeStudent->student_id;
        $typeDemande    = $demandeStudent->sous_type;
        $idDemande      = $demandeStudent->id;

        //Get one signal id from id student
        $sqlNotif   = DB::select('select api_onesignal from students_onesignal where student_id = '.$idStudent);
        $sqlTitre   = DB::select('select label from notifmodels where id = 5');

        //Fill apiOneSignal by id student
        $resultIDonesignal = [];
        foreach ($sqlNotif as $key => $value) {
            if ($value->api_onesignal) {
                array_push($resultIDonesignal, $value->api_onesignal);
            }
        }

        //Message of notification
        $message = $typeDemande; 

        //Structure notification
        $fields['include_player_ids'] = $resultIDonesignal;
        $fields['contents']           = array("en" => $message);
        $fields['headings']           = array("en" => $sqlTitre[0]->label);

        //Send notification to app
        OneSignal::sendPush($fields);
        //Send notification to database
        $sendReqToDb = DB::insert('insert into notification_students (consulted, readed, notifmodel_id, idInfo, student_id) values (0, 0, 5, ?, ?)', [$idDemande, $idStudent]);
        return $sendReqToDb;
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DemandeStudent  $demandeStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DemandeStudent::destroy($id);
    }
}
