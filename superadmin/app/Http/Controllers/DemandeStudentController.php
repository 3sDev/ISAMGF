<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DemandeStudentController extends Controller
{
    use Services\MyTrait;
    // private $urlServer = "http://smartschools.tn/university/public/api";
    // private $urlLocal  = "http://127.0.0.1:8080/api/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/demandefromstudent');
        //$response = Http::get($this->getUrlServer().'/demandeFromStudentByServiceScolarite');
        $demandestudents = json_decode($response);  
        return view('demandestudent.index', ['demandestudents' => $demandestudents]);

        //Version 1
        // foreach ($demandestudents as $student){
        //     echo '<strong>Prenom Etudiant: </strong>' . $student->prenom;
        //     echo '<br>';
        
        //     foreach ($student->demandes_students as $demand){
        //         echo '<strong>Année universitaire: </strong>' . $demand->years;
        //         echo '<br>';
        //     }
        // }

        //Version 2
        // foreach ($demandestudents as $demand){
        //     echo '<strong>Type Demande: </strong>' . $demand->type;
        //     echo '<br>';
        //     echo '<strong>Student info: </strong>' . $demand->student->matricule;
        //     echo '<br>';
        // }
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
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandestudents = json_decode($response);  
        //dd($demandestudents);
        return view('demandestudent.show', ['demandestudents' => $demandestudents]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefromstudent/'.$id);
        $demandestudents = json_decode($response);  
        return view('demandestudent.edit', ['demandestudents' => $demandestudents]);
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
        $response = Http::put($this->getUrlServer().'/update-demandestudent/'.$id, [
            'statut' => $request->input('statut'),
        ]);
        // 'type' => $request->input('type'),
        // 'years' => $request->input('years'),
        // 'semestre' => $request->input('semestre'),
        // 'statut' => $request->input('statut'),
        // 'student_id' => $request->input('student_id'),
        // 'user_id' => $request->input('user_id'),
        //dd($response->successful());
        return redirect('/edit-demandestudent/'.$id)->with('message', 'Demande étudiant est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-demandestudent/'.$id);
        return redirect()->back()->with('message', 'La demande est supprimée avec succés'); 
    }
}
