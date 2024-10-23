<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function profileTeacher()
    {
        return $this->hasOne('App\Models\ProfileTeacher');
    }

    public function classe()
    {
        return $this->belongsToMany('App\Models\Classe','cours_classes','cours_id','classe_id');
    }
}
