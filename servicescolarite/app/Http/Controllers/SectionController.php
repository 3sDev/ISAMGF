<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Departements;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class SectionController extends Controller
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
        //$sections = Section::orderby('id', 'desc')->paginate(6);
        $departements = Departements::all();
        $sections = Departements::join('sections', 'sections.department_id', '=', 'departements.id')
        ->get(['departements.departmentLabel', 'sections.id', 'sections.fullName', 'sections.abbreviation']);

        return view('section.index', ['sections' => $sections, 'departements' => $departements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('section.create');
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

            'fullName'       => $request->input('fullName'),
            'abbreviation' => $request->input('abbreviation'),
            'department_id'         => $request->input('department_id')
        ]);

        return redirect('/sections')->with('message', 'Filière est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return view('section.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$sections = Section::find($id);
        $departements = Departements::all();
        $sections = Departements::join('sections', 'sections.department_id', '=', 'departements.id')
        ->get(['departements.departmentLabel', 'sections.id', 'sections.fullName', 'sections.abbreviation'])
        ->find($id);
        return view('section.edit', ['sections' => $sections, 'departements' => $departements]);
        //return view('section.edit', compact('section'));
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
            'fullName'       => $request->input('fullName'),
            'abbreviation' => $request->input('abbreviation'),
            'department_id'         => $request->input('department_id')
        ]);

        return redirect('/sections')->with('message', 'Filière est modifié avec succés');
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
        return redirect()->back()->with('message', 'Filière est supprimée avec succés'); 
    }
}
