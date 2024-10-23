<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rattrapage extends Model
{
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function profileTeacher(){
        return $this->belongsTo('App\Models\ProfileTeacher', 'teacher_id', 'id');
    }

    public function classes()
    {
        return $this->belongsTo('App\Models\Classe', 'classe_id', 'id');
    }

    public function matieres()
    {
        return $this->belongsTo('App\Models\Matiere', 'matiere_id', 'id');
    }

    public function salles()
    {
        return $this->belongsTo('App\Models\Salle', 'salle_id', 'id');
    }
}