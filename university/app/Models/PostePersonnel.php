<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostePersonnel extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'personnels_postes';

    use HasFactory;
}
