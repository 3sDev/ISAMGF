@extends('adminlayoutenseignant.layout')
@section('title', 'Créer un nouveau rattrapage')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau avis</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('rattrapage') }}">Liste des rattrapages</a></li>
                <li class="breadcrumb-item active">Créer un nouveau rattrapage</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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

                    <form action="{{ url('rattrapages') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Choisir enseignant</label>
                                    <select name="teacher_id" class="form-control" required>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"> {{ $teacher->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Choisir matière</label>
                                    <select name="matiere_id" class="form-control" required>
                                        @foreach ($matieres as $matiere)
                                            <option value="{{ $matiere->id }}"> {{ $matiere->subjectLabel }} <b>({{ $matiere->description }})</b></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br><hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Choisir classe</label>
                                    <select name="classe_id" class="form-control" required>
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Choisir salle</label>
                                    <select name="salle_id" class="form-control" required>
                                        @foreach ($salles as $salle)
                                            <option value="{{ $salle->id }}"> {{ $salle->fullName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br><hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Date</label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Heure Début</label>
                                    <input type="time" step="1800" name="heure_debut" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Heure Fin</label>
                                    <input type="time" step="1800" name="heure_fin" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Durée</label>
                                    <input type="text" name="duree" class="form-control">
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