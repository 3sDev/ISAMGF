<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileTeacher extends Model
{
    use HasFactory;

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function cours()
    {
        return $this->hasMany('App\Models\Cours');
    }

    public function rattrapages()
    {
        return $this->belongsTo('App\Models\Rattrapage');
    }
    // public function posts(){
    //     return $this->hasMany('App\Models/Post');
    // }
}
