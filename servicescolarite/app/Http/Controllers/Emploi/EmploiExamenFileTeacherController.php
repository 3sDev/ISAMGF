<?php

namespace App\Http\Controllers\Emploi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\MyTrait;
use App\Http\Controllers\Services\ConvertBase64;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class EmploiExamenFileTeacherController extends Controller
{
    use MyTrait;
    use ConvertBase64;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/getAllEmploiExamenTeacher');
        $emploiStudent = json_decode($response); 
        return view('emploi_examen_teacher.index', ['emploiStudent' => $emploiStudent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$response = Http::get($this->getUrlServer().'/classes');
        //$classes = json_decode($response);
        $teachers = DB::select('select * from teachers v where not exists (select * from emploi_examen_file_teachers e where e.teacher_id = v.id)');

        return view('emploi_examen_teacher.create', ['teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file        = $request->fichier;
        $myFile64    = $this->convertImage($file);
        $myExtFile64 = $this->getExtensionImage($file);

        $response = Http::post($this->getUrlServer().'/emploi-examen-teacher', [
            'annee_universitaire' => $request->input('annee_universitaire'),
            'semestre'            => $request->input('semestre'),
            'description'         => $request->input('description'),
            'type'                => $request->input('type'),
            'session'             => $request->input('session'),
            'teacher_id'          => $request->input('teacher_id'),
            'fichier'             => $myFile64,
            'extensionImg'        => $myExtFile64,
           ]);
        //return ('-------------------------------------------------------------'.$response);
        return redirect('/emploiSurveillances')->with('message', 'Emploi de surveillance est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/getEmploiExamenTeacherByIdEmploi/'.$id);
        $emplois = json_decode($response);   

        return view('emploi_examen_teacher.show', ['emplois' => $emplois]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response);
        
        $response2 = Http::get($this->getUrlServer().'/getEmploiExamenTeacherByIdEmploi/'.$id);
        $emplois = json_decode($response2);  

        return view('emploi_examen_teacher.edit', ['emplois' => $emplois, 'teachers' => $teachers]);
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
        $response = Http::put($this->getUrlServer().'/update-emploiExamenTeacher/'.$id, [
            'annee_universitaire' => $request->input('annee_universitaire'),
            'semestre'            => $request->input('semestre'),
            'description'         => $request->input('description'),
            'type'                => $request->input('type'),
            'session'             => $request->input('session'),
            'teacher_id'          => $request->input('teacher_id'),
        ]);
        error_log('UpdateInfoEmploi--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Infos emploi est modifié avec succés');
    }

    public function photoEmploiSurveillance(Request $request, $id)
    {
        $image      = $request->fichier;
        $myImg      = $this->convertImage($image);
        $myExtImg   = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-emploiSurveillancePhoto/'.$id, [
            'fichier'       => $myImg,
            'extensionImg'  => $myExtImg,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Image d\'emploi est modifiée avec succés'); 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-emploiExamenTeacher/'.$id);
        return redirect()->back()->with('message', 'Emploi de surveillance est supprimé avec succés');
    }
}
