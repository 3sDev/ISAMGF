<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bibliotheque;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvide;


class BibliothequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Bibliotheque::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllBooks()
    {
        $response = Bibliotheque::all();
        $data = json_decode($response);
        return $data;
    }

    public function bookWithCategorie($cat)
    {
        $response = Bibliotheque::where("category", "=", $cat)->get();
        $data = json_decode($response);
        return $data;
    }

    public function addViews($id){
        {
            $lastView = Bibliotheque::where('id', $id)->pluck('views')->all();
            return  $lastView;
            $newView  = $lastView++;

            $bibliotheque = Bibliotheque::find($id);
            $bibliotheque->views = $newView;
    
            $bibliotheque->update();
        }
    }

    public function CountViewsPosts($id) 
    {
        $book = Bibliotheque::find($id);
        $book->update(['views' => $book->views + 1]);
    }

    //count
    public function getCountBooksLibrary()
    {
        $response = Bibliotheque::count();
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
         //Service Convert Image
         $extImage  = $request->extensionImg;
         $dataImage = base64_decode($request->image); //decode base64 string
         $nameImage = time().".$extImage";
         $file      = "upload/library/cover/".$nameImage;
         $moveImage = file_put_contents($file, $dataImage);
 
         //Service Convert PDF
         $extFile  = $request->extensionFile;
         $dataFile = base64_decode($request->fichier); //decode base64 string
         $nameFile = time().".$extFile";
         $file     = "upload/library/book/".$nameFile;
         $moveFile = file_put_contents($file, $dataFile);
 
         $book = new Bibliotheque;
         $book->titre       = $request->input('titre');
         $book->description = $request->input('description');
         $book->auteur      = $request->input('auteur');
         $book->langue      = $request->input('langue');
         $book->nbrPage     = $request->input('nbrPage');
         $book->category    = $request->input('category');
         $book->rating      = '0';
         $book->views       = '0';
 
         $book->image       = $nameImage;
         $book->fichier     = $nameFile;
 
         $book->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bibliotheque $bibliotheque)
    {
        //return view('bibliotheque.show', compact('bibliotheque'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('bibliotheque.edit', compact('bibliotheque'));
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
        $book = Bibliotheque::find($id);
        $book->titre       = $request->input('titre');
        $book->description = $request->input('description');
        $book->auteur      = $request->input('auteur');
        $book->langue      = $request->input('langue');
        $book->nbrPage     = $request->input('nbrPage');
        $book->category    = $request->input('category');

        $book->update();
    }

    public function updateImageCover(Request $request, $id)
    {
        $bibliotheque = Bibliotheque::find($id);
        //Service Convert File
        if ($request->extensionImg != '') {
            File::delete('upload/library/cover/'.$bibliotheque->image);
            $extFile   = $request->extensionImg;
            $dataImage = base64_decode($request->image); //decode base64 string
            $nameFile4 = time().".$extFile";
            $file      = "upload/library/cover/".$nameFile4;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile4 = $bibliotheque->image; }
        $bibliotheque->image = $nameFile4;
        $bibliotheque->update();   
    }

    public function updateFileBook(Request $request, $id)
    {
        $bibliotheque = Bibliotheque::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/library/book/'.$bibliotheque->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/library/book/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $bibliotheque->fichier; }
        $bibliotheque->fichier = $nameFile3; 
        $bibliotheque->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Bibliotheque::destroy($id);
    }
}