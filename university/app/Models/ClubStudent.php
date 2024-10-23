<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubStudent extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'club_students'; 
    protected $fillable = [
        'classe_id',
        'student_id',
        'club',
        'club_id',
        'demande_id',
    ];

    use HasFactory;
}