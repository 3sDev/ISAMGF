<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LienController extends Controller
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
        $response = Http::get($this->getUrlServer().'/liens');
        $liens = json_decode($response);   
        return view('liens.index', ['liens' => $liens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('liens.create');
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
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'url'           => $request->input('url'),
            'type'          => $request->input('type'),
            'categorie'     => $request->input('categorie'),
        ]);

        return redirect('/liens')->with('message', 'Lien utile est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lien  $liens
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/lien/'.$id);
        $liens = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/users/'.$id);
        $users = json_decode($response2); 

        return view('liens.show', ['liens' => $liens, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lien  $liens
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/lien/'.$id);
        $liens = json_decode($response);  

        return view('liens.edit', ['liens' => $liens]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lien  $liens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-lien/'.$id, [
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'url'           => $request->input('url'),
            'type'          => $request->input('type'),
            'categorie'     => $request->input('categorie'),
           ]);
        return redirect()->back()->with('message', 'Lien utile est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lien  $liens
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-lien/'.$id);
        return redirect()->back()->with('message', 'Lien utile est supprimé avec succés'); 
    }
}
