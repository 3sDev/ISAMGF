<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $fillable = [
        'classeName',
        'abbreviation',
        'department_id',
        'section_id',
        'level_id',
    ];

    public function departement()
    {
        return $this->belongsTo('App\Models\Departements');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function etudiant()
    {
        return $this->hasOne('App\Models\Etudiant');
    }

    public function reclamations()
    {
        return $this->belongsTo('App\Models\Reclamation');
    }

    public function rattrapages()
    {
        return $this->hasMany('App\Models\Rattrapage');
    }

    public function matieres()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Matiere','matiere_classes','classe_id','matiere_id')
        ->withPivot('id', 'classe_id', 'matiere_id', 'description');
    }

    public function avis()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Avis','avis_classes','classe_id','avis_id');
    }

    public function attendance()
    {
        return $this->belongsTo('App\Models\Attendance');
    }

    // public function demandeStudent()
    // {
    //     return $this->belongsTo('App\Models\DemandeStudent');
    // }

    public function demandesStudents()
    {
        return $this->hasMany('App\Models\DemandeStudent');
    }

    public function cours()
    {
        return $this->belongsToMany('App\Models\Cours','cours_classes','cours_id','classe_id')
        ->withPivot('id', 'cours_id', 'classe_id');
    }

    public function emploiTempsStudents()
    {
        return $this->hasMany('App\Models\EmploiTempsFile');
    }

    public function emploiExamenStudents()
    {
        return $this->hasMany('App\Models\EmploiExamenFile');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\note');
    }

    // public function emploiteachers()
    // {
    //     return $this->belongsTo('App\Models\EmploiTeacher');
    // }
}
