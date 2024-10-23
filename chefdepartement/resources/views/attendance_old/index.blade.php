@extends('adminlayoutscolarite.layout')
@section('title', 'Classe étudiants')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Classe étudiants</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Classe étudiants</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<link rel="stylesheet" href="{{ URL::asset('css/ajaxSelect.css') }}" />
<style>
    .btn-link{color: white;}
    .btn-link:hover{color: white;}
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
                <div class="card-header">
                    <h5>Choisir une classe pour gérer les absences
                        <a href="{{ url('dashboards') }}" class="btn btn-danger float-right">Retour</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="container" style="margin-top: 10px;">
                        <form action="{{ url('show-attendances') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col-lg-1"></div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <b>Liste des classes</b>
                                        <select name="classe_id" class="form-control" required>
                                            @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}"> {{ $classe->classeName }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <b>Choisir une date</b>
                                        <input type="date" name="dateattendance" class="form-control" required>                                    
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-3"></div>
                                
                            </div>

                            <div class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-primary btn-info btn-just-icon like text-center">Afficher</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $('select option').each(
        function () {
            $(this).attr("title", $(this).text());
    });
</script>
@endsection