<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;
use Illuminate\Support\Facades\Http;
use Brian2694\Toastr\Facades\Toastr;

class ReclamationPersonnelController extends Controller
{
    use Services\MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/reclamationsPersonnel');
        $reclamations = json_decode($response);  
        return view('reclamationPersonnel.index', ['reclamations' => $reclamations]);
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
        //
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
        $response = Http::get($this->getUrlServer().'/getReclamWithPersonnel/'.$id);
        $reclamationspersonnels= json_decode($response);  
        return view('reclamationPersonnel.edit', ['reclamationspersonnels' => $reclamationspersonnels]);
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
        $response = Http::put($this->getUrlServer().'/update-reclamation-personnel/'.$id, [
            'statut' => $request->input('statut'),
            'reponse' => $request->input('reponse'),
        ]);
        //Toastr::success('We will contact you soon', 'Success');
        return redirect()->back()->with('message', 'La réclamation est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-reclamation-personnel/'.$id);
        return redirect()->back()->with('message', 'La réclamation est supprimée avec succés'); 
    }
}
