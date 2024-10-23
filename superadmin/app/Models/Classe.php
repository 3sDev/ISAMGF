<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $fillable = [
        'classeName',
        'abbreviation',
        'department_id',
        'section_id',
        'level_id',
    ];
}
