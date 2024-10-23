@extends('adminlayoutscolarite.layout')
@section('title', 'Créer emploi des examens')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Ajouter un emploi des examens</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('emploi') }}">Liste des emploi des examens/Groupes</a></li>
                <li class="breadcrumb-item active">Nouveau emploi des examens</li>
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
                    <form action="{{ url('emploi-examen-student') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet emploi?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Classe(Groupe)</label>
                                <select name="classe_id" id="classes" class="form-control" required>
                                    <option value="" selected disabled>Selectionner Classe</option>
                                    @foreach ($classes as $classe)
                                        <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="">Fichier (png/jpg)</label>
                                    <input type="file" name="fichier" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <br><hr>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Année universitaire</label>
                                <input type="text" value="2022/2023" name="annee_universitaire" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">Semestre</label>
                                <select name="semestre" id="semestre" class="form-control" required>
                                    <option value="" selected disabled>Selectionner semestre</option>
                                    <option value="1">S1</option>
                                    <option value="2">S2</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="" selected disabled>Selectionner type</option>
                                    <option value="DS">DS</option>
                                    <option value="Examen">Examen</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Session</label>
                                <select name="session" id="session" class="form-control">
                                    <option value="" selected disabled>Selectionner session</option>
                                    <option value="Principale">Principale</option>
                                    <option value="Controle">Controle</option>
                                </select>
                            </div>
                        </div>
                        <br><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <input type="text" name="description" class="form-control">
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