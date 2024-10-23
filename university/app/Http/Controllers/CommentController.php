<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $response = Post::with('comments')->get();
        // $data = json_decode($response);
        // return $data;

        // $users = User::all();
        // foreach ($users as $user)
        // {
        //     echo $user->comments;
        // }

        // $all_posts = Post::all();
        // $all_user = User::all();
        // foreach ($all_posts as $post)
        // {
        //     echo $post->user->name ."<br>";
        //     echo $post->title."(". $post->description .")" ."<br>";
        //     echo $post->comments->texte ."<br>";
        // }

        // $posts = Post::all();
        // foreach ($posts as $post)
        // {
        //     echo $post->user->name ."<br>";
        //     echo "Nom article: ".$post->title ."<br>";
        //     foreach ($post->comments as $comment)
        //     {
        //         echo "Commentaire article: ".$comment->texte ."<br>";  
        //     }
        // }

        $posts = Post::all();
        foreach ($posts as $post)
        {
            $post->user->name;
            $post->title;
            foreach ($post->comments as $comment)
            {
                $comment->texte;  
            }
        }
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
