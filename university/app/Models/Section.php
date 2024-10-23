<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $fillable = [
        'fullName',
        'abbreviation',
        'department_id'
    ];

    public function departement()
    {
        return $this->belongsTo('App\Models\Departements');
    }

    public function classes()
    {
        return $this->hasMany('App\Models\Classe');
    }

    public function levelSection()
    {
        return $this->belongsTo('App\Models\LevelSection');
    }
}
