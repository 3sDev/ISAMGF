<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lien extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'url', 'type', 'categorie'];
}
