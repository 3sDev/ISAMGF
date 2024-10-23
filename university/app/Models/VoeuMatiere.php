<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoeuMatiere extends Model
{
    use HasFactory;

    public function voeu()
    {
        return $this->belongsTo('App\Models\Voeu');
    }

    public function matieres()
    {
        return $this->belongsTo('App\Models\Matiere');
    }
}
