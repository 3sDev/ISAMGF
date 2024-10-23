<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Departements;
use Illuminate\Support\Facades\File;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
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

        //$response = User::with('posts')->where('name', '=', 'kamel')->get();
        $sections = Departements::join('sections', 'sections.department_id', '=', 'departements.id')->where('sections.id', $id)
        ->get(['sections.id', 'sections.fullName', 'sections.abbreviation', 'sections.created_at', 'sections.updated_at',
        'sections.department_id', 'departements.departmentLabel']);
        $data = json_decode($sections);
        return $data;
    }

    public function getAllSections()
    {
        $sections = Departements::join('sections', 'sections.department_id', '=', 'departements.id')
        ->get(['sections.id', 'sections.fullName', 'sections.abbreviation', 'sections.created_at', 'sections.updated_at',
        'sections.department_id', 'departements.departmentLabel']);
        $data = json_decode($sections);
        return $data;
    }

    public function getDepartSelect()
    {
        $response = Departements::all();
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
        return view('section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = new Section;
        $section->fullName = $request->input('fullName');
        $section->abbreviation = $request->input('abbreviation');
        $section->department_id = $request->input('department_id');

        $section->save();
        //return redirect('/sections')->with('message', 'Filière est ajouté avec succés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return view('section.show', compact('section'));
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
        $section=Section::find($id);
        $section->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Section::destroy($id);
    }
}
