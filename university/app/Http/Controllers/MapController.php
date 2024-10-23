<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvide;


class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $response = Map::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllLocations()
    {
        $response = Map::all();
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
        //return view('map.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $extFile   = $request->extensionImg;
        $dataImage = base64_decode($request->image); //decode base64 string
        $nameFile  = time().".$extFile";
        $file      = "upload/locations/".$nameFile;
        $moveImage = file_put_contents($file, $dataImage);

        $map = new Map;
        $map->titre       = $request->input('titre');
        $map->description = $request->input('description');
        $map->categorie   = $request->input('categorie');
        $map->lat         = $request->input('lat');
        $map->lng         = $request->input('lng');
        $map->rating      = '0';
        $map->views       = '0';
        $map->image       = $nameFile;

        $map->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        //return view('map.show', compact('map'));
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
        $map = Map::find($id);
        
        $map->titre       = $request->input('titre');
        $map->description = $request->input('description');
        $map->categorie   = $request->input('categorie');
        $map->lat         = $request->input('lat');
        $map->lng         = $request->input('lng');

        $map->update();
    }

    public function updateImageMap(Request $request, $id)
    {
        $map = Map::find($id);
        
        if ($request->extensionImg != '') {
            File::delete('upload/locations/'.$map->image);
            $extFile   = $request->extensionImg;
            $dataImage = base64_decode($request->image); //decode base64 string
            $nameFile  = time().".$extFile";
            $file      = "upload/locations/".$nameFile;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile = $map->image; }
        $map->image = $nameFile;
        $map->update(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Map::destroy($id); 
    }
}
