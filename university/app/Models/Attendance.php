<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function matiere()
    {
        return $this->belongsTo('App\Models\Matiere');
    }

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function notificationStudents()
    {
        return $this->belongsTo('App\Models\NotificationStudent');
    }
}
