<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendance_date',
        'justification',
        'date_justification'
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function seance()
    {
        return $this->belongsTo('App\Models\EmploiTeacher');
    }
}
