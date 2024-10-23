<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenStudent extends Model
{
    use HasFactory;

    public function examens()
    {
        return $this->hasMany('App\Models\Examen');
    }
}