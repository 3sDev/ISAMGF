<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'titre',
        'description',
        'adresse',
        'date',
        'rating',
        'views',
        'image',
        'link'
    ];

    public function notifmodel()
    {
        return $this->hasMany('App\Models\Notifmodel');
    }
}
