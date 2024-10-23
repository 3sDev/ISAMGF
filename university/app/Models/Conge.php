<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    public function personnel()
    {
        return $this->belongsTo('App\Models\Personnel');
    }

    public function profilePersonnel(){
        return $this->belongsTo('App\Models\ProfilePersonnel', 'personnel_id', 'id');
    }

    public function categorie()
    {
        return $this->belongsTo('App\Models\CategorieConge', 'categorie_conges_id', 'id');
    }
}
