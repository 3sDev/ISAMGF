<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LevelController extends Controller
{
    use Services\MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/levels');
        $levels = json_decode($response);   
        return view('level.index', ['levels' => $levels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get($this->getUrlServer().'/levels');
        $levels = json_decode($response);  

        return view('level.create', ['levels' => $levels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/levels', [
            'levelLabel'  => $request->input('levelLabel'),
            'description' => $request->input('description'),
           ]);

        return redirect('/levels')->with('message', 'Level (Niveau) est ajoutée avec succés');
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
        $response = Http::get($this->getUrlServer().'/level/'.$id);
        $levels = json_decode($response);  
        return view('level.edit', ['levels' => $levels]); 
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
        $response = Http::put($this->getUrlServer().'/update-level/'.$id, [
            'levelLabel'  => $request->input('levelLabel'),
            'description' => $request->input('description'),
        ]);
        return redirect('/levels')->with('message', 'Level (Niveau) est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-level/'.$id);
        return redirect()->back()->with('message', 'Level (Niveau) est supprimée avec succés');
    }
}
