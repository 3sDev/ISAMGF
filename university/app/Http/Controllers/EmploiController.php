<?php

namespace App\Http\Controllers;

use App\Models\Emploi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $response = Emploi::where("id", "=", $id)->get();
        $data = json_decode($response);
        return $data;
    }

    public function getAllEmplois()
    {
        $response = Emploi::orderBy("created_at", "DESC")->get();
        $data = json_decode($response);
        return $data;
    }

    public function getPaginationEmplois($skip, $take)
    {
        //$dateNow = now();
        $response = Emploi::orderBy("created_at", "DESC")->skip($skip)->take($take)->get();
        $data = json_decode($response);
        return $data;
    }

    public function CountViewsEmploi($id) 
    {
        $emploi = Emploi::find($id);
        $emploi->views = $emploi->views + 1;
        $emploi->update();
    }

    public function getEmploiByClassFromSemestre($jour, $id, $semestre)
    {
        $sql = DB::select('SELECT `emploi_teachers`.`jour`, `emploi_teachers`.`heure_debut`, `emploi_teachers`.`heure_fin`, salles.fullName as salle,matieres.subjectLabel as nomMatiere,matieres.description as type, teachers.full_name as nomProf, emploi_teachers.semestre as semestre FROM `emploi_teachers`,matieres, classes,salles,teachers WHERE matieres.id = `emploi_teachers`.`matiere_id` AND classes.id = `emploi_teachers`.`classe_id` AND `emploi_teachers`.`salle_id` = salles.id AND `emploi_teachers`.`teacher_id`= teachers.id AND  `emploi_teachers`.`jour` = ? AND `emploi_teachers`.`classe_id` = ? AND `emploi_teachers`.`semestre` = ? ORDER BY `emploi_teachers`.`heure_debut`', [$jour, $id, $semestre]);
       return $sql;
    }

    //Emploi de temps by id classe
    public function getEmploiByClass($jour, $id)
    {
        $sql = DB::select('SELECT `emploi_teachers`.`jour`, `emploi_teachers`.`heure_debut`, `emploi_teachers`.`heure_fin`, salles.fullName as salle,matieres.subjectLabel as nomMatiere,matieres.description as type, teachers.full_name as nomProf FROM `emploi_teachers`,matieres, classes,salles,teachers WHERE matieres.id = `emploi_teachers`.`matiere_id` AND classes.id = `emploi_teachers`.`classe_id` AND `emploi_teachers`.`salle_id` = salles.id AND `emploi_teachers`.`teacher_id`= teachers.id AND  `emploi_teachers`.`jour` = ? AND `emploi_teachers`.`classe_id` = ? ORDER BY `emploi_teachers`.`heure_debut`', [$jour,$id]);
       return $sql;
    }

    //Emploi de temps by id teacher
    public function getEmploiByTeacher($jour, $id)
    {
        $sql = DB::select('SELECT `emploi_teachers`.`id`, `emploi_teachers`.`jour`, `emploi_teachers`.`heure_debut`, `emploi_teachers`.`heure_fin`, salles.fullName as salle,matieres.subjectLabel as nomMatiere,matieres.description as type, classes.abbreviation as nomClasse FROM `emploi_teachers`,matieres, classes,salles,teachers WHERE matieres.id = `emploi_teachers`.`matiere_id` AND classes.id = `emploi_teachers`.`classe_id` AND `emploi_teachers`.`salle_id` = salles.id AND `emploi_teachers`.`teacher_id`= teachers.id AND  `emploi_teachers`.`jour` = ? AND `emploi_teachers`.`teacher_id` = ? ORDER BY `emploi_teachers`.`heure_debut`', [$jour,$id]);
        return $sql;
    }

    public function getEmploiByTeacherFromSemestre($jour, $id, $semestre)
    {
        $sql = DB::select('SELECT `emploi_teachers`.`id`, `emploi_teachers`.`jour`, `emploi_teachers`.`heure_debut`, `emploi_teachers`.`heure_fin`, salles.fullName as salle,matieres.subjectLabel as nomMatiere,matieres.description as type, classes.abbreviation as nomClasse, emploi_teachers.semestre as semestre FROM `emploi_teachers`,matieres, classes,salles,teachers WHERE matieres.id = `emploi_teachers`.`matiere_id` AND classes.id = `emploi_teachers`.`classe_id` AND `emploi_teachers`.`salle_id` = salles.id AND `emploi_teachers`.`teacher_id`= teachers.id AND  `emploi_teachers`.`jour` = ? AND `emploi_teachers`.`teacher_id` = ? AND `emploi_teachers`.`semestre` = ? ORDER BY `emploi_teachers`.`heure_debut`', [$jour, $id, $semestre]);
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
    public function store(Request $request)
    {
        //Service Convert PDF
        $extFile  = $request->extensionFile;
        $dataFile = base64_decode($request->fichier); //decode base64 string
        $nameFile = time().".$extFile";
        $file     = "upload/offre_emploi/files/".$nameFile;
        $moveFile = file_put_contents($file, $dataFile);

        $emploi = new Emploi;
        $emploi->titre        = $request->input('titre');
        $emploi->description  = $request->input('description');
        $emploi->nom_societe  = $request->input('nom_societe');
        $emploi->info_societe = $request->input('info_societe');

        $emploi->fichier      = $nameFile;

        $emploi->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Emploi $emploi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(Emploi $emploi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $offreEmploi = Emploi::find($id);
        $offreEmploi->update($request->all());
    }

    public function updatefileOffre(Request $request, $id)
    {
        $offre = Emploi::find($id);
        //Service Convert File
        if ($request->extensionFile != '') {
            File::delete('upload/offre_emploi/files/'.$offre->fichier);
            $extFile   = $request->extensionFile;
            $dataImage = base64_decode($request->fichier); //decode base64 string
            $nameFile3 = time().".$extFile";
            $file      = "upload/offre_emploi/files/".$nameFile3;
            $moveImage = file_put_contents($file, $dataImage);
        }
        else { $nameFile3 = $offre->fichier; }
        $offre->fichier = $nameFile3; 
        $offre->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emploi  $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Emploi::destroy($id);
    }
}
