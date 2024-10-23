<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    protected $table = 'salles';
    protected $fillable = [
        'fullName',
        'abbreviation',
        'department_id'
    ];

    public function departements()
    {
        return $this->belongsTo('App\Models\Departements');
    }

    public function rattrapages()
    {
        return $this->hasMany('App\Models\Rattrapage');
    }

    public function salleEmplois()
    {
        return $this->hasMany('App\Models\SalleEmploi');
    }

    public function salleEmploisSemestreTwo()
    {
        return $this->hasMany('App\Models\SalleEmploiSemestreTwo');
    }
}
