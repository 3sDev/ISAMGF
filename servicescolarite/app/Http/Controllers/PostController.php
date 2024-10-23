<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('multiplecheckboxdemo',compact('posts'));
    }

    public function create()
    {
        return view('multiplecheckboxformdemo');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['category'] = $request->input('category');
        Post::create($input);
        return redirect()->route('posts.index');
    }
}
