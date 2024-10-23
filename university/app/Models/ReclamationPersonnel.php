<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReclamationPersonnel extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'statut',
        'reponse',
        'personnel_id',
    ];

    public function personnel()
    {
        return $this->belongsTo('App\Models\Personnel');
    }
}
