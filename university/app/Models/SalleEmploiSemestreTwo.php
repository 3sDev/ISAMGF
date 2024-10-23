<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalleEmploiSemestreTwo extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'salle_emplois_2';

    use HasFactory;

    public function salle()
    {
        return $this->belongsTo('App\Models\Salle');
    }
}