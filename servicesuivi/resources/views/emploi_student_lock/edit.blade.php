@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier emploi de temps')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier emploi de temps pour classe(Groupe)</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('emplois') }}">Liste des emploi de temps</a></li>
                <li class="breadcrumb-item active">Modifier emploi de temps</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<style>
    .emploiTemps{
        width: 100%;
        height: 70%;
        border: 1px solid #ccc;
    }
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
                    <h4>
                        <a href="{{ url('emplois') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($emplois as $emploiElement)
                    <form action="{{ url('update-emploiStudent/'.$emploiElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Classe(Groupe)</label>
                            <select name="classe_id" id="classes" class="form-control" required>
                                <option value="{{ $emploiElement->classe_id }}" selected> {{ $emploiElement->classe->abbreviation }}</option>
                                <option value="" disabled>-----------------------</option>
                                @foreach ($classes as $classe)
                                        <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Année universitaire</label>
                            <input type="text" value="{{ $emploiElement->annee_universitaire }}" name="annee_universitaire" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Semestre</label>
                            <select name="semestre" id="semestre" class="form-control" required>
                                @if ($emploiElement->semestre == '1')
                                    <option value="{{ $emploiElement->semestre }}" selected>S1</option>
                                @else
                                    <option value="{{ $emploiElement->semestre }}" selected>S2</option>
                                @endif
                                <option value="" disabled>-----------------------</option>
                                <option value="1">S1</option>
                                <option value="2">S2</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <input type="text" value="{{ $emploiElement->description }}" name="description" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success text-center">Modifier</button>
                    </div>
                </form>
                <hr>
                <form action="{{ url('update-photoEmploiStudent/'.$emploiElement->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                    @csrf
                    @method('PUT')
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <img class="emploiTemps" src={{ asset('https://smartschools.tn/university/public/upload/emploi-student-file/'.$emploiElement->fichier) }} alt="Emploi"/>
                            <br><br>
                            <label for="">Fichier (png/jpg)</label>
                            <input type="file" value="{{ $emploiElement->fichier }}" name="fichier" class="form-control">
                            <br>
                            <button type="submit" class="btn btn-warning float-left">Modifier emploi</button>
                        </div>
                    </div>
                </form>

                @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection