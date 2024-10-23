@extends('adminlayoutscolarite.layout')
@section('title', 'Liste des étudiants')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Liste des étudiants</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Liste des étudiants</li>
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
                    <h5>Liste des étudiants
                        <a href="{{ url('dashboards') }}" class="btn btn-danger float-right">Retour</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="container" style="margin-top: 10px;">
                        <div class="row">
                            
                            
                            <div class="col-lg-1"></div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <b>Choisir la classe</b>
                                    <select name="classe_id" class="form-control" required>
                                        {{-- <option value="" selected disabled>Selectionner Classes</option> --}}
                                         
                                    </select>
                                </div>
                                <a href="{{ url('students/ ') }}" class="btn btn-link btn-info btn-just-icon like">Afficher</a>
                            </div>
                            <div class="col-lg-3"></div>


                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection