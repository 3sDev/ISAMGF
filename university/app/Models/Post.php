<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'views',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function profileStudent(){
        return $this->belongsTo('App\Models\ProfileStudent', 'student_id', 'id');
    }
  
  	public function students()
    {
        return $this->belongsToMany('App\Models\Student','post_like_students','post_id','student_id')
        ->withPivot('id', 'description', 'post_id', 'student_id');
    }
  
    public function postSignal()
    {
        return $this->belongsTo('App\Models\PostSignalStudent');
    }
   
}
