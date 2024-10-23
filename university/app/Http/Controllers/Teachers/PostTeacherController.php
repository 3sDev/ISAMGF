<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\PostTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = PostTeacher::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsTeachers()
    {
        $response = Teacher::with('posts')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsWithTeacher()
    {
        $response = PostTeacher::with('teacher')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsWithTeacherFromId($id)
    {
        $response = PostTeacher::with('teacher')->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsWithIdTeacher($id)
    {
        $response = Teacher::with('posts')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllPostsWithCategoryFromTeacher($cat)
    {
        $response = PostTeacher::with('teacher')->where("categorie", "=", $cat)->get();
        $data = json_decode($response);
        return $data;
    }

    
    public function getPaginationPostsFromTeacher($skip, $take, $id)
    {
        //$response = PostTeacher::with('teacher')->orderBy("created_at", "DESC")->skip($skip)->take($take)->where("teacher_id", "=", $id)->get();
        $response = PostTeacher::with('teacher')->orderBy("created_at", "DESC")->skip($skip)->take($take)->where("teacher_id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getPaginationPostsTeachers($skip, $take)
    {
        $response = PostTeacher::with('teacher')->orderBy("created_at", "DESC")->skip($skip)->take($take)->get();
        $data = json_decode($response);
        return $data;
    }

    public function CountViewsPostsTeachers($id) 
    {
        $post = PostTeacher::find($id);
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
            $file      = "upload/posts-teachers/".$nameImage;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameImage = null; }
    
        $post = new PostTeacher();
        $post->description = $request->input('description');
        $post->categorie   = $request->input('categorie');
        $post->public      = $request->input('public');
        $post->post_image  = $nameImage;
        $post->teacher_id  = $request->input('teacher_id'); 
        $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $post = PostTeacher::find($id);

        //Service Convert Image
        if ($request->extensionImg != '') {
        File::delete('upload/posts-teachers/'.$post->post_image);
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->post_image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/posts-teachers/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameImage = $post->post_image; }

        $post->description = $request->input('description');
        $post->categorie   = $request->input('categorie');
        $post->public      = $request->input('public');
        $post->post_image  = $nameImage;
        $post->teacher_id  = $request->input('teacher_id'); 

        $post->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return PostTeacher::destroy($id);
    }
}
