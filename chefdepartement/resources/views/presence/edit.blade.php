@extends('adminlayoutenseignant.layout')
@section('title', 'Présence Enseignant')
@section('contentPage')
 
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Présences enseignant</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('presences') }}">Gestion des enseignants (Présences)</a></li>
                <li class="breadcrumb-item active">Présence enseignant</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            @foreach ($attendances as $presence)

            <div class="card">
                <div class="card-header">
                    <h4>Modifier une présence 
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('update-attendance/'.$presence->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Date d'absence</label>
                                <input type="date" name="attendance_date" value="{{ $presence->attendance_date }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Justification</label>
                                <input type="text" name="justification" value="{{ $presence->justification }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Date Justification</label>
                                <input type="date" name="date_justification" value="{{ $presence->date_justification }}" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <br>
                            <center>                       
                                <button type="submit" class="btn btn-success float-right">Modifier</button>&nbsp;&nbsp;
                                &nbsp;<a href="{{ url('saisir-presence/'.$presence->teacher_id) }}" class="btn btn-danger float-right">Retour</a>
                                
                            </center>
                        </div>

                    </form>
                </div>
            </div>
            
            @endforeach



        </div>
    </div>

    
@endsection