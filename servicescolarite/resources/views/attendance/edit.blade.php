@extends('adminlayoutscolarite.layout')
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
                <li class="breadcrumb-item"><a href="{{ url('justifications') }}">Liste des absences</a></li>
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
                        <a href="{{ url('justifications') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                    @foreach ($attendances as $attendance)
                    <form action="{{ url('update-attendance/'.$attendance->id) }}" enctype="multipart/form-data">
  
                    @csrf
                    {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Nom et prénom</label>
                                <input type="text" name="titre" value="{{ $attendance->student->nom.' '.$attendance->student->prenom }}" class="form-control" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Classe</label>
                                <input type="text" name="titre" value="{{ $attendance->classe->abbreviation }}" class="form-control" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Matière</label>
                                <input type="text" name="text" value="{{ $attendance->matiere->subjectLabel }}" class="form-control" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Date d'absence</label>
                                <input type="text" name="text" value="{{ $attendance->attendance_date }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="">Heure début séance</label>
                                <input type="text" name="text" value="{{ $attendance->attendance_seance_debut }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="">Heure fin séance</label>
                                <input type="text" name="text" value="{{ $attendance->attendance_seance_fin }}" class="form-control" readonly>
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