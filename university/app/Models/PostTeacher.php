<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'views',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
