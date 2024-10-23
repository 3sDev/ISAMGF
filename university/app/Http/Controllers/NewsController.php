<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = News::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllNews()
    {
        $response = News::orderBy("created_at", "DESC")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getPaginationNews($skip, $take)
    {
        //$dateNow = now();
        $response = News::orderBy("created_at", "DESC")->skip($skip)->take($take)->get();
        $data = json_decode($response);
        return $data;
    }

    public function CountViewsNews($id) 
    {
        $news = News::find($id);
        $news->update(['views' => $news->views + 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('news.create');
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
        $dataImage = base64_decode($request->image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/news/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        $news = new News;
        $news->titre       = $request->input('titre');
        $news->description = $request->input('description');
        $news->date        = $request->input('date');
        $news->adresse     = $request->input('adresse');
        $news->rating      = '0';
        $news->views       = '0';
        $news->link        = $request->input('link');

        $news->image = $nameImage;
        $news->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $news = News::find($id);
        // return view('news.edit', compact('news'));
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
        $news = News::find($id);
        
        $news->titre       = $request->input('titre');
        $news->description = $request->input('description');
        $news->date        = $request->input('date');
        $news->adresse     = $request->input('adresse');
        $news->link        = $request->input('link');

        $news->update();
    }

    public function updateImageBackNews(Request $request, $id)
    {
        $news = News::find($id);
        
        if ($request->extensionImg != '') {
            File::delete('upload/news/'.$news->image);
            $extFile   = $request->extensionImg;
            $dataImage = base64_decode($request->image); //decode base64 string
            $nameFile  = time().".$extFile";
            $file      = "upload/news/".$nameFile;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile = $news->image; }
        $news->image = $nameFile;
        $news->update(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return News::destroy($id); 
    }
}
