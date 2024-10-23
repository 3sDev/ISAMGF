@extends('adminlayoutscolarite.layout')
@section('title', 'Modifier notes')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier les notes des Groupes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('notes') }}">Liste des notes pour les Groupes</a></li>
            <li class="breadcrumb-item active">Modifier les notes</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

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
                        <a href="{{ url('notes') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($notes as $emploiElement)
                    <form action="{{ url('update-note/'.$emploiElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Titre</label>
                            <input type="text" value="{{ $emploiElement->titre }}" name="titre" class="form-control">
                        </div>
                    </div>
                    <br><br>
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
                            <input type="text" value="{{ $emploiElement->annee }}" name="annee" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Semestre</label>
                            <select name="semestre" id="semestre" class="form-control" required>
                                @if ($emploiElement->semestre == '1')
                                    <option value="{{ $emploiElement->semestre }}" selected>S1</option>
                                    <option value="2">S2</option>
                                @else
                                    <option value="{{ $emploiElement->semestre }}" selected>S2</option>
                                    <option value="1">S1</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                @if ($emploiElement->type == 'DS')
                                    <option value="{{ $emploiElement->type }}" selected>DS</option>
                                    <option value="Examen">Examen</option>
                                @else
                                    <option value="{{ $emploiElement->type }}" selected>Examen</option>
                                    <option value="DS">DS</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Session</label>
                            <select name="session" id="session" class="form-control">

                                @if ($emploiElement->session == 'Principale')
                                    <option value="{{ $emploiElement->session }}" selected>Principale</option>
                                    <option value="Controle">Controle</option>
                                    <option value="">Aucune session</option>
                                @elseif ($emploiElement->session == 'Controle')
                                    <option value="{{ $emploiElement->session }}" selected>Controle</option>
                                    <option value="Principale">Principale</option>
                                    <option value="">Aucune session</option>
                                @else
                                    <option value="" selected>Aucune session</option>
                                    <option value="Principale">Principale</option>
                                    <option value="Controle">Controle</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br><br>                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success text-center">Modifier</button>
                    </div>
                </form>
                <hr>
                <form action="{{ url('update-noteFile/'.$emploiElement->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                    @csrf
                    @method('PUT')
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <iframe
                                    src={{ asset($upload.'/notes/'.$emploiElement->fichier)}}
                                    width="80%"
                                    height="750">
                                </iframe>
                            </center>
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