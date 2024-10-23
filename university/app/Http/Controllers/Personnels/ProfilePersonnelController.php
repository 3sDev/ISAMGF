<?php

namespace App\Http\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Personnel;
use App\Models\ProfilePersonnel;
use Illuminate\Http\Request;

class ProfilePersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Personnel::with('ProfilePersonnel')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllProfilePersonnels()
    {
        $response = ProfilePersonnel::with('personnel')->get();
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
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->profile_image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/personnels/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        $profile               = new ProfilePersonnel();
        $profile->ddn          = $request->input('ddn');
        $profile->genre        = $request->input('genre');
        $profile->phone        = $request->input('phone');
        $profile->gov          = $request->input('gov');
        $profile->rue          = $request->input('rue');
        $profile->codepostal   = $request->input('codepostal');
        $profile->personnel_id = $request->input('personnel_id');

        $profile->profile_image = $nameImage;

        $profile->save();
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
        //
    }
}
