<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Services\MyTrait;
use App\Http\Controllers\Services\ConvertBase64;

class ClubStudentController extends Controller
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
        $response = Http::get($this->getUrlServer().'/all-clubs-students');
        $clubStudents = json_decode($response);   
        return view('clubstudent.index', ['clubStudents' => $clubStudents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clubstudent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logo      = $request->logo;
        $myImage64  = $this->convertImage($logo);
        $myExtImg64 = $this->getExtensionImage($logo);

        $response = Http::post($this->getUrlServer().'/clubStudents', [
            'nom_ar'        => $request->input('nom_ar'),
            'nom_fr'        => $request->input('nom_fr'),
            'description'   => $request->input('description'),
            'statut'        => $request->input('statut'),
            'chef'          => $request->input('chef'),
            'membre_1'      => $request->input('membre_1'),
            'membre_2'      => $request->input('membre_2'),
            'membre_3'      => $request->input('membre_3'),
            'membre_4'      => $request->input('membre_4'),
            'membre_5'      => $request->input('membre_5'),
            'logo'          => $myImage64,
            'extensionFile' => $myExtImg64,
        ]);
        error_log('Create new club--------------------------------------------------------------------------'.$response);
        return redirect('/clubStudents')->with('message', 'L\'article est ajouté avec succés');
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
        $response = Http::get($this->getUrlServer().'/getClubById/'.$id);
        $clubs = json_decode($response);  

        return view('clubstudent.edit', ['clubs' => $clubs]);
    }

    public function list($id)
    {
        $response = Http::get($this->getUrlServer().'/getClubById/'.$id);
        $clubs = json_decode($response);
        
        $response2 = Http::get($this->getUrlServer().'/getStudentsByIdClub/'.$id);
        $students = json_decode($response2); 

        return view('clubstudent.list', ['clubs' => $clubs, 'students' => $students]);
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
        $response = Http::put($this->getUrlServer().'/update-clubStudent/'.$id, [
            'nom_ar'      => $request->input('nom_ar'),
            'nom_fr'      => $request->input('nom_fr'),
            'description' => $request->input('description'),
            'statut'      => $request->input('statut'),
            'chef'        => $request->input('chef'),
            'membre_1'    => $request->input('membre_1'),
            'membre_2'    => $request->input('membre_2'),
            'membre_3'    => $request->input('membre_3'),
            'membre_4'    => $request->input('membre_4'),
            'membre_5'    => $request->input('membre_5'),
        ]);
        error_log('UpdateClubStudent--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Club est modifié avec succés');
    }    

    public function updateLogo(Request $request, $id)
    {
        $logo    = $request->logo;
        $myImg    = $this->convertImage($logo);
        $myExtImg = $this->getExtensionImage($logo);

        $response = Http::put($this->getUrlServer().'/update-logoClub/'.$id, [
            'logo'          => $myImg,
            'extensionFile' => $myExtImg,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Logo est modifié avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-clubStudent/'.$id);
        return redirect()->back()->with('message', 'Le club est supprimé avec succés'); 
    }

    public function destroyAffectStudent($idAffect, $idDemande)
    {
        $response = Http::delete($this->getUrlServer().'/delete-affectStudent/'.$idAffect.'/'.$idDemande);
        error_log("--*-*-*-*-*-*-*--* =   ".$response);
        return redirect()->back()->with('message', 'L\'affectation d\'étudiant au club a été supprimée avec succés'); 
    }
}
