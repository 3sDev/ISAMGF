<?php

namespace App\Http\Controllers;

use App\Models\Lien;
use Illuminate\Http\Request;

class LienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Lien::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllLien()
    {
        $response = Lien::all();
        $data = json_decode($response);
        return $data;
    }

    public function getAllLinksByCategory($category)
    {
        $response = Lien::where("categorie", "=", $category)->get();
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
        $link = new Lien;
        $link->title       = $request->input('title');
        $link->description = $request->input('description');
        $link->url         = $request->input('url');
        $link->type        = $request->input('type');
        $link->categorie   = $request->input('categorie');

        $link->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function show(Lien $lien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function edit(Lien $lien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      	$lien=Lien::find($id);
        $lien->update($request->all());
      
      	/*$lien = Lien::find($id);
        $lien->title = $request->input('title');
        $lien->description = $request->input('description');
        $lien->url = $request->input('url');
        $lien->type = $request->input('type');
        $lien->update();*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      	return Lien::destroy($id);  
      	//$lien->delete($id);
        //return redirect()->back()->with('message', 'Lien est supprimé avec succés');
    }
}
