<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
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
        $idAdmin  = Auth::user()->id;

        $response = Http::get($this->getUrlServer().'/all-agenda-users/'.$idAdmin);
        $agenda = json_decode($response);   
        return view('dashboard', ['agenda' => $agenda]);
    }

    public function countIndicator()
    {
        $idAdmin  = Auth::user()->id;
        $response = Http::get($this->getUrlServer().'/getAllNotesByIdAdmin/'.$idAdmin);
        $agenda = json_decode($response);    

        //Statistic Students
        $responseReq1 = Http::get($this->getUrlServer().'/getCountDemandesStageStudents/اجراء تربص مهني عامل/0');
        $req1=json_decode($responseReq1);
        $responsereq2 = Http::get($this->getUrlServer().'/getCountDemandesStageStudents/اجراء تربص مهني تقني/0');
        $req2=json_decode($responsereq2);
        $stageProDisable = $req1 + $req2;  
        
        $response2 = Http::get($this->getUrlServer().'/getCountDemandesStageStudents2/استعارة تقرير مشروع/0');
        $rapportDisable = json_decode($response2);  
        $response3 = Http::get($this->getUrlServer().'/getCountDemandesStageStudents/الانخراط في النوادي و الانشطة/0');
        $clubDisable = json_decode($response3); 
        $response4 = Http::get($this->getUrlServer().'/getCountDemandesStageStudents/القيام برحلة/0');
        $sortieDisable = json_decode($response4);
        $response5 = Http::get($this->getUrlServer().'/countAllStudents');
        $allStudents = json_decode($response5); 
        //Statistic Demandes Students
        $response6 = Http::get($this->getUrlServer().'/getCountDemandesStudentsByStatut/En cours');
        $studentDemandeStatut = json_decode($response6); 
        $response7 = Http::get($this->getUrlServer().'/countAllDemandesStudents');
        $studentAllDemandes = json_decode($response7);
        //Statistic Reclamations Students
        $response8 = Http::get($this->getUrlServer().'/getCountReclamationsStudentsByStatut/En cours');
        $studentReclamationStatut = json_decode($response8); 
        $response9 = Http::get($this->getUrlServer().'/countAllReclamationsStudents');
        $studentAllReclamations = json_decode($response9); 
        //Statistic Rattrapages Students
        $response10 = Http::get($this->getUrlServer().'/getCountRattrapagesTeachersByStatut');
        $rattrapageEncours = json_decode($response10); 
        $response11 = Http::get($this->getUrlServer().'/countAllRattrapagesTeachers');
        $allRattrapages = json_decode($response11); 
        //Statistic Pointages Today Teachers
        $response12 = Http::get($this->getUrlServer().'/getCountPointagesToday');
        $pointageTeachers = json_decode($response12);
        //Statistic Absences Today Teachers
        $response13 = Http::get($this->getUrlServer().'/getCountAttendancesTeachersToday');
        $attendanceTeachers = json_decode($response13);
        //Statistic Séance disponible  
        $response14 = Http::get($this->getUrlServer().'/getAllSeanceSalle');
        $allSeanceSalle = json_decode($response14);
        $response15 = Http::get($this->getUrlServer().'/getAllSeanceSalleDisponible');
        $allSeanceSalleDisponible = json_decode($response15);

        return view('dashboard', ['sortieDisable' => $sortieDisable, 'clubDisable' => $clubDisable, 
        'rapportDisable' => $rapportDisable, 'stageProDisable' => $stageProDisable, 'allStudents' => $allStudents, 
        'agenda' => $agenda, 'studentReclamationStatut' => $studentReclamationStatut, 'studentAllReclamations' => $studentAllReclamations, 
        'studentDemandeStatut' => $studentDemandeStatut, 'studentAllDemandes' => $studentAllDemandes,
        'rattrapageEncours' => $rattrapageEncours, 'allRattrapages' => $allRattrapages, 'attendanceTeachers' => $attendanceTeachers,
        'pointageTeachers' => $pointageTeachers, 'allSeanceSalle' => $allSeanceSalle, 'allSeanceSalleDisponible' => $allSeanceSalleDisponible]);
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
        //
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
