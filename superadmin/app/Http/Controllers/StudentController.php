<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentFormRequest;
use App\Models\Student;
use App\Models\Classe;
use App\Models\Departements;
use App\Models\Section;
use App\Models\Level;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\showNotification;

class StudentController extends Controller
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

        $response = Http::get($this->getUrlServer().'/students-classes');
        $students = json_decode($response);   
        return view('student.index', ['students' => $students]);

    }

    public function monProfil()
    {   
        return view('profile.show');  
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

        $lvls = DB::table("levels")->pluck("levelLabel", "id");

        return view('student.create', ['levels' => $levels, 'sections' => $sections, 'departements' => $departements
        , 'lvls' => $lvls]);
        //return view('student.create');
    }

    public function getClasse(Request $request)
    {
        $states = DB::table("classes")
            ->where("level_id", $request->level_id)
            ->pluck("classeName", "id");
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
        $response = Http::post($this->getUrlServer().'/students', [
        'matricule' => $request->input('matricule'),
        'nom'       => $request->input('nom'),
        'prenom'    => $request->input('prenom'),
        'nom_ar'    => $request->input('nom_ar'),
        'prenom_ar' => $request->input('prenom_ar'),
        'full_name' => $request->input('full_name'),
        'email'     => $request->input('email'),
        'password'  => $request->input('password'),
        'classe_id' => $request->input('classe_id'),
       ]);

        return redirect('/students')->with('message', 'Etudiant est ajouté avec succés');
        
        // try {
        //     $data = $request->validated();
        //     Student::create($data);
        //     return redirect('/students')->with('message', 'Student Added Successfully');
        // }
        // catch (\Exception $ex) {
        //     return redirect('/students')->with('message', 'Somthing Went Wrong'.$ex);
        // }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response1 = Http::get($this->getUrlServer().'/alldemandwithstudent/'.$id);
        $demandestudents = json_decode($response1);  

        $response2 = Http::get($this->getUrlServer().'/attendance-student/'.$id);
        $attendancestudents = json_decode($response2);  

        $response3 = Http::get($this->getUrlServer().'/student-profile/'.$id);
        $profiles = json_decode($response3);   

        $response4 = Http::get($this->getUrlServer().'/reclamations/'.$id);
        $reclamationstudent = json_decode($response4); 

        return view('student.show', ['profiles' => $profiles, 'demandestudents' => $demandestudents,
        'attendancestudents' => $attendancestudents, 'reclamationstudent' => $reclamationstudent]);
        //return view('student.show', compact('student'));
    }

    public function addprofilePage($id)
    {
        $response3 = Http::get($this->getUrlServer().'/student-profile/'.$id);
        $profiles = json_decode($response3);  

        return view('student.createProfile', ['profiles' => $profiles]);
    }

    public function addprofileStore(Request $request)
    {
        $image      = $request->profile_image;
        $myImage64  = $this->convertImage($image);
        $myExtImg64 = $this->getExtensionImage($image);

        $response = Http::post($this->getUrlServer().'/profiles', [
            'ddn'           => $request->input('ddn'),
            'genre'         => $request->input('genre'),
            'phone'         => $request->input('phone'),
            'gov'           => $request->input('gov'),
            'rue'           => $request->input('rue'),
            'codepostal'    => $request->input('codepostal'),
            'profile_image' => $myImage64,
            'extensionImg'  => $myExtImg64,
            'student_id'    => $request->input('student_id'),
        ]);

        return redirect('/students')->with('message', 'Profil étudiant est ajouté avec succés');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/student-profile/'.$id);
        $profiles = json_decode($response);  

        return view('student.edit', ['profiles' => $profiles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-student/'.$id, [
            'ddn'           => $request->input('ddn'),
            'genre'         => $request->input('genre'),
            'gov'           => $request->input('gov'),
            'rue'           => $request->input('rue'),
            'codepostal'    => $request->input('codepostal'),
            'profile_image' => $request->input('profile_image'),
            'student_id'    => $request->input('student_id'),
        ]);

        return redirect('/students')->with('message', 'Student Updated Successfully');
    }

    public function updateProfile(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-profilestudent/'.$id, [
            'ddn'           => $request->input('ddn'),
            'genre'         => $request->input('genre'),
            'gov'           => $request->input('gov'),
            'rue'           => $request->input('rue'),
            'codepostal'    => $request->input('codepostal'),
            'profile_image' => $request->input('profile_image'),
            'student_id'    => $request->input('student_id'),
        ]);
        
        return redirect()->back()->with('message', 'Profile étudiant est modifiée avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $student->delete();
        // return redirect()->back()->with('message', 'Student est supprimé avec succés');
        $response = Http::delete($this->getUrlServer().'/delete-student/'.$id);
        return redirect()->back()->with('message', 'Student est supprimée avec succés'); 
    }
}
