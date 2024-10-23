<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieConge extends Model
{
    use HasFactory;
    
    public function conges()
    {
        return $this->hasMany('App\Models\Conge');
    }
}
