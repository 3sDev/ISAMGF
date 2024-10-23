<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class MatiereController extends Controller
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
        $response = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response);   
        return view('matiere.index', ['matieres' => $matieres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('matiere.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/matieres', [
            'subjectLabel'     => $request->input('subjectLabel'),
            'description'      => $request->input('description'),
            'volume'           => $request->input('volume'),
            'semestre'         => $request->input('semestre'),
            'nbr_eliminatoire' => $request->input('nbr_eliminatoire'),
        ]);
        return redirect('/matieres')->with('message', 'Matière est ajoutée avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Matiere $matiere)
    {
        //return view('matiere.show', compact('matiere'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/matiere/'.$id);
        $matieres = json_decode($response);  
        return view('matiere.edit', ['matieres' => $matieres]); 
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
        $response = Http::put($this->getUrlServer().'/update-matiere/'.$id, [
            'subjectLabel'     => $request->input('subjectLabel'),
            'description'      => $request->input('description'),
            'volume'           => $request->input('volume'),
            'semestre'         => $request->input('semestre'),
            'nbr_eliminatoire' => $request->input('nbr_eliminatoire'),
        ]);
        return redirect()->back()->with('message', 'Matière est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-matiere/'.$id);
        return redirect()->back()->with('message', 'Matière est supprimée avec succés');
    }
}
