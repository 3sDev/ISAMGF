<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;
    protected $fillable = [
        'views',
    ];

    public function notifmodel()
    {
        return $this->hasMany('App\Models\Notifmodel');
    }

    public function classes()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Classe','avis_classes','avis_id','classe_id')
        ->withPivot('id', 'avis_id', 'classe_id', 'description');
    }
}
