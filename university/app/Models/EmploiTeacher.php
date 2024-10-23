<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiTeacher extends Model
{
    use HasFactory;

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere');
    }

    public function salle()
    {
        return $this->belongsTo('App\Models\Salle');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function attendancesteachers()
    {
        return $this->belongsTo('App\Models\AttendanceTeacher');
    }
}
