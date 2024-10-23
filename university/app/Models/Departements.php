<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departements extends Model
{
    use HasFactory;
    protected $table = 'departements';
    protected $fillable = [
        'departmentLabel',
        'description',
    ];

    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

    public function classes()
    {
        return $this->hasMany('App\Models\Classe');
    }

    public function salles()
    {
        return $this->hasMany('App\Models\Salle');
    }

    public function teachers()
    {
        return $this->hasMany('App\Models\Teacher');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

}
