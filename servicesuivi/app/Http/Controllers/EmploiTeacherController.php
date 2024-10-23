<?php

namespace App\Http\Controllers;

use App\Models\EmploiTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class EmploiTeacherController extends Controller
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
        //
    }

    public function allSeancesFromIdTeacher($id)
    {   
        $response = Http::get($this->getUrlServer().'/emploi-teacher/'.$id);
        $teacherEmploi = json_decode($response);  
        return view('teacher.scheduledetails', ['teacherEmploi' => $teacherEmploi]);
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
        $response = Http::post($this->getUrlServer().'/seance-teacher', [
            'classe_id'   => $request->input('classe_id'),
            'matiere_id'  => $request->input('matiere_id'),
            'salle_id'    => $request->input('salle'),
            'teacher_id'  => $request->input('teacher_id'),
            'jour'        => $request->input('jour'),
            'heure_debut' => $request->input('heure_debut'),
            'heure_fin'   => $request->input('heure_fin'),
        ]);
    
        return redirect()->back();   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmploiTeacher  $emploiTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(EmploiTeacher $emploiTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmploiTeacher  $emploiTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(EmploiTeacher $emploiTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmploiTeacher  $emploiTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmploiTeacher $emploiTeacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmploiTeacher  $emploiTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-seance-teacher/'.$id);
        return redirect()->back(); 
    }
}
