<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    use HasFactory;
    protected $table = 'reclamations';
    protected $fillable = [
        'description',
        'statut'
    ];

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
