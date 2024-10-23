<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationStudent extends Model
{
    protected $table = 'notification_students';
    use HasFactory;

    public function notifmodel()
    {
        return $this->belongsTo('App\Models\Notifmodel');
    }

    public function attendances(){
        return $this->belongsTo('App\Models\Attendance', 'idInfo', 'id');
    }

    public function demandes(){
        return $this->belongsTo('App\Models\DemandeStudent', 'idInfo', 'id');
    }

    public function reclamations(){
        return $this->belongsTo('App\Models\Reclamation', 'idInfo', 'id');
    }
}
