@extends('adminlayoutenseignant.layout')
@section('title', 'Créer emploi de temps')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Ajouter un emploi de temps</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('emploi') }}">Liste des emploi de temps</a></li>
                <li class="breadcrumb-item active">Nouveau Emploi</li>
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
                    <form action="{{ url('emploi-teacher-file') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet emploi ?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Enseignant</label>
                                <select name="teacher_id" id="teachers" class="form-control" required>
                                    <option value="" selected disabled>Selectionner Enseignant</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"> {{ $teacher->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="">Fichier (png/jpg)</label>
                                    <input type="file" name="fichier" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Année universitaire</label>
                                <input type="text" value="2022/2023" name="annee_universitaire" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Semestre</label>
                                <select name="semestre" id="teachers" class="form-control" required>
                                    <option value="" selected disabled>Selectionner semestre</option>
                                    <option value="1">S1</option>
                                    <option value="2">S2</option>
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