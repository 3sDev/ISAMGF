<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\PostePersonnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostePersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = PostePersonnel::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostePersonnelsFonction()
    {
        $response = PostePersonnel::where("category", "=", "fonction")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostePersonnelsCategorie()
    {
        $response = PostePersonnel::where("category", "=", "categorie")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostePersonnelsGrade()
    {
        $response = PostePersonnel::where("category", "=", "grade")->get();
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
        $poste = new PostePersonnel;
        $poste->label_fr = $request->input('label_fr');
        $poste->label_ar = $request->input('label_ar');
        $poste->category = $request->input('category');
        $poste->save();
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
        $poste=PostePersonnel::find($id);
        $poste->label_fr = $request->input('label_fr');
        $poste->label_ar = $request->input('label_ar');
        $poste->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return PostePersonnel::destroy($id);
    }
}
