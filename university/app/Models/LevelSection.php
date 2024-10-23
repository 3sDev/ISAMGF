<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelSection extends Model
{
    use HasFactory;

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
}
