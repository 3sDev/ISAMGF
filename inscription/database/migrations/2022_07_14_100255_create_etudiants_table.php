<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('diplome', 255);
            $table->string('filiere', 255);
            $table->integer('cin')->length(8);
            $table->string('nom', 30);
            $table->string('prenom', 30);
            $table->string('nom_ar', 30);
            $table->string('prenom_ar', 30);
            $table->string('full_name', 60);
            $table->string('genre', 8);
            $table->string('ddn', 30);
            $table->string('lieu_naissance', 50);
            $table->string('gov', 50);
            $table->boolean('situation_militaire');
            $table->string('etat_civil', 50);
            $table->string('nationnalite_etranger', 50);
            $table->string('passeport_etranger', 50);

            $table->integer('annee_bac')->length(4);
            $table->string('session_bac', 20);
            $table->string('section_bac', 50);
            $table->string('mention_bac', 30);
            $table->string('pays_bac', 50);

            $table->string('rue_etudiant', 255);
            $table->string('ville_etudiant', 50);
            $table->integer('codepostal_etudiant')->length(10);
            $table->string('gouvernorat_etudiant', 50);
            $table->integer('tel_etudiant')->length(15);
            $table->string('profession_etudiant', 50);
            $table->string('ce_etudiant', 100);

            $table->string('prenom_pere', 100);
            $table->string('profession_pere', 50);
            $table->string('ce_pere', 100);

            $table->string('prenom_mere', 100);
            $table->string('profession_mere', 50);
            $table->string('ce_mere', 100);

            $table->string('rue_parents', 255);
            $table->string('ville_parents', 50);
            $table->integer('codepostal_parents')->length(10);
            $table->string('gouvernorat_parents', 50);
            $table->integer('tel_parents')->length(15);

            $table->string('nom_conjoint', 100);
            $table->string('prenom_conjoint', 100);
            $table->string('profession_conjoint', 50);
            $table->string('ce_conjoint', 100);
            $table->integer('enfants_conjoint')->length(2);

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('classe_id');
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->string('api_token',255)->nullable();
            $table->string('date_token',60)->nullable();
            $table->string('expires_at',60)->nullable();
            $table->rememberToken();

            $table->string('profile_image',20)->nullable();
            $table->string('cin_file',20)->nullable();
            $table->string('paiement_file',20)->nullable();
            $table->string('file',20)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
};
