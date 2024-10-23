<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'teachers_specialites';
    protected $fillable = [
        'label',
        'description',
    ];

    use HasFactory;
}