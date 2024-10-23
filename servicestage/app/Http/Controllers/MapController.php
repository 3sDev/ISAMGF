<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Map;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvide;


class MapController extends Controller
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
        $response = Http::get($this->getUrlServer().'/maps');
        $maps = json_decode($response);        
        return view('maps.index', ['maps' => $maps]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image      = $request->image;
        $myImage64  = $this->convertImage($image);
        $myExtImg64 = $this->getExtensionImage($image);

        $response = Http::post($this->getUrlServer().'/maps', [
            'titre'       => $request->input('titre'),
            'description' => $request->input('description'),
            'categorie'   => $request->input('categorie'),
            'lat'         => $request->input('lat'),
            'lng'         => $request->input('lng'),
            'image'       => $myImage64,
            'extensionImg'=> $myExtImg64,
        ]);
        //error_log('responseresponseresponse--------------------------------------------------------------------------'.$response);
        return redirect('/maps')->with('message', 'Map est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/maps/'.$id);
        $maps = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/users/'.$id);
        $users = json_decode($response2); 

        return view('maps.show', ['maps' => $maps, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/maps/'.$id);
        $maps = json_decode($response);  

        return view('maps.edit', ['maps' => $maps]);
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
        $response = Http::put($this->getUrlServer().'/update-maps/'.$id, [
            'titre'       => $request->input('titre'),
            'description' => $request->input('description'),
            'categorie'   => $request->input('categorie'),
            'lat'         => $request->input('lat'),
            'lng'         => $request->input('lng'),
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Location est modifiée avec succés');
    }

    public function updateImageMap(Request $request, $id)
    {
        $image    = $request->image;
        $myImg    = $this->convertImage($image);
        $myExtImg = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-imageMap/'.$id, [
            'image'        => $myImg,
            'extensionImg' => $myExtImg,
        ]);
        return redirect()->back()->with('message', 'Image Location est modifiée avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-maps/'.$id);
        return redirect()->back()->with('message', 'Map est supprimée avec succés'); 
    }
}
