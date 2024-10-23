@extends('adminlayoutenseignant.layout')
@section('title', 'Créer nouveau mission')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau mission</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('missions') }}">Ordres et missions</a></li>
                <li class="breadcrumb-item active">Nouveau mission</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}

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

                    <form action="{{ url('missions') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet element?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Titre</label>
                                    <input type="text" name="titre" class="form-control" required>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Séléctionner le personnel</label>
                                    <select name="personnel_id" data-style="btn btn-primary" required class="form-control">
                                        <option value="" selected disabled>Selectionner personnel</option>
                                        @foreach ($personnels as $perso)
                                            <option value="{{ $perso->id }}"> {{ $perso->nom.' '.$perso->prenom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Fichier</label>
                                    <input type="file" name="fichier" class="form-control">
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Date début mission</label>
                                    <input type="date" name="date_debut" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Date fin mission</label>
                                    <input type="date" name="date_fin" value="" class="form-control" required>
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

    
@endsection