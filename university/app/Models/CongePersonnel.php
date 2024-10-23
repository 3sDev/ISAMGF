<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongePersonnel extends Model
{
    use HasFactory;

    public function personnel()
    {
        return $this->belongsTo('App\Models\Personnel');
    }
}
