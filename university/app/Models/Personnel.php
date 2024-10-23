<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    public function profilePersonnel()
    {
        return $this->hasOne('App\Models\ProfilePersonnel');
    }

    public function demandesPersonnels()
    {
        return $this->hasMany('App\Models\DemandePersonnel');
    }

    public function reclamationspersonnels()
    {
        return $this->hasMany('App\Models\ReclamationPersonnel');
    }

    public function attendancespersonnels()
    {
        return $this->hasMany('App\Models\AttendancePersonnel');
    }

    public function messagespersonnels()
    {
        return $this->hasMany('App\Models\MessagePersonnel');
    }

    public function congespersonnels()
    {
        return $this->hasMany('App\Models\CongePersonnel');
    }

    public function missions()
    {
        return $this->hasMany('App\Models\Mission');
    }

    public function formations()
    {
        return $this->hasMany('App\Models\Formation');
    }

    public function telechergementPersonnel()
    {
        return $this->hasMany('App\Models\TelechargementPersonnel');
    }

    public function noteProfessionnel()
    {
        return $this->hasMany('App\Models\NoteProfessionnel');
    }
}
