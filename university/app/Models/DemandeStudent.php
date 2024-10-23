<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeStudent extends Model
{
    use HasFactory;
  	protected $dates = ['created_at', 'updated_at'];
  	protected $fillable = ['type', 'years', 'semestre', 'statut', 'student_id', 'user_id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
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
