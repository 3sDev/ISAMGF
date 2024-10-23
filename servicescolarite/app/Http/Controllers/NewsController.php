<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
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
               // $events = DB::table('events')->orderBy('date', 'desc')->get()->paginate(1);
               $news = News::orderby('id', 'desc')->paginate(6);
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
        $new = new News;
        $new->titre = $request->input('titre');
        $new->description = $request->input('description');
        $new->date = $request->input('date');
        $new->adresse = $request->input('adresse');
        $new->rating = $request->input('rating');
        $new->views = $request->input('views');
        $new->link = $request->input('link');
        
        if($request->hasfile('image'))
        {

        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('upload/news/', $filename);
        $new->image = $filename;
        }

        $new->save();
        return redirect('/news')->with('message', 'L`article est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('news.edit', compact('news'));
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
        $new = News::find($id);
        $new->titre = $request->input('titre');
        $new->description = $request->input('description');
        $new->date = $request->input('date');
        $new->adresse = $request->input('adresse');
        $new->rating = $request->input('rating');
        $new->views = $request->input('views');
        $new->link = $request->input('link');
        
        if($request->hasfile('image'))
        {

        $destination = 'upload/news/'.$new->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $file = $request->file('image');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'.$extention;
        $file->move('upload/news/', $filename);
        $new->image = $filename;
        }

        $new->update();
        return redirect('/news')->with('message', 'Article est modifié avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->back()->with('message', 'Article est supprimé avec succés');
    }
}
