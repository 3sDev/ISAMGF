<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
//use App\Http\Controllers\showNotification;

class TeacherController extends Controller
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

        $response = Http::get($this->getUrlServer().'/teacher-profile');
        $teachers = json_decode($response);   
        return view('teacher.index', ['teachers' => $teachers]);

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
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/teachers', [
        'cin'       => $request->input('cin'),
        'nom'       => $request->input('nom'),
        'prenom'    => $request->input('prenom'),
        'nom_ar'    => $request->input('nom_ar'),
        'prenom_ar' => $request->input('prenom_ar'),
        'full_name' => $request->input('full_name'),
        'email'     => $request->input('email'),
        'password'  => $request->input('password'),
       ]);

        return redirect('/teachers')->with('message', 'Enseignant est ajouté avec succés');
        

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response1 = Http::get($this->getUrlServer().'/alldemandwithteacher/'.$id);
        $demandetachers = json_decode($response1);  

        $response2 = Http::get($this->getUrlServer().'/attendance-teacher/'.$id);
        $attendanceteachers = json_decode($response2);  

        $response3 = Http::get($this->getUrlServer().'/teacher-profile/'.$id);
        $profiles = json_decode($response3);   

        $response4 = Http::get($this->getUrlServer().'/reclamations/'.$id);
        $reclamationteacher = json_decode($response4); 

        return view('teacher.show', ['profiles' => $profiles, 'demandetachers' => $demandetachers,
        'attendanceteachers' => $attendanceteachers, 'reclamationteacher' => $reclamationteacher]);
    }

    public function addprofilePage($id)
    {
        $response3 = Http::get($this->getUrlServer().'/teacher-profile/'.$id);
        $profiles = json_decode($response3);  

        return view('teacher.createProfile', ['profiles' => $profiles]);
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
            'teacher_id'    => $request->input('teacher_id'),
        ]);

        return redirect('/teachers')->with('message', 'Profil enseignant est ajouté avec succés');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/teacher-profile/'.$id);
        $profiles = json_decode($response);  

        return view('teacher.edit', ['profiles' => $profiles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-teacher/'.$id, [
            'ddn'           => $request->input('ddn'),
            'genre'         => $request->input('genre'),
            'gov'           => $request->input('gov'),
            'rue'           => $request->input('rue'),
            'codepostal'    => $request->input('codepostal'),
            'profile_image' => $request->input('profile_image'),
        ]);

        return redirect('/teachers')->with('message', 'Profil enseignant est modifié avec succés!');
    }

    public function updateProfile(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-profileteacher/'.$id, [
            'ddn'           => $request->input('ddn'),
            'genre'         => $request->input('genre'),
            'gov'           => $request->input('gov'),
            'rue'           => $request->input('rue'),
            'codepostal'    => $request->input('codepostal'),
            'profile_image' => $request->input('profile_image'),
        ]);
        
        return redirect()->back()->with('message', 'Profil enseignant est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-teacher/'.$id);
        return redirect()->back()->with('message', 'Compte enseignant est supprimé avec succés'); 
    }
}
