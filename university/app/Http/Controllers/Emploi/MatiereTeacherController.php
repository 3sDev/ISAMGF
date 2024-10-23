<?php

namespace App\Http\Controllers\Emploi;

use App\Http\Controllers\Controller;
use App\Models\Matiere;
use App\Models\MatiereTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MatiereTeacherController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$response = Student::with('attendances')->where("id", "=", $id)->get();
        $response = Matiere::with('teachers')->get();
        $data = json_decode($response);
       	return $data;
    }

    public function getAllMatiersFromTeacherWithID($id)
    {
        //$response = Student::with('attendances')->where("id", "=", $id)->get();
        $response = Teacher::with('matieres', 'profileTeacher')->where("id", "=", $id)->get();
        $data = json_decode($response);
       	return $data;
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
        $matTeacher              = new MatiereTeacher;
        $matTeacher->description = $request->input('description');
        $matTeacher->matiere_id  = $request->input('matiere_id');
        $matTeacher->teacher_id  = $request->input('teacher_id');

        $matTeacher->save();
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
        //
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
        $matiereTeacher              = MatiereTeacher::find($id);
        $matiereTeacher->description = $request->input('description');
        $matiereTeacher->matiere_id  = $request->input('matiere_id');
        $matiereTeacher->teacher_id  = $request->input('teacher_id');

        $matiereTeacher->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return MatiereTeacher::destroy($id);
    }
}
