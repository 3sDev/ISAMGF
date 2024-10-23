<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SpecialiteEnseignantController extends Controller
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
        $response    = Http::get($this->getUrlServer().'/specialites');
        $specialites = json_decode($response); 

        return view('teacherSpecialite.index', ['specialites' => $specialites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacherSpecialite.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/specialites', [
            'label' => $request->input('label'),
        ]);

        return redirect('specialiteTeachers')->with('message', 'Spécialité enseignant est ajoutée avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherSpecialite  $TeacherSpecialite
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherSpecialite  $TeacherSpecialite
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
     * @param  \App\Models\TeacherSpecialite  $TeacherSpecialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherSpecialite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-specialite/'.$id);
        return redirect()->back()->with('message', 'Spécialité enseignant est supprimée avec succés'); 
    }
}
