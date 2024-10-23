<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBlockStudent extends Model
{
    use HasFactory;

    public function students()
    {   
        return $this->belongsToMany('App\Models\Student', 'room_block_students', 'student_blocked_id', 'student_blocker_id');
    }
}
