<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Variable;

class VariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Variable::where("id", "=", "1")->get();
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
    public function update(Request $request)
    {
        $Variable = Variable::find(1);
        $Variable->directeur_ar  = $request->input('directeur_ar');
        $Variable->directeur_fr  = $request->input('directeur_fr');
        $Variable->secretaire_ar = $request->input('secretaire_ar');
        $Variable->secretaire_fr = $request->input('secretaire_fr');
        $Variable->adresse_ar    = $request->input('adresse_ar');
        $Variable->adresse_fr    = $request->input('adresse_fr');
        $Variable->update();
    }

    //Signature directeur
    public function updateSignatureDirecteur(Request $request)
    {
        $variable = Variable::find(1);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/variables/'.$variable->signature_directeur);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->signature_directeur); //decode base64 string
            $nameFile1 = time().".$extFile";
            $file      = "upload/variables/".$nameFile1;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile1 = $variable->signature_directeur; }
        $variable->signature_directeur = $nameFile1;
        $variable->update();   
    }

    //Signature secretaire general
    public function updateSignatureSecretaire(Request $request)
    {
        $variable = Variable::find(1);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/variables/'.$variable->signature_secretaire);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->signature_secretaire); //decode base64 string
            $nameFile2 = time().".$extFile";
            $file      = "upload/variables/".$nameFile2;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile2 = $variable->signature_secretaire; }
        $variable->signature_secretaire = $nameFile2;
        $variable->update();   
    }
    
    //Logo issat
    public function updateLogoVariable(Request $request)
    {
        $variable = Variable::find(1);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/variables/'.$variable->logo);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->logo); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/variables/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $variable->logo; }
        $variable->logo = $nameFile3;
        $variable->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Variable::destroy($id);
    }
}
