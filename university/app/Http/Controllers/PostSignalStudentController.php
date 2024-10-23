<?php

namespace App\Http\Controllers;

use App\Models\PostSignalStudent;
use Illuminate\Http\Request;

class PostSignalStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = PostSignalStudent::with('post', 'student')->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllFlaggedPosts ()
    {
        $response = PostSignalStudent::with('post', 'student')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getFlaggedPostsWithIdStudent($id)
    {
        $response = PostSignalStudent::with('post', 'student')->where("student_id", "=", $id)->get();
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
        try {
            $post = new PostSignalStudent;
            $post->post_id    = $request->input('post_id');
            $post->student_id = $request->input('student_id');
            $post->statut     = $request->input('statut');
            $post->motif      = $request->input('motif'); 
            $post->save();
            return response()->json([
                'message' => 'Signal Post added successfully'
            ]);

        } catch(\Exception $e){
            //error_log($e->getMessage());
            return response()->json([
                'Error from signal post!!'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostSignalStudent  $postSignalStudent
     * @return \Illuminate\Http\Response
     */
    public function show(PostSignalStudent $postSignalStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostSignalStudent  $postSignalStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(PostSignalStudent $postSignalStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostSignalStudent  $postSignalStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        try {
            $post = PostSignalStudent::find($id);

            $post->post_id    = $request->input('post_id');
            $post->student_id = $request->input('student_id');
            $post->statut     = $request->input('statut');
            $post->motif      = $request->input('motif'); 

            $post->update();

            return response()->json([
                'message' => 'Signal Post updated successfully'
            ]);

        } catch(\Exception $e){
            //error_log($e->getMessage());
            return response()->json([
                'Error from update the signal of post!!'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostSignalStudent  $postSignalStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            return PostSignalStudent::destroy($id);

        } catch(\Exception $e){
            error_log($e->getMessage());
            return response()->json([
                'Error from delete the signal of post!!'
            ],500);
        }
        
    }
}
