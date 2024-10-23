<?php

namespace App\Http\Controllers;

use App\Models\Lien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LienController extends Controller
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
        $response = Http::get($this->getUrlServer().'/liens');
        $liens = json_decode($response);   
        return view('lien.index', ['liens' => $liens]);

        // $response = Http::get('http://smartschools.tn/university/public/api/liens');
        // $jsonData = $response->json();
        // dd($jsonData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $response = Http::post($this->getUrlServer().'/liens', [
        'title' => $request->input('titleLabel'),
        'description' => $request->input('descriptionLabel'),
        'url' => $request->input('urlLabel'),
        'type' => $request->input('typeLabel'),
       ]);

       return redirect('/liens')->with('message', 'Lien est ajouté avec succés');
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
    public function edit($id)
    {
        //$lien = Lien::find($id);
        $response = Http::get($this->getUrlServer().'/lien/'.$id);
        $liens = json_decode($response);   
        return view('lien.edit', ['liens' => $liens]);
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
        $response = Http::put($this->getUrlServer().'/update-lien/'.$id, [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'type' => $request->input('type'),
        ]);
    
        //dd($response->successful());
        return redirect('/liens')->with('message', 'Lien est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {      
        $response = Http::delete($this->getUrlServer().'/delete-lien/'.$id);
        return redirect()->back()->with('message', 'Lien est supprimé avec succés'); 
    }
}
