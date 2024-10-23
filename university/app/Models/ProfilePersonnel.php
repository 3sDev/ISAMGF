<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePersonnel extends Model
{
    use HasFactory;

    public function personnel()
    {
        return $this->belongsTo('App\Models\Personnel');
    }

    public function conges()
    {
        return $this->belongsTo('App\Models\Conge');
    }

    // public function posts(){
    //     return $this->hasMany('App\Models/Post');
    // }
}
