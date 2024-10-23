<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $table = 'levels';
    protected $fillable = [
        'levelLabel',
        'description',
    ];

    public function classes()
    {
        return $this->hasMany('App\Models\Classe');
    }

    public function levelSection()
    {
        return $this->belongsTo('App\Models\LevelSection');
    }
}
