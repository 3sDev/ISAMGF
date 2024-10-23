<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReclamationTeacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'statut',
        'reponse',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }
}
