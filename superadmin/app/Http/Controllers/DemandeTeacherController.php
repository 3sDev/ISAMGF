<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DemandeTeacherController extends Controller
{
    use Services\MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/demandefromteacher');
        $demandeteachers = json_decode($response);  
        return view('demandeteacher.index', ['demandeteachers' => $demandeteachers]);
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
        $response = Http::get($this->getUrlServer().'/demandefromteacher/'.$id);
        $demandeteachers = json_decode($response);  
        //dd($demandestudents);
        return view('demandeteacher.show', ['demandeteachers' => $demandeteachers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/demandefromteacher/'.$id);
        $demandeteachers = json_decode($response);  
        return view('demandeteacher.edit', ['demandeteachers' => $demandeteachers]);
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
        $response = Http::put($this->getUrlServer().'/update-demandeteacher/'.$id, [
            'statut' => $request->input('statut'),
        ]);
        // 'type' => $request->input('type'),
        // 'years' => $request->input('years'),
        // 'semestre' => $request->input('semestre'),
        // 'statut' => $request->input('statut'),
        // 'student_id' => $request->input('student_id'),
        // 'user_id' => $request->input('user_id'),
        //dd($response->successful());
        return redirect('/edit-demandeteacher/'.$id)->with('message', 'Demande enseignant a été modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-demandeteacher/'.$id);
        return redirect()->back()->with('message', 'La demande est supprimée avec succés'); 
    }
}
