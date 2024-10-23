<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvide;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  	public function index($id)
    {
        $response = Event::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllEvents()
    {
        $response = Event::all();
        $data = json_decode($response);
        return $data;
    }

    public function getTopEvents()
    {
        $dateNow = now();
        $response = Event::whereMonth('created_at', date('m'))->orderBy('views', 'DESC')->limit(5)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getLastNbrEvents($nbr)
    {
        $response = Event::orderBy("created_at", "DESC")->limit($nbr)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getPaginationEvents($skip, $take)
    {
        //$dateNow = now();
        $response = Event::orderBy("created_at", "DESC")->skip($skip)->take($take)->get();
        $data = json_decode($response);
        return $data;
    }

    public function CountViewsEvent($id) 
    {
        $event = Event::find($id);
        $event->update(['views' => $event->views + 1]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Service Convert Image
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/events/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        $event = new Event;
        $event->titre = $request->input('titre');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->adresse = '0';
        $event->rating = '0';
        $event->views = $request->input('views');

        $event->image = $nameImage;

        $event->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //return view('event.show', compact('event'));
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
        $event = Event::find($id);
        
        $event->titre       = $request->input('titre');
        $event->description = $request->input('description');
        $event->date        = $request->input('date');
        $event->adresse     = $request->input('adresse');

        $event->update();
    }

    public function updateImageBack(Request $request, $id)
    {
        $event = Event::find($id);
        
        if ($request->extensionImg != '') {
            File::delete('upload/events/'.$event->image);
            $extFile   = $request->extensionImg;
            $dataImage = base64_decode($request->image); //decode base64 string
            $nameFile  = time().".$extFile";
            $file      = "upload/events/".$nameFile;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile = $event->image; }
        $event->image = $nameFile;
        $event->update(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Event::destroy($id); 
    }
}
