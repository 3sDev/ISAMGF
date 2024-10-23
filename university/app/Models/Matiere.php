<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $table = 'matieres';
    protected $fillable = [
        'subjectLabel',
        'description',
        'volume',
        'semestre',
        'nbr_eliminatoire',
    ];

    public function rattrapages()
    {
        return $this->hasMany('App\Models\Rattrapage');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','matiere_teachers','matiere_id','teacher_id');
    }

    public function classes()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Classe','matiere_classes','matiere_id','classe_id');
    }

    public function attendance()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Attendance');
    }

    public function vouex()
    {
        return $this->belongsToMany('App\Models\Voeu',' voeu_matieres','voeu_id','matiere_id');
    }

    public function pointages()
    {
        return $this->hasMany('App\Models\Pointage');
    }

    // public function voeuxMatieres()
    // {
    //     return $this->belongsToMany('App\Models\VoeuMatiere','voeu_matieres','voeu_id','matiere_id');
    // }
}
