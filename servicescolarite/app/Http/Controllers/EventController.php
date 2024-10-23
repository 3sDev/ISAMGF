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
    // private $urlServer = "http://smartschools.tn/university/public/api";
    // private $urlLocal  = "http://127.0.0.1:8080/api";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $response = Http::get($this->getUrlServer().'/events');
        $events = json_decode($response);        
        // $events = $response['data'];
        //return $events;
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
        $response = Http::post($this->getUrlServer().'/events', [
            'titre' => $request->input('titreLabel'),
            'description' => $request->input('descriptionLabel'),
            'date' => $request->input('dateLabel'),
            'adresse' => $request->input('adresseLabel'),
            'rating' => $request->input('ratingLabel'),
            'views' => $request->input('viewsLabel'),
            'adresse' => $request->input('typeLabel'),
           ]);
    
           return redirect('/events')->with('message', 'Evénement est ajouté avec succés');
        
        $event = new Event;
        $event->titre = $request->input('titre');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->adresse = $request->input('titre');
        $event->rating = $request->input('titre');
        $event->views = $request->input('titre');
        
        if($request->hasfile('image'))
        {

        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('upload/events/', $filename);
        $event->image = $filename;
        }

        $event->save();
        return redirect('/events')->with('message', 'Evénement est ajouté avec succés');
        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('event.edit', compact('event'));
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
        $event->titre = $request->input('titre');
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->adresse = $request->input('adresse');
        $event->rating = $request->input('rating');
        $event->views = $request->input('views');
        
        if($request->hasfile('image'))
        {

        $destination = 'upload/events/'.$event->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('upload/events/', $filename);
        $event->image = $filename;
        }

        $event->update();
        return redirect('/events')->with('message', 'Evénement est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->with('message', 'Evénement est supprimé avec succés');
    }
}
