<?php

namespace App\Http\Controllers\Activites;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\MyTrait;
use App\Http\Controllers\Services\ConvertBase64;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SortieController extends Controller
{
    use MyTrait;
    use ConvertBase64;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->getUrlServer().'/demandeFromStudentByCategory/القيام برحلة');
        $ActivitesSortie = json_decode($response);   
        return view('activitysortie.index', ['ActivitesSortie' => $ActivitesSortie]);
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
        //
    }

    public function updateSortieAccepter(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-updateSortieAccepter/'.$id, [
            'accepter' => $request->input('accepter'),
        ]);
        error_log('Acceptation----------------------------------'.$response);
        return redirect()->back();
    }

    public function updateSortieFaite(Request $request, $id)
    {
        $response = Http::put($this->getUrlServer().'/update-updateSortieFaite/'.$id, [
            'faite' => $request->input('faite'),
        ]);
        error_log('Faite----------------------------------'.$response);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
