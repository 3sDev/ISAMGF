<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifsystem extends Model
{
    use HasFactory;

    public function notifmodel()
    {
        return $this->belongsTo('App\Models\Notifmodel');
    }

    public function event(){
        return $this->belongsTo('App\Models\Event', 'idInfo', 'id');
    }

    public function avis(){
        return $this->belongsTo('App\Models\Avis', 'idInfo', 'id');
    }

    public function news(){
        return $this->belongsTo('App\Models\News', 'idInfo', 'id');
    }
}
