<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiTempsFile extends Model
{
    use HasFactory;

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }
}
