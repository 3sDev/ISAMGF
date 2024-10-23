<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Personnel;
use App\Models\ReclamationPersonnel;
use Illuminate\Http\Request;

class ReclamationPersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
         $response = Personnel::with('reclamationspersonnels')->where("id", "=", $id)->get();
         $data = json_decode($response);
         return $data;
    }

    public function getAllReclams()
    {
        $response = ReclamationPersonnel::with('personnel')->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getReclamWithPersonnel($id)
    {
        $response = ReclamationPersonnel::with('personnel')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getReclamWithPersonnelFilter($statut, $id)
    {
        $response = ReclamationPersonnel::with('personnel')->where("statut", "=", $statut)->where("personnel_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getCountReclamationInvalide()
    {
        $countReclamPersonnel= ReclamationPersonnel::where('statut','!=','Traitée')->count();
        $data = json_decode($countReclamPersonnel);
       	return $data;
    }

    public function getCountAllReclamations()
    {
        $countReclamationPersonnel = ReclamationPersonnel::count();
        $data = json_decode($countReclamationPersonnel);
       	return $data;
    }

    //count
    public function getCountReclamationsPersonnelsWithStatut($statut)
    {
        $response = ReclamationPersonnel::where("statut", "=", $statut)->count();
        $data = json_decode($response);
        return $data;
    }
    public function countAllReclamationsPersonnels()
    {
        $response = ReclamationPersonnel::count();
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
         //Service Convert Image
         $extImage  = $request->extensionImg;
         $dataImage = base64_decode($request->post_image); //decode base64 string
         $nameImage = time().".$extImage";
         $file      = "upload/reclamationsPersonnels/".$nameImage;
         $moveImage = file_put_contents($file, $dataImage);
 
        $reclamation = new ReclamationPersonnel;
        $reclamation->description = $request->input('description');
        $reclamation->post_image = $nameImage;
        $reclamation->statut = 'En cours';
        //$reclamation->statut = $request->input('statut');
        $reclamation->personnel_id = $request->input('personnel_id');
 
        $reclamation->save();
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
        $reclamationPersonnel=ReclamationPersonnel::find($id);
        $reclamationPersonnel->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ReclamationPersonnel::destroy($id);
    }
}
