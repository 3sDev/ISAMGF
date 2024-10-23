<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_ar',
        'nom_fr',
        'description',
        'logo',
        'statut',
        'chef',
        'membre_1',
        'membre_2',
        'membre_3',
        'membre_4',
        'membre_5',
    ];
}
