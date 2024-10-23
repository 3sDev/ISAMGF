@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier l\'absence')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier l'absence</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('attendances') }}">Liste des absences</a></li>
                <li class="breadcrumb-item active">Modifier l'absence</li>
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
                        <a href="{{ url('attendances') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                    @foreach ($attendances as $attendance)
                    <form action="{{ url('update-attendance/'.$attendance->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">

                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nom et prénom d'enseignant</label>
                                <input type="text" name="titre" value="{{ $attendance->teacher->nom.' '.$attendance->teacher->prenom }}" class="form-control" readonly required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Poste</label>
                                <input type="text" name="titre" value="{{ $attendance->teacher->poste }}" class="form-control" readonly required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Matière</label>
                                <input type="text" name="nom_matiere" value="{{ $attendance->nom_matiere }} ({{ $attendance->type_matiere }})" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="">Salle</label>
                                <input type="text" name="salle" value="{{ $attendance->salle }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="">Date d'absence</label>
                                <input type="date" name="attendance_date" value="{{ $attendance->attendance_date }}" class="form-control" required>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Jour</label>
                                <select name="jour" id="jour" class="form-control" required>
                                    <option value="{{ $attendance->jour }}">{{ $attendance->jour }}</option>
                                    <option value="" disabled>------------------------------------</option>
                                    <option value="Lundi">Lundi</option>
                                    <option value="Mardi">Mardi</option>
                                    <option value="Mercredi">Mercredi</option>
                                    <option value="Jeudi">Jeudi</option>
                                    <option value="Vendredi">Vendredi</option>
                                    <option value="Samedi">Samedi</option>
                                </select>   
                            </div>
                            <div class="col-md-4">
                                <label for="">Date début</label>
                                <input type="time" name="heure_debut" value="{{ $attendance->heure_debut }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Date fin</label>
                                <input type="time" name="heure_fin" value="{{ $attendance->heure_fin }}" class="form-control" required>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Justification</label>
                                <input type="test" name="justification" value="{{ $attendance->justification }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Date justification</label>
                                <input type="date" name="date_justification" value="{{ $attendance->date_justification }}" class="form-control">
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