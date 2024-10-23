<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    public function personnel()
    {
        return $this->belongsTo('App\Models\Personnel');
    }

    public function profilePersonnel(){
        return $this->belongsTo('App\Models\ProfilePersonnel', 'personnel_id', 'id');
    }
}
