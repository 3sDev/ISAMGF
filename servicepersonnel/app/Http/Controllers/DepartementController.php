<?php

namespace App\Http\Controllers;

use App\Models\Departements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DepartementController extends Controller
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
        $response = Http::get($this->getUrlServer().'/departements');
        $departements = json_decode($response);  
        return view('departement.index', ['departements' => $departements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $response = Http::post($this->getUrlServer().'/departements', [
            'departmentLabel'       => $request->input('departmentLabel'),
            'description' => $request->input('description')
        ]);
        return redirect('/departements')->with('message', 'Département est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Departements $departement)
    {
        //return view('departement.show', compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departement = Departements::find($id);
        return view('departement.edit', compact('departement'));
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
        $response = Http::put($this->getUrlServer().'/update-departement/'.$id, [
            'departmentLabel'       => $request->input('departmentLabel'),
            'description' => $request->input('description')
        ]);

        return redirect('/departements')->with('message', 'Département est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-departement/'.$id);
        return redirect()->back()->with('message', 'Département est supprimé avec succés');
    }
}
