<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function profileStudent(){
        return $this->belongsTo('App\Models\ProfileStudent', 'student_id', 'id');
    }

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }
}
