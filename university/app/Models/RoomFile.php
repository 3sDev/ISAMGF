<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFile extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'room_files';

    use HasFactory;

    public function salle()
    {
        return $this->belongsTo('App\Models\Salle');
    }

    public function roomstudent()
    {
        return $this->belongsTo('App\Models\RoomStudent');
    }
}