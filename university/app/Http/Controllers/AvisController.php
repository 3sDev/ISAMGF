<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\AvisClasse;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Image;

class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Avis::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllAvis()
    {
        $response = Avis::orderBy("created_at", "DESC")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllAvisWithType($type)
    {
        $response = Avis::where("type", "=", $type)->orderBy("created_at", "DESC")->get();
        $data = json_decode($response);
        return $data;
    }

    public function avisTeacher()
    {
        $response = Avis::where("type", "=", "Enseignant")->get();
        $data = json_decode($response);
        return $data;
    }

    public function avisPersonnel()
    {
        $response = Avis::where("type", "=", "Personnel")->get();
        $data = json_decode($response);
        return $data;
    }
    
    // Avis scolarité
    public function avisScolarite()
    {
        $response = Avis::where("type", "=", "scolarité")->get();
        $data = json_decode($response);
        return $data;
    }

    public function avisScolariteClasseWithIdAvis($id)
    {
        $response = Avis::with('classes')->where("type", "=", "scolarité")->where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function avisScolariteWithClasses()
    {
        $response = Avis::with('classes')->where("type", "=", "scolarité")->get();
        $data = json_decode($response);
        return $data;
    }

    public function allAvisScolariteByIdClasse($id_classe)
    {
        // $response = Classe::with('avis')->where("id", "=", $id_classe)
        // ->orderBy("created_at", "DESC")->skip($skip)->take($take)->get();

        $response2 = Classe::with('avis')->where("id", "=", $id_classe)
                            ->orderBy("created_at", "DESC")->get();

        $data = json_decode($response2);
        return $data;
    }


    public function getPaginationAvis($skip, $take, $type)
    {
        //$dateNow = now();
        $response = Avis::orderBy("created_at", "DESC")->skip($skip)->take($take)->where("type", "=", $type)->get();
        $data = json_decode($response);
        return $data;
    }

    public function CountViewsAvis($id) 
    {
        $avis = Avis::find($id);
        $avis->views = $avis->views +1;
        $avis->update();
    }

    public function avisClasse()
    {
        $response = Avis::with('classes')->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAvisByClasse($id)
    {
        $sql = DB::select('SELECT avis.id as id, avis.titre as titre,avis.description as description,avis.adresse as adresse,avis.date as date,avis.rating as rating, avis.views as views,avis.image as image, avis.fichier as fichier, avis.type as type,avis.created_at as created_at,avis.updated_at as updated_at FROM avis,avis_classes,classes WHERE avis.id = avis_classes.avis_id and avis_classes.classe_id = classes.id and classes.id = ?', [$id]);
       return $sql;
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


    public function createImage(Request $request, $img)
    {
        $folderPath = "image/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '. '.$image_type;
        file_put_contents($file, $image_base64);
    }

    public function store(Request $request)
    {
        if ($request->extensionImg != '') {
        //Service Convert Image
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/avis/images/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameImage = null; }

        if ($request->extensionFile != '') {
        //Service Convert PDF
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/avis/files/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);
        }
        else { $nameFile = null; }

        $avis = new Avis;
        $avis->titre = $request->input('titre');
        $avis->description = $request->input('description');
        $avis->date = $request->input('date');
        $avis->adresse = $request->input('adresse');
        $avis->rating = $request->input('rating');
        $avis->views = $request->input('views');
        $avis->type = $request->input('type');
        $avis->departement = $request->input('departement');

        $avis->image = $nameImage;
        $avis->fichier = $nameFile;

        $avis->save();
        
    }

    public function storeScolarite(Request $request)
    {
        //Service Convert Image
        $extImage  = $request->extensionImg;
        $dataImage = base64_decode($request->image); //decode base64 string
        $nameImage = time().".$extImage";
        $file      = "upload/avis/images/".$nameImage;
        $moveImage = file_put_contents($file, $dataImage);

        // //Service Convert PDF
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/avis/files/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);

        $now = new \DateTime();
        $created_at = $now->format('Y-m-d H:i:s');

        // $myIdClasses = $request->classe_id;
        // return $myIdClasses;

        $avis_classe_id = Avis::insertGetId([
            'titre'       => $request->input('titre'),
            'description' => $request->input('description'),
            'date'        => $request->input('date'),
            'rating'      => $request->input('rating'),
            'views'       => $request->input('views'),
            'type'        => $request->input('type'),
            'image'       => $nameImage,
            'fichier'     => $nameFile,
            'created_at'  => $created_at,
            'updated_at'  => $created_at,
        ]);

        $ID_Classe = $request->classe_id;
        foreach ($ID_Classe as $key => $insert) {
            $datasave = [
                'avis_id'    => $avis_classe_id,
                'classe_id'  => $ID_Classe[$key],
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
            DB::table('avis_classes')->insert($datasave);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function show(Avis $avis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function edit(Avis $avis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $avis = Avis::find($id);
        $avis->titre = $request->input('titre');
        $avis->description = $request->input('description');
        $avis->date = $request->input('date');
        $avis->adresse = $request->input('adresse');
        $avis->rating = $request->input('rating');
        $avis->views = $request->input('views');
        $avis->type = $request->input('type');
        $avis->departement = $request->input('departement');

        $avis->update();
    }

    public function updateImageAvis(Request $request, $id)
    {
        $avis = Avis::find($id);
        //Service Convert File
        if ($request->extensionImage != '') {
            File::delete('upload/avis/images/'.$avis->image);
            $extFile   = $request->extensionImage;
            $dataImage = base64_decode($request->image); //decode base64 string
            $nameFile4 = time().".$extFile";
            $file      = "upload/avis/images/".$nameFile4;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile4 = $avis->image; }
        $avis->image = $nameFile4;
        $avis->update();   
    }

    public function updateFileAvis(Request $request, $id)
    {
        $avis = Avis::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/avis/files/'.$avis->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/avis/files/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $avis->fichier; }
        $avis->fichier = $nameFile3; 
        $avis->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avis  $avis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Avis::destroy($id);
    }
}
