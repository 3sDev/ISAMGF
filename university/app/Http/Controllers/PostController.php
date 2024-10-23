<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Student;
use App\Models\ProfileStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //$response = User::with('posts')->where('name', '=', 'kamel')->get();
        $response = Post::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPosts()
    {
        $response = Student::with('posts')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsWithStudent()
    {
        //$response = Post::with('student','profileStudent')->get();
        $response = Post::with('student')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsWithStudentFromId($id)
    {
        //$response = Post::with('student','profileStudent')->where("student_id", "=", $id)->get();
        $response = Post::with('student')->where("student_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsWithIdStudent($id)
    {
        $response = Student::with('posts')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsWithCategory($cat)
    {
        $response = Post::with('student')->where("categorie", "=", $cat)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getPaginationPostsFromStudent($skip, $take, $id)
    {
        //$dateNow = now();
        //$response = Post::with('student','profileStudent')->orderBy("created_at", "DESC")->skip($skip)->take($take)->where("student_id", "=", $id)->get();
        $response = Post::with('student')->orderBy("created_at", "DESC")->skip($skip)->take($take)->where("student_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }
    
    public function getPaginationPosts($skip, $take)
    {
        //$dateNow = now();
        //$response = Post::with('student','profileStudent')->orderBy("created_at", "DESC")->skip($skip)->take($take)->get();
        $response = Post::with('student')->orderBy("created_at", "DESC")->skip($skip)->take($take)->get();
        $data = json_decode($response);
        return $data;
    }

    public function CountViewsPosts($id) 
    {
        $post = Post::find($id);
        $post->update(['views' => $post->views + 1]);
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
         //Service Convert Image
         if ($request->extensionImg != '') {
         $extImage  = $request->extensionImg;
         $dataImage = base64_decode($request->post_image); //decode base64 string
         $nameImage = time().".$extImage";
         $file      = "upload/posts/".$nameImage;
         $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameImage = null; }
 
         $post = new Post;
         $post->description = $request->input('description');
         $post->categorie   = $request->input('categorie');
         $post->public      = $request->input('public');
         $post->post_image  = $nameImage;
         $post->student_id  = $request->input('student_id'); 
         $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        //Service Convert Image
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->post_image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/posts/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);


        $post->description = $request->input('description');
        $post->categorie   = $request->input('categorie');
        $post->public   = $request->input('public');

        $post->post_image  = $nameImage;

        $post->student_id  = $request->input('student_id'); 

        File::delete('upload/posts/'.$post->post_image);

        $post->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Post::destroy($id);
    }
}
        // $all_posts = Post::all();
        // foreach ($all_posts as $post)
        // {
        //     echo $post->user->name ."<br>";
        // }

        // $all_posts_with_user = Post::with('user')->get();
        // foreach ($all_posts_with_user as $post)
        // {
        //     echo $post->title ."<br>";
        // }

        // $users = User::all();
        // foreach ($users as $user)
        // {
        //     echo $user->posts;
        // }

        // $users = User::all();
        // foreach ($users as $user)
        // {
        //     echo $user->name ."<br>";
        //     foreach ($user->posts as $post)
        //     {
        //         echo $post->title ."<br>";
        //         echo $post->description ."<br>";
        //     }
        // }