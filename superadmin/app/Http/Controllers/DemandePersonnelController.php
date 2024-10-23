<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DemandePersonnelController extends Controller
{
    use Services\MyTrait;
    // private $urlServer = "http://smartschools.tn/university/public/api";
    // private $urlLocal  = "http://127.0.0.1:8080/api";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/demandefrompersonnel');
        $demandepersonnels = json_decode($response);  
        $demandepersonnels;
        return view('demandepersonnel.index', ['demandepersonnels' => $demandepersonnels]);
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
        $response = Http::get($this->getUrlServer().'/demandefrompersonnel/'.$id);
        $demandepersonnels = json_decode($response);  
        //dd($demandestudents);
        return view('demandepersonnel.show', ['demandepersonnels' => $demandepersonnels]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefrompersonnel/'.$id);
        $demandepersonnels = json_decode($response);  
        return view('demandepersonnel.edit', ['demandepersonnels' => $demandepersonnels]);
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
        $response = Http::put($this->getUrlServer().'/update-demandepersonnel/'.$id, [
            'statut' => $request->input('statut'),
        ]);
        return redirect('/edit-demandepersonnel/'.$id)->with('message', 'Demande personnel est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-demandepersonnel/'.$id);
        return redirect()->back()->with('message', 'La demande est supprimée avec succés'); 
    }
}
