<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSignalStudent extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'student_id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
