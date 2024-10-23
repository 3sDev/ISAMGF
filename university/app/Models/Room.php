<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function student()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Student','room_students','student_id_sender','student_id_receiver')
        ->withPivot('id', 'room_id', 'student_id_sender', 'student_id_receiver');
    }
}
