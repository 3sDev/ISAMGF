<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PointageController extends Controller
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
        $departementAdmin  = Auth::user()->departement_id;
        if (Auth::user()->departement_id == '1') {
            $response = Http::get($this->getUrlServer().'/teachers');
            $teachers = json_decode($response); 
        } else {
            $response = Http::get($this->getUrlServer().'/teachersWithDepartement/'.$departementAdmin);
            $teachers = json_decode($response); 
        }

        $response2 = Http::get($this->getUrlServer().'/all-pointages');
        $pointages = json_decode($response2); 
        $response3 = Http::get($this->getUrlServer().'/all-pointages-s2');
        $pointageS2 = json_decode($response3); 

        return view('pointage.class', ['teachers' => $teachers, 'pointages' => $pointages, 'pointageS2' => $pointageS2]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $datePointage = $request->pointage_date;
        $mySemestre   = $request->pointage_date;

        $semestreTest = date('m-d', strtotime($mySemestre));
        $Semestre_1_DateBegin = date('m-d', strtotime('09/01'));
        $Semestre_1_DateEnd   = date('m-d', strtotime('12/31'));
        if ($semestreTest >= $Semestre_1_DateBegin && $semestreTest <= $Semestre_1_DateEnd){
            $semestre = "1";
        }
        else {
            $semestre = "2";
        }

        $thisDay = date('l', strtotime($datePointage));
        if ($thisDay == 'Monday') {
            $seanceAbs = 'Lundi';
        }
        elseif ($thisDay == 'Tuesday') {
            $seanceAbs = 'Mardi';
        }
        elseif ($thisDay == 'Wednesday') {
            $seanceAbs = 'Mercredi';
        }
        elseif ($thisDay == 'Thursday') {
            $seanceAbs = 'Jeudi';
        }
        elseif ($thisDay == 'Friday') {
            $seanceAbs = 'Vendredi';
        }
        elseif ($thisDay == 'Saturday') {
            $seanceAbs = 'Samedi';
        }
        else {
            $seanceAbs = 'Dimanche';
        }

        //$DateAttendance = $request->attendance_date;

        $IdTeacher  = $request->teacher_id;
        $Jour = $seanceAbs;
        $DateNow = Carbon::now()->format('Y-m-d');

        $response = Http::get($this->getUrlServer().'/teacher-profile/'.$IdTeacher);
        $teacherResult = json_decode($response);

        $response2 = Http::get($this->getUrlServer().'/emploi-teacher-day-semestre/'.$IdTeacher.'/'.$Jour.'/'.$semestre);
        $emploiTeacher = json_decode($response2);

        $response3 = Http::get($this->getUrlServer().'/HistoriquePointageByDayAndDate/'.$IdTeacher.'/'.$Jour.'/'.$datePointage );
        $pointageTeacher = json_decode($response3);

        return view('pointage.create', ['IdTeacher' => $IdTeacher, 'Jour' => $Jour, 'datePointage' => $datePointage, 'semestre' => $semestre,
        'teacherResult' => $teacherResult, 'emploiTeacher' => $emploiTeacher, 'pointageTeacher' => $pointageTeacher]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now();
        $Jour = $request->jour;
        
        $ID_Seance     = $request->seance_id;
        $ID_Teacher    = $request->teacher_id;
        $Date_Pointage = $request->date_pointage;
        $semestre      = $request->semestre;
        $Nom_Matiere   = $request->nom_matiere;
        $Type_Matiere  = $request->type_matiere;
        $Heure_Debut   = $request->heure_debut;
        $Heure_Fin     = $request->heure_fin;
        $Salle         = $request->salle;
        $Presence      = $request->presence;
        
        foreach ($ID_Seance as $key => $insert) {
            
            if ($Presence[$key] == 'P') {
                $datasave = [
                    'nom_matiere'   => $Nom_Matiere[$key],
                    'type_matiere'  => $Type_Matiere[$key],
                    'date_pointage' => $Date_Pointage,
                    'jour'          => $Jour,
                    'salle'         => $Salle[$key],
                    'heure_debut'   => $Heure_Debut[$key],
                    'heure_fin'     => $Heure_Fin[$key],
                    'teacher_id'    => $ID_Teacher,
                    'seance_id'     => $ID_Seance[$key],
                    'semestre'      => $semestre,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];
                DB::table('pointages')->insert($datasave);
            }
        }

        $DateNow = Carbon::now()->format('Y-m-d');

        $response = Http::get($this->getUrlServer().'/teacher-profile/'.$ID_Teacher);
        $teacherResult = json_decode($response);

        $response2 = Http::get($this->getUrlServer().'/emploi-teacher-day-semestre/'.$ID_Teacher.'/'.$Jour.'/'.$semestre);
        $emploiTeacher = json_decode($response2);

        $response3 = Http::get($this->getUrlServer().'/HistoriquePointageByDayAndDate/'.$ID_Teacher.'/'.$Jour.'/'.$Date_Pointage );
        $pointageTeacher = json_decode($response3);

        return view('pointage.create', ['IdTeacher' => $ID_Teacher, 'Jour' => $Jour, 'datePointage' => $Date_Pointage, 'semestre' => $semestre,
        'teacherResult' => $teacherResult, 'emploiTeacher' => $emploiTeacher, 'pointageTeacher' => $pointageTeacher]);
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
        $response  = Http::get($this->getUrlServer().'/pointageById/'.$id);
        $pointages = json_decode($response);
        $response1 = Http::get($this->getUrlServer().'/sallesdep');
        $salles = json_decode($response1);
        
        return view('pointage.edit', ['pointages' => $pointages, 'salles' => $salles]);
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
        $response = Http::put($this->getUrlServer().'/update-pointage/'.$id, [
            'lat'           => $request->input('lat'),
            'lng'           => $request->input('lng'),
            'nom_matiere'   => $request->input('nom_matiere'),
            'type_matiere'  => $request->input('type_matiere'),
            'jour'          => $request->input('jour'),
            'salle'         => $request->input('salle'),
            'heure_debut'   => $request->input('heure_debut'),
            'heure_fin'     => $request->input('heure_fin'),
            'teacher_id'    => $request->input('teacher_id'),
            'seance_id'     => $request->input('seance_id'),
            'semestre'      => $request->input('semestre'),
            'date_pointage' => $request->input('date_pointage'),
        ]);
        error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Pointage est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-pointage/'.$id);

        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response); 
        $response2 = Http::get($this->getUrlServer().'/all-pointages');
        $pointages = json_decode($response2);
        $response3 = Http::get($this->getUrlServer().'/all-pointages-s2');
        $pointageS2 = json_decode($response3); 
        return view('pointage.class', ['teachers' => $teachers, 'pointages' => $pointages, 'pointageS2' => $pointageS2]);
    }

    public function destroyPageCreate(Request $request, $id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-pointage/'.$id);
        
        $IdTeacher    = $request->teacher_id;
        $Jour         = $request->jour;
        $datePointage = $request->pointage_date;
        
        $mySemestre   = $request->pointage_date;

        $semestreTest = date('m-d', strtotime($mySemestre));
        $Semestre_1_DateBegin = date('m-d', strtotime('09/01'));
        $Semestre_1_DateEnd   = date('m-d', strtotime('12/31'));
        if ($semestreTest >= $Semestre_1_DateBegin && $semestreTest <= $Semestre_1_DateEnd){
            $semestre = "1";
        }
        else {
            $semestre = "2";
        }

        $response = Http::get($this->getUrlServer().'/teacher-profile/'.$IdTeacher);
        $teacherResult = json_decode($response);

        $response2 = Http::get($this->getUrlServer().'/emploi-teacher-day-semestre/'.$IdTeacher.'/'.$Jour.'/'.$semestre);
        $emploiTeacher = json_decode($response2);

        $response3 = Http::get($this->getUrlServer().'/HistoriquePointageByDayAndDate/'.$IdTeacher.'/'.$Jour.'/'.$datePointage );
        $pointageTeacher = json_decode($response3);

        return view('pointage.create', ['IdTeacher' => $IdTeacher, 'Jour' => $Jour, 'datePointage' => $datePointage, 'semestre' => $semestre, 
        'teacherResult' => $teacherResult, 'emploiTeacher' => $emploiTeacher, 'pointageTeacher' => $pointageTeacher]);

        // $response = Http::get($this->getUrlServer().'/teachers');
        // $teachers = json_decode($response); 
        // $response2 = Http::get($this->getUrlServer().'/all-pointages');
        // $pointages = json_decode($response2); 
        // return view('pointage.class', ['teachers' => $teachers, 'pointages' => $pointages]);
    }
}
