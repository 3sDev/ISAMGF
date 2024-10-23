<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
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
        $response = Http::get($this->getUrlServer().'/admins');
        $admins = json_decode($response);   
        return view('admin.index', ['admins' => $admins]);
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
        
        return view('admin.create', ['departements' => $departements]);
    }
    
    public function getDepartement()
    {
        $response = Http::get($this->getUrlServer().'/departements');
        $departements = json_decode($response); 
        
        return $departements;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/admins', [
            'name'               => $request->input('name'),
            'role'               => $request->input('role'),
            'email'              => $request->input('email'),
            'profile_photo_path' => 'https://cdn-icons-png.flaticon.com/512/906/906343.png',
            'password'           => $request->input('password'),
            'lockout_time'       => $request->input('lockout_time'),
            'departement_id'     => $request->input('departement_id'),
        ]);

        return redirect('/admins')->with('message', 'Admin est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response2 = Http::get($this->getUrlServer().'/admin/'.$id);
        $admins = json_decode($response2); 

        return view('admin.show', ['admins' => $admins]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response     = Http::get($this->getUrlServer().'/admin/'.$id);
        $admins       = json_decode($response);  
        $response2    = Http::get($this->getUrlServer().'/departements');
        $departements = json_decode($response2); 
        
        return view('admin.edit', ['admins' => $admins, 'departements' => $departements]);
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
        $response = Http::put($this->getUrlServer().'/update-admin/'.$id, [
            'name'               => $request->input('name'),
            'role'               => $request->input('role'),
            'email'              => $request->input('email'),
            'lockout_time'       => $request->input('lockout_time'),
            'departement_id'     => $request->input('departement_id'),
        ]);
        error_log('update admin account --------------------------------------'.$response);
        return redirect()->back()->with('message', 'Admin est modifié avec succés');
    }

    public function updatePasswordAdmin(Request $request, $id)
    {
        $user = User::find($id);

        $newPassword      = $request->new_password;
        $confirmPassword  = $request->confirm_password;

        if ($newPassword  == $confirmPassword) {
            $user->password = Hash::make($newPassword);
            $user->update();
            error_log('Le mot de passe est modifié avec succés');
            return redirect()->back()->with('message', 'Le mot de passe est modifié avec succés');
        }
        else {
            error_log('Le mot de passe n\'est pas modifié!');
            return redirect()->back()->with('message', 'Le mot de passe n\'est pas modifié!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-admin/'.$id);
        return redirect()->back()->with('message', 'Compte admin est supprimé avec succés'); 
    }
}
