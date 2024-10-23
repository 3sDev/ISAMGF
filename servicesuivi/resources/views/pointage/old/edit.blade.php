@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier pointage')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier pointage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('pointages') }}">Liste des pointages</a></li>
                <li class="breadcrumb-item active">Modifier pointage</li>
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
                <div class="card-header">
                    <h4>
                        <a href="{{ url('justifications') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                    @foreach ($pointages as $pointage)
                    <form action="{{ url('update-pointage/'.$pointage->id) }}" onsubmit="return confirm('Êtes-vous sûr modifier cette donnée ?')">
  
                    @csrf
                    {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Enseignant</label>
                                <input type="text" name="nom" value="{{ $pointage->teacher->nom.' '.$pointage->teacher->prenom }}" class="form-control" readonly required>
                            </div>
                            <div class="col-md-5">
                                <label for="">Matière</label>
                                <input type="text" name="nom_matiere" value="{{ $pointage->nom_matiere }}" class="form-control" readonly required>
                            </div>
                            <div class="col-md-3">
                                <label for="">Type Matière</label>
                                <input type="text" name="type_matiere" value="{{ $pointage->type_matiere }}" class="form-control" readonly required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Jour</label>
                                <select name="jour" id="jour" class="form-control" data-dependent="salle" required>
                                    <option value="{{ $pointage->jour }}">{{ $pointage->jour }}</option>
                                    <option value="" disabled>------------------------------</option>     
                                    <option value="Lundi">Lundi</option>
                                    <option value="Mardi">Mardi</option>
                                    <option value="Mercredi">Mercredi</option>
                                    <option value="Jeudi">Jeudi</option>
                                    <option value="Vendredi">Vendredi</option>
                                    <option value="Samedi">Samedi</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Heure Début</label>
                                <select id="heure_debut" name="heure_debut" class="form-control" required>
                                    <option value="{{ $pointage->heure_debut }}">{{ $pointage->heure_debut }}</option>
                                    <option value="" disabled>------------------------------</option>
                                    <option value="08:30">08:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:05">10:05</option>
                                    <option value="11:35">11:35</option>
                                    <option value="11:40">11:40</option>
                                    <option value="13:10">13:10</option>
                                    <option value="13:15">13:15</option>
                                    <option value="14:45">14:45</option>
                                    <option value="14:50">14:50</option>
                                    <option value="16:20">16:20</option>
                                    <option value="16:25">16:25</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Heure Fin</label>
                                <select id="heure_fin" name="heure_fin" class="form-control" required>
                                    <option value="{{ $pointage->heure_fin }}">{{ $pointage->heure_fin }}</option>
                                    <option value="" disabled>------------------------------</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:05">10:05</option>
                                    <option value="11:35">11:35</option>
                                    <option value="11:40">11:40</option>
                                    <option value="13:10">13:10</option>
                                    <option value="13:15">13:15</option>
                                    <option value="14:45">14:45</option>
                                    <option value="14:50">14:50</option>
                                    <option value="16:20">16:20</option>
                                    <option value="16:25">16:25</option>
                                    <option value="17:55">17:55</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Salle</label>
                                <select name="salle" id="salle" class="form-control" required>
                                    <option value="{{ $pointage->salle }}">{{ $pointage->salle }}</option>
                                    <option value="" disabled>------------------------------</option>
                                    @foreach ($salles as $salle)
                                        <option value="{{ $salle->fullName }}"> {{ $salle->fullName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="teacher_id" value="{{ $pointage->teacher_id }}" class="form-control" readonly required>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="seance_id" value="{{ $pointage->seance_id }}" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="lat" value="{{ $pointage->lat }}" class="form-control" readonly required>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="lng" value="{{ $pointage->lng }}" class="form-control" readonly required>
                            </div>
                        </div>
                        <br><br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success float-right">Modifier</button>
                        </div>
                    </form>
                    @endforeach
                  </div>
            </div>
        </div>
    </div>

@endsection