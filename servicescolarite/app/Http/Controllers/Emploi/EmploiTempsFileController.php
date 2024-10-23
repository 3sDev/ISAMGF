<?php

namespace App\Http\Controllers\Emploi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\MyTrait;
use App\Http\Controllers\Services\ConvertBase64;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class EmploiTempsFileController extends Controller
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
        $response = Http::get($this->getUrlServer().'/getAllEmploiTempsStudent');
        $emploiStudent = json_decode($response); 
        return view('emploi_student.index', ['emploiStudent' => $emploiStudent]);
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
        $classes = DB::select('select * from classes v where not exists (select * from emploi_temps_files e where e.classe_id = v.id)');
        return view('emploi_student.create', ['classes' => $classes]);
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

        $response = Http::post($this->getUrlServer().'/emploi-student-file', [
            'annee_universitaire' => $request->input('annee_universitaire'),
            'semestre'            => $request->input('semestre'),
            'description'         => $request->input('description'),
            'classe_id'           => $request->input('classe_id'),
            'fichier'             => $myFile64,
            'extensionImg'        => $myExtFile64,
           ]);

        return redirect('/emploi')->with('message', 'Emploi de Groupe est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/getEmploiTempsStudentByIdEmploi/'.$id);
        $emplois = json_decode($response);   

        return view('emploi_student.show', ['emplois' => $emplois]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/classes');
        $classes = json_decode($response);
        
        $response2 = Http::get($this->getUrlServer().'/getEmploiTempsStudentByIdEmploi/'.$id);
        $emplois = json_decode($response2);  

        return view('emploi_student.edit', ['emplois' => $emplois, 'classes' => $classes]);
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
        $response = Http::put($this->getUrlServer().'/update-emploiTempsFile/'.$id, [
            'annee_universitaire' => $request->input('annee_universitaire'),
            'semestre'            => $request->input('semestre'),
            'description'         => $request->input('description'),
            'classe_id'           => $request->input('classe_id'),
        ]);
        error_log('UpdateInfoEmploi--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Infos emploi est modifié avec succés');
    }

    public function photoEmploi(Request $request, $id)
    {
        $image      = $request->fichier;
        $myImg      = $this->convertImage($image);
        $myExtImg   = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-emploiTempsPhotoStudent/'.$id, [
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
        $response = Http::delete($this->getUrlServer().'/delete-emploiTempsFile/'.$id);
        return redirect()->back()->with('message', 'Emploi Groupe est supprimé avec succés');
    }
}
