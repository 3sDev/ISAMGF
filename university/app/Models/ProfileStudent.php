<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileStudent extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->hasOne('App\Models\Student');
    }

    public function posts(){
        return $this->hasMany('App\Models/Post');
    }
}
