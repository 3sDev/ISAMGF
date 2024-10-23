<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifmodel extends Model
{
    use HasFactory;

    public function notifsystems()
    {
        return $this->hasMany('App\Models\NotifSystem');
    }

    public function notificationStudents()
    {
        return $this->hasMany('App\Models\NotificationStudent');
    }
}
