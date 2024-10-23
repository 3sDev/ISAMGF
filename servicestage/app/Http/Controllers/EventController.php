<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvide;


class EventController extends Controller
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
        $response = Http::get($this->getUrlServer().'/events');
        $events = json_decode($response);        
        return view('event.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
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

        $response = Http::post($this->getUrlServer().'/events', [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'date'          => $request->input('date'),
            'adresse'       => $request->input('adresse'),
            'image'         => $myImage64,
            'extensionImg'  => $myExtImg64,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect('/events')->with('message', 'Evénement est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/event/'.$id);
        $events = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/users/'.$id);
        $users = json_decode($response2); 

        return view('event.show', ['events' => $events, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/event/'.$id);
        $events = json_decode($response);  

        return view('event.edit', ['events' => $events]);
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
        $response = Http::put($this->getUrlServer().'/update-event/'.$id, [
            'titre'        => $request->input('titre'),
            'description'  => $request->input('description'),
            'date'         => $request->input('date'),
            'adresse'      => $request->input('adresse'),
        ]);
        return redirect()->back()->with('message', 'Evénement est modifié avec succés');
    }

    public function updateImageFront(Request $request, $id)
    {
        $image    = $request->image;
        $myImg    = $this->convertImage($image);
        $myExtImg = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-imageEvent/'.$id, [
            'image'        => $myImg,
            'extensionImg' => $myExtImg,
        ]);
        error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Image Event est modifiée avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-event/'.$id);
        return redirect()->back()->with('message', 'Evénement est supprimée avec succés'); 
    }
}
