<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
//use Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function resizeImage()
    {
        return view('image');
    }

    public function resizeImageSubmite(Request $request)
    {
        $image        = $request->file;
        $filename     = $image->getClientOriginalName();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300,300);
        $image_resize->save(public_path('image/'.$filename));
        return 'Image has been resized successfuly!';
        //return view('resize-image');
    }

    public function convertImageTo64(Request $request)
    {
        
        // if($request->image)
        // {
        //     $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos
        //     ($request->image, ';')))[1])[1];

        //     \Image::make($request->image)->save(public_path('image/').$name);
        //     echo $name;
        // }

        /*                                Fonction                                      */
        // if ($request->image)
        // {
        //     $ext    = $request->image->extention();
        //     $data   = file_get_contents($request->image);
        //     $base64 = 'data:image/'.$ext.';base64'.base64_encode($data);

        //     return response()->json($base64);
        // }

        /*                            Fonction                                        */
        if ($request->image){
            $ext = $request->image->extension();
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
                $data = file_get_contents($request->image);
                $base64 = 'data:image/'.$ext.';base64'.base64_encode($data);
                //return $base64;
                //return response()->json($base64, 201);

                //$base64_image = base64_decode($base64);

                $base64Json = response()->json($base64);

                //get the base-64 from data
                $base64_str = substr($base64Json, strpos($base64Json, ",")+1);

                //decode base64 string
                $image = $data = explode(',', base64_decode($base64_str));
                

                $png_url = "sss-".time().".png";
                $path = public_path().'/image/' . $png_url;
            
                Image::make(file_get_contents($image))->save($path);
                // I've tried using 




                // $dataFile = base64_decode($base64_image);

                // //return $dataFile;
                // $image        = $dataFile;
                // $filename     = $image->getClientOriginalName();
                // $image_resize = Image::make($image->getRealPath());
                // $image_resize->resize(300,300);
                // $image_resize->save(public_path('image/'.$filename));
                // return 'Image has been resized successfuly!';


              

            }
        }

        
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
