<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'diplome',            
        'filiere',          
        'cin',          
        'nom',         
        'prenom',      
        'nom_ar',       
        'prenom_ar',     
        'full_name',     
        'genre',    
        'ddn',   
        'lieu_naissance',  
        'gov', 
        'etat_civil',
        'annee_bac',
        'session_bac', 
        'section_bac',
        'moyenne_bac',
        'rue_etudiant',
        'codepostal_etudiant',
        'tel1_etudiant',
        'tel2_etudiant',
        'prenom_pere',
        'profession_pere',
        'prenom_mere',
        'email',
        'password' ,
        'classe_id',
        'profile_image',
        'cin_file'   , 
        'paiement_file'
    ];

    public function classe()
    {
        return $this->belongsTo('App\Models\Classe');
    }

}
