<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\MessageService;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    // Comments of Post
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course');
    }

    public function demandesStudents()
    {
        return $this->hasMany('App\Models\DemandeStudent');
    }

    public function cours()
    {
        return $this->belongsToMany('App\Models\Cours', 'course_user');
    }

    public function messageservices()
    {
        return $this->hasMany(MessageService::class, 'user_sender_id', 'user_receiver_id');
    }

    public function agendas()
    {
        return $this->hasMany('App\Models\Agenda');
    }

    public function stages()
    {
        return $this->hasMany('App\Models\Stage');
    }

    public function messages()
    {   //relation matiere / classe
        return $this->belongsToMany('App\Models\Message','message_personnel_students','message_id','user_id','student_id');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departements');
    }

    public function messageserviceusers()
    {  
        return $this->belongsToMany('App\Models\MessageService','message_service_users', 'message_services_id', 'user_sender_id','user_receiver_id');
    }
    
}

