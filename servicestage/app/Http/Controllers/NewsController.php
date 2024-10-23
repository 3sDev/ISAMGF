<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
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
        $response = Http::get($this->getUrlServer().'/all-news');
        $news = json_decode($response);        
        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
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

        $response = Http::post($this->getUrlServer().'/news', [
            'titre'         => $request->input('titre'),
            'description'   => $request->input('description'),
            'date'          => $request->input('date'),
            'adresse'       => $request->input('adresse'),
            'rating'        => $request->input('rating'),
            'views'         => $request->input('views'),
            'link'          => $request->input('link'),
            'image'         => $myImage64,
            'extensionImg'  => $myExtImg64,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect('/news')->with('message', 'L\'article est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get($this->getUrlServer().'/news/'.$id);
        $news = json_decode($response);  

        $response2 = Http::get($this->getUrlServer().'/users/'.$id);
        $users = json_decode($response2); 

        return view('news.show', ['news' => $news, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get($this->getUrlServer().'/news/'.$id);
        $news = json_decode($response);  

        return view('news.edit', ['news' => $news]);
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
        $response = Http::put($this->getUrlServer().'/update-news/'.$id, [
            'titre'        => $request->input('titre'),
            'description'  => $request->input('description'),
            'date'         => $request->input('date'),
            'link'         => $request->input('link'),
            'adresse'      => $request->input('adresse'),
        ]);
        error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Actualité est modifiée avec succés');
    }

    public function updateImageFrontNews(Request $request, $id)
    {
        $image    = $request->image;
        $myImg    = $this->convertImage($image);
        $myExtImg = $this->getExtensionImage($image);

        $response = Http::put($this->getUrlServer().'/update-imageNews/'.$id, [
            'image'        => $myImg,
            'extensionImg' => $myExtImg,
        ]);
        //error_log('UpdateImage--------------------------------------------------------------------------'.$response);
        return redirect()->back()->with('message', 'Image Actualité est modifiée avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete($this->getUrlServer().'/delete-news/'.$id);
        return redirect()->back()->with('message', 'Actualité est supprimée avec succés'); 
    }
}
