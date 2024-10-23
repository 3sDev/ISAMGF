<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function user()
    {   //relation message / user
        return $this->belongsToMany('App\Models\User','message_personnel_students','message_id','user_id')
        ->withPivot('id', 'message_id', 'user_id', 'description');
    }

    public function student()
    {   //relation message / student
        return $this->belongsToMany('App\Models\Student','message_personnel_students','message_id','student_id')
        ->withPivot('id', 'message_id', 'student_id', 'description');
    }
}
