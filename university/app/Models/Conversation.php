<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    public function teacher()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Teacher','conversation_teachers','teacher_id_sender','teacher_id_receiver')
        ->withPivot('id', 'conversation_id', 'teacher_id_sender', 'teacher_id_receiver');
    }
}
