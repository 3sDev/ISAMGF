<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Departements;
use App\Models\Section;
use App\Models\Level;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ClasseController extends Controller
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

        $departements = Departements::all();
        $classesDep = Departements::join('classes', 'classes.department_id', '=', 'departements.id')
        ->get(['departements.departmentLabel', 'classes.id', 'classes.classeName', 'classes.abbreviation']);

        $classesSec = Section::join('classes', 'classes.section_id', '=', 'sections.id')
        ->get(['sections.fullName']);

        $classesLev = Level::join('classes', 'classes.level_id', '=', 'levels.id')
        ->get(['levels.levelLabel']);


        return view('classe.index', ['classesDep' => $classesDep, 'classesSec' => $classesSec, 'classesLev' => $classesLev, 
                                    'departements' => $departements]);

    /*
        $departements = Departements::all();
        $data = Departements::join('classes', 'classes.department_id', '=', 'departements.id')
                            ->join('classes', 'classes.section_id', '=', 'sections.id')
                            ->join('classes', 'classes.level_id', '=', 'levels.id')
                            ->get(['departements.departmentLabel', 'sections.fullName', 'levels.levelLabel','classes.id', 
                            'classes.classeName', 'classes.abbreviation']);
        return view('classe.index', ['data' => $data, 'departements' => $departements]);
    */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = Departements::all();
        $sections = Section::all();
        $levels = Level::all();

        $departs = DB::table("departements")->pluck("departmentLabel", "id");

        return view('classe.create', ['levels' => $levels, 'sections' => $sections, 'departements' => $departements
        , 'departs' => $departs]);
    }

    public function getSection(Request $request)
    {
        $states = DB::table("sections")
            ->where("department_id", $request->department_id)
            ->pluck("fullName", "id");
        return response()->json($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classe = new Classe;
        $classe->classeName = $request->input('classeName');
        $classe->abbreviation = $request->input('abbreviation');
        $classe->department_id = $request->input('department_id');
        $classe->section_id = $request->input('section_id');
        $classe->level_id = $request->input('level_id');

        $classe->save();
        return redirect('/classes')->with('message', 'Classe est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        return view('classe.show', compact('classe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classe = Classe::all();
        $sections = Classe::join('sections', 'sections.department_id', '=', 'departements.id')
        ->get(['departements.departmentLabel', 'sections.id', 'sections.fullName', 'sections.abbreviation'])
        ->find($id);
        return view('section.edit', ['classe' => $classe, 'sections' => $sections]);
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
        $classe = Classe::find($id);
        $classe->classeName = $request->input('classeName');
        $classe->abbreviation = $request->input('abbreviation');
        $classe->department_id = $request->input('department_id');
        $classe->section_id = $request->input('section_id');
        $classe->level_id = $request->input('level_id');

        $classe->update();
        return redirect('/classes')->with('message', 'Classe est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-classe/'.$id);
        return redirect()->back()->with('message', 'Classe est supprimé avec succés');
    }
}
