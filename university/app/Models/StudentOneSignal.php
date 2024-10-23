<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentOneSignal extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'students_onesignal';

    use HasFactory;

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}