<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvide;


class BibliothequeController extends Controller
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
        $response = Http::get($this->getUrlServer().'/books');
        $books = json_decode($response);        
        return view('bibliotheque.index', ['books' => $books]);
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
        $image      = $request->image;
        $myImage64  = $this->convertImage($image);
        $myExtImg64 = $this->getExtensionImage($image);

        $file        = $request->fichier;
        $myFile64    = $this->convertImage($file);
        $myExtFile64 = $this->getExtensionImage($file);

        $response = Http::post($this->getUrlServer().'/books', [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'auteur'        => $request->input('auteur'),
            'langue'        => $request->input('langue'),
            'nbrPage'       => $request->input('nbrPage'),
            'category'      => $request->input('category'),
            'image'         => $myImage64,
            'extensionImg'  => $myExtImg64,
            'fichier'       => $myFile64,
            'extensionFile' => $myExtFile64,
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
        $books = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/users/'.$id);
        $users = json_decode($response2); 

        return view('bibliotheque.show', ['books' => $books, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/book/'.$id);
        $books = json_decode($response);  

        return view('bibliotheque.edit', ['books' => $books]);
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
        $response = Http::put($this->getUrlServer().'/update-bibliotheque/'.$id, [
            'titre'        => $request->input('titre'),
            'description'  => $request->input('description'),
            'langue'       => $request->input('langue'),
            'category'     => $request->input('category'),
            'auteur'       => $request->input('auteur'),
            'nbrPage'      => $request->input('nbrPage'),
        ]);
        return redirect()->back()->with('message', 'Livre est modifié avec succés');
    }

    public function updateCover(Request $request, $id)
    {
        $image      = $request->image;
        $myImg      = $this->convertImage($image);
        $myExtImg   = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-imageCover/'.$id, [
            'image'        => $myImg,
            'extensionImg' => $myExtImg,
        ]);
        error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Image de livre est modifiée avec succés'); 
    }

    public function updateBook(Request $request, $id)
    {
        $file      = $request->fichier;
        $myFile    = $this->convertImage($file);
        $myExtFile = $this->getExtensionImage($file);

        $response = Http::put($this->getUrlServer().'/update-fileBook/'.$id, [
            'fichier'       => $myFile,
            'extensionFile' => $myExtFile,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'fichier de livre est modifié avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-book/'.$id);
        return redirect()->back()->with('message', 'Livre est supprimée avec succés'); 
    }
}
