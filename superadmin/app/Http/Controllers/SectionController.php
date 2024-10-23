<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SectionController extends Controller
{
    use Services\MyTrait; //my url server
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/sections');
        $sections = json_decode($response);   
        return view('section.index', ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get($this->getUrlServer().'/departements');
        $departements = json_decode($response);  

        return view('section.create', ['departements' => $departements]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/section', [
            'fullName'      => $request->input('fullName'),
            'abbreviation'  => $request->input('abbreviation'),
            'department_id' => $request->input('department_id'),
           ]);

        return redirect('/sections')->with('message', 'section est ajoutée avec succés');
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
        $responses = Http::get($this->getUrlServer().'/departements');
        $departements = json_decode($responses); 

        $response = Http::get($this->getUrlServer().'/section/'.$id);
        $sections = json_decode($response);  
        return view('section.edit', ['sections' => $sections, 'departements' => $departements]); 
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
        $response = Http::put($this->getUrlServer().'/update-section/'.$id, [
            'fullName'      => $request->input('fullName'),
            'abbreviation'  => $request->input('abbreviation'),
            'department_id' => $request->input('department_id'),
        ]);
        return redirect('/sections')->with('message', 'Section est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-section/'.$id);
        return redirect()->back()->with('message', 'Section est supprimée avec succés');
    }
}
