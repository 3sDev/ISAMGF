<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'nom_ar',
        'prenom_ar',
        'email',
        'password',
        'api_token',
        'date_token',
        'expires_at',
        'municipality',
    ];

    public function profileStudent()
    {
        return $this->hasOne('App\Models\ProfileStudent');
    }

    public function demandesStudents()
    {
        return $this->hasMany('App\Models\DemandeStudent');
    }

    public function reclamations()
    {
        return $this->hasMany('App\Models\Reclamation');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function stages()
    {
        return $this->hasMany('App\Models\Stage');
    }

    public function messages()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Message','message_personnel_students','message_id','student_id');
    }

    public function user()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Message','message_personnel_students','message_id','user_id');
    }

    public function room()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Room','room_students','student_id_sender','student_id_receiver');
    }
  
  	public function post()
    {   //relation post / student
        return $this->belongsToMany('App\Models\Post','post_like_students','post_id','student_id');
        //->withPivot('id', 'post_id', 'student_id', 'statut');
    }

    public function onesignal()
    {
        return $this->hasMany('App\Models\StudentOneSignal');
    }
  
    public function postSignal()
    {   //relation post / student
        return $this->belongsToMany('App\Models\PostSignalStudent','post_signal_students ','post_id','student_id');
        //->withPivot('id', 'post_id', 'student_id', 'statut');
    }

    public function blockstudent()
    {   //relation room blocked / student
        return $this->belongsToMany('App\Models\RoomBlockStudent', 'room_block_students', 'student_blocked_id', 'student_blocker_id');
    }
}
