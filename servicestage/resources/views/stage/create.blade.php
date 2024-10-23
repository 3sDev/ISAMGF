@extends('adminlayoutenseignant.layout')
@section('title', 'Créer un nouveau stage')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau stage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('stages') }}">Liste des stages</a></li>
                <li class="breadcrumb-item active">Nouveau stage</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<style>
    .titreDemande{
        background-color: rgb(218, 218, 218);
        padding: 10px 22px;
        border-radius: 12px;
        text-align: center;
    }
</style>
    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            <div class="card">

                <div class="card-body">

                    <form action="{{ url('stages') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet element?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="titreDemande">Information de la société </h5>
                                </div><br>
                                <div class="col-md-6">
                                    <label for="">Nom société</label>
                                    <input type="text" name="nom_socite" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Encadrant Société</label>
                                    <input type="text" name="encadrant_societe" class="form-control" required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Description Société</label>
                                    <textarea name="info_socite" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Sujet</label>
                                    <textarea name="sujet" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-md-12">
                                <h5 class="titreDemande">Information de stage </h5>
                            </div>
                            <div class="row" style="margin-top: 1.5%;">
                                <div class="col-md-4">
                                    <label for="">Type de stage</label>
                                    <select name="type" class="form-control" data-style="btn btn-primary" required>
                                        <option value="" selected disabled>Selectionner type de stage</option>
                                        <option value="1er année">1er année</option>
                                        <option value="2eme année">2eme année</option>
                                        <option value="PFE">PFE (Projet fin d'étude)</option>
                                        <option value="Mémoire">Mémoire (stage mémoire)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Date début stage</label>
                                    <input type="date" name="date_debut" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Date fin stage</label>
                                    <input type="date" name="date_fin" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Rapport de stage</label>
                                    <input type="file" name="rapport_file" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Attestation de stage</label>
                                    <input type="file" name="attesstation_file" class="form-control">                                </div>
                            </div>
                            <br><br>
                            <div class="col-md-12">
                                <h5 class="titreDemande">Information d'étudiant </h5>
                            </div>
                            <div class="row" style="margin-top: 1.5%;">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="">Choisir la classe</label>
                                      <select id="classes" name="classe_id" data-style="btn btn-primary" required class="form-control">
                                          <option value="" selected disabled>Selectionner Classe</option>
                                          @foreach ($cls as $key => $cl)
                                              <option value="{{ $key }}"> {{ $cl }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Choisir l'étudiant</label>
                                    <select name="student_id" id="student" data-style="btn btn-primary" required class="form-control">

                                    </select>
                                </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        // when section dropdown changes
        $('#classes').change(function() {
    
            var studentID = $(this).val();
    
            if (studentID) {
    
                $.ajax({
                    type: "GET",
                    url: "{{ url('getStudent') }}?classe_id=" + studentID,
                    success: function(res) {
    
                        if (res) {
    
                            $("#student").empty();
                            $("#student").append('<option selected disabled>Selectionner Etudiant</option>');
                            $.each(res, function(key, value) {
                                $("#student").append('<option value="' + key + '">' + value + '</option>');
                            });
    
                        } else {
    
                            $("#student").empty();
                        }
                    }
                });
            } else {
    
                $("#student").empty();
            }
        });
    
      </script>
    
@endsection