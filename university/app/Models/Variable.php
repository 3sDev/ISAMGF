<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'variables';

    use HasFactory;
}
