<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RattrapageController extends Controller
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
        $response = Http::get($this->getUrlServer().'/all-rattrapages-teachers');
        $rattrapages = json_decode($response);   
        return view('rattrapage.index', ['rattrapages' => $rattrapages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response); 

        $response = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response);

        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response);

        $response = Http::get($this->getUrlServer().'/sallesdep');
        $salles = json_decode($response);

        return view('rattrapage.create', ['teachers' => $teachers, 'matieres' => $matieres,
                                          'classes' => $classes, 'salles' => $salles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {   
        $response = Http::post($this->getUrlServer().'/rattrapages', [
            'date'       => $request->input('date'),
            'heure'      => $request->input('heure'),
            'duree'      => $request->input('duree'),
            'matiere_id' => $request->input('matiere_id'),
            'classe_id'  => $request->input('classe_id'),
            'salle_id'   => $request->input('salle_id'),
            'teacher_id' => $request->input('teacher_id'),
           ]);

        return redirect('/rattrapage')->with('message', 'Rattrapages est ajouté avec succés');
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
        $response = Http::get($this->getUrlServer().'/teachers');
        $teachers = json_decode($response); 

        $response = Http::get($this->getUrlServer().'/matieres');
        $matieres = json_decode($response);

        $response = Http::get($this->getUrlServer().'/all-classes');
        $classes = json_decode($response);

        $response = Http::get($this->getUrlServer().'/sallesdep');
        $salles = json_decode($response);

        return view('rattrapage.edit', ['teachers' => $teachers, 'matieres' => $matieres,
                                          'classes' => $classes, 'salles' => $salles]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-rattrapage/'.$id);
        return redirect()->back()->with('message', 'Rattrapage est supprimé avec succés');
    }
}
