<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
{
    use HasFactory;

    public function profileTeacher()
    {
        return $this->hasOne('App\Models\ProfileTeacher');
    }

    public function demandesTeachers()
    {
        return $this->hasMany('App\Models\DemandeTeacher');
    }

    public function reclamationsteachers()
    {
        return $this->hasMany('App\Models\ReclamationTeacher');
    }

    public function attendancesteachers()
    {
        return $this->hasMany('App\Models\AttendanceTeacher');
    }

    public function messagesteachers()
    {
        return $this->hasMany('App\Models\MessageTeacher');
    }

    public function coursteachers()
    {
        return $this->hasMany('App\Models\Cours');
    }

    public function rattrapages()
    {
        return $this->hasMany('App\Models\Rattrapage');
    }

    public function matieres()
    {
        return $this->belongsToMany('App\Models\Matiere','matiere_teachers','teacher_id','matiere_id')
        ->withPivot('id', 'matiere_id', 'teacher_id', 'description');
    }

    public function vouexMatieres()
    {
        return $this->belongsTo('App\Models\VoeuMatiere');
        // return $this->hasMany('App\Models\VoeuMatiere');
    }

    public function voeux()
    {
        return $this->hasMany('App\Models\Voeu');
    }

    public function classes()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\PostTeacher');
    }

    public function surveillances()
    {
        return $this->hasMany('App\Models\Surveillance');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    public function pointages()
    {
        return $this->hasMany('App\Models\Pointage');
    }

    public function emploiTempsTeachers()
    {
        return $this->hasMany('App\Models\EmploiTempsFileTeacher');
    }

    public function emploiExamenTeachers()
    {
        return $this->hasMany('App\Models\EmploiExamenFileTeacher');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departements');
    }
    // public function posts()
    // {
    //     return $this->hasMany('App\Models\Post');
    // }
}
