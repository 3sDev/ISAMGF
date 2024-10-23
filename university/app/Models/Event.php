<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'titre',
        'description',
        'adresse',
        'date',
        'rating',
        'views',
        'image'
    ];

    public function notifmodel()
    {
        return $this->hasMany('App\Models\Notifmodel');
    }
    // public function notifmodel()
    // {
    //     return $this->belongsTo('App\Models\Notifmodel');
    // }
}
