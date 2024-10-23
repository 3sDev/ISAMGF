<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalleEmploi extends Model
{
    use HasFactory;

    public function salle()
    {
        return $this->belongsTo('App\Models\Salle');
    }

}
