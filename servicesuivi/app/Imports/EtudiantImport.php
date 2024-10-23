<?php

namespace App\Imports;

use App\Models\Etudiant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EtudiantImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Etudiant([
        'diplome'             => $row['diplome'],
        'filiere'             => $row['filiere'],
        'cin'                 => $row['cin'],
        'nom'                 => $row['nom'],
        'prenom'              => $row['prenom'],
        'nom_ar'              => $row['nom_ar'],
        'prenom_ar'           => $row['prenom_ar'],
        'full_name'           => $row['full_name'],
        'genre'               => $row['genre'],
        'ddn'                 => $row['ddn'],
        'lieu_naissance'      => $row['lieu_naissance'],
        'gov'                 => $row['gov'],
        'etat_civil'          => $row['etat_civil'],
        'annee_bac'           => $row['annee_bac'],
        'session_bac'         => $row['session_bac'],
        'section_bac'         => $row['section_bac'],
        'moyenne_bac'         => $row['moyenne_bac'],
        'rue_etudiant'        => $row['rue_etudiant'],
        'codepostal_etudiant' => $row['codepostal_etudiant'],
        'tel1_etudiant'       => $row['tel1_etudiant'],
        'tel2_etudiant'       => $row['tel2_etudiant'],
        'prenom_pere'         => $row['prenom_pere'],
        'profession_pere'     => $row['profession_pere'],
        'prenom_mere'         => $row['prenom_mere'],
        'email'               => $row['email'],
        'password'            => \Hash::make($row['password']),
        'classe_id'           => $row['classe_id'],
        'profile_image'       => $row['profile_image'],
        'cin_file'            => $row['cin_file'],
        'paiement_file'       => $row['paiement_file']
        ]);
    }
}
