<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class AttendancePersonnelController extends Controller
{
    use Services\MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendancePersonnels');
        $attendances = json_decode($response2); 

        return view('attendancePersonnel.class', ['personnels' => $personnels, 'attendances' => $attendances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dateAbs = $request->attendance_date;
        //$seanceAbs = $request->seanceattendance;
        $thisDay = date('l', strtotime($dateAbs));
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

        $Jour           = $seanceAbs;
        $DateAttendance = $request->attendance_date;

        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendancePersonnelWithDayAndDate/'.$Jour.'/'.$DateAttendance );
        $attendancePersonnels = json_decode($response2);

        return view('attendancePersonnel.create', ['Jour' => $Jour, 'DateAttendance' => $DateAttendance, 
        'personnels' => $personnels, 'attendancePersonnels' => $attendancePersonnels]);
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
        $DateAttendance = $request->attendance_date;

        $ID_Personnel   = $request->personnel_id;
        $Presence     = $request->presence;
        
        foreach ($ID_Personnel as $key => $insert) {
            
            if ($Presence[$key] == 'Présent(e)' ||$Presence[$key] == 'Absent(e)' ||$Presence[$key] == 'Congé' ||
                $Presence[$key] == 'Maladie' ||$Presence[$key] == 'Autorisation') {
            $datasave = [
                'jour'              => $Jour,
                'attendance_date'   => $DateAttendance,
                'attendance_statut' => $Presence[$key],
                'personnel_id'      => $ID_Personnel[$key],
                'created_at'        => $now,
                'updated_at'        => $now,
            ];
            DB::table('attendance_personnels')->insert($datasave);
            }
        }

        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendancePersonnelWithDayAndDate/'.$Jour.'/'.$DateAttendance );
        $attendancePersonnels = json_decode($response2);

        return view('attendancePersonnel.create', ['Jour' => $Jour, 'DateAttendance' => $DateAttendance, 
        'personnels' => $personnels, 'attendancePersonnels' => $attendancePersonnels]);  
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
        $response = Http::get($this->getUrlServer().'/attendance-details-teacher/'.$id);
        $attendances = json_decode($response);

        return view('attendancePersonnel.edit', ['attendances' => $attendances]);
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
        $response = Http::put($this->getUrlServer().'/attendance-teacher/'.$id, [
            'attendance_date'    => $request->input('attendance_date'),
            'jour'               => $request->input('jour'),
            'heure_debut'        => $request->input('heure_debut'),
            'heure_fin'          => $request->input('heure_fin'),
            'justification'      => $request->input('justification'),
            'date_justification' => $request->input('date_justification'),
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Absence est modifiée avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-attendance-personnel/'.$id);
        
        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendancePersonnels');
        $attendances = json_decode($response2); 

        return view('attendancePersonnel.class', ['personnels' => $personnels, 'attendances' => $attendances]);
    }

    public function destroyPageCreate(Request $request, $id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-attendance-personnel/'.$id);
        
        $Jour           = $request->jour;
        $DateAttendance = $request->attendance_date;

        $response = Http::get($this->getUrlServer().'/personnels');
        $personnels = json_decode($response); 

        $response2 = Http::get($this->getUrlServer().'/attendancePersonnelWithDayAndDate/'.$Jour.'/'.$DateAttendance );
        $attendancePersonnels = json_decode($response2);

        return view('attendancePersonnel.create', ['Jour' => $Jour, 'DateAttendance' => $DateAttendance, 
        'personnels' => $personnels, 'attendancePersonnels' => $attendancePersonnels]); 
    }
}
