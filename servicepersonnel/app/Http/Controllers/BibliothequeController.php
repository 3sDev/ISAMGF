<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bibliotheque;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;


class BibliothequeController extends Controller
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
        $response = Http::get($this->getUrlServer().'/books');
        $bibliotheques = json_decode($response);  
        return view('bibliotheque.index', ['bibliotheques' => $bibliotheques]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bibliotheque.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->getUrlServer().'/books', [

            'titre'       => $request->input('titre'),
            'description' => $request->input('description'),
            'auteur'      => $request->input('auteur'),
            'langue'      => $request->input('langue'),
            'nbrPage'     => $request->input('nbrPage'),
            'category'    => $request->input('category'),
            'rating'      => $request->input('rating'),
            'views'       => $request->input('views'),
            'fichier'     => $request->input('fichier'),
            'image'       => $request->input('image')
        ]);
        return redirect('/bibliotheques')->with('message', 'Livre est ajouté avec succés');     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/book/'.$id);
        $bibliotheques = json_decode($response);  
        //dd($demandestudents);
        return view('bibliotheque.show', ['bibliotheques' => $bibliotheques]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bibliotheque = Bibliotheque::find($id);
        return view('bibliotheque.edit', compact('bibliotheque'));
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
        $response = Http::put($this->getUrlServer().'/update-book/'.$id, [
            'titre'       => $request->input('titre'),
            'description' => $request->input('description'),
            'auteur'      => $request->input('auteur'),
            'langue'      => $request->input('langue'),
            'nbrPage'     => $request->input('nbrPage'),
            'category'    => $request->input('category'),
            'rating'      => $request->input('rating'),
            'views'       => $request->input('views'),
            'fichier'     => $request->input('fichier'),
            'image'       => $request->input('image')
        ]);
        return redirect('/bibliotheques')->with('message', 'Le livre est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bibliotheque $bibliotheque)
    {
        $bibliotheque->delete();
        return redirect()->back()->with('message', 'Le livre est supprimé avec succés');
    }
}
