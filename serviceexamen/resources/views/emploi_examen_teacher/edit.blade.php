@extends('adminlayoutscolarite.layout')
@section('title', 'Modifier emploi de surveillance')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier emploi de surveillance</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('emploiSurveillances') }}">Liste des emploi des surveillances</a></li>
            <li class="breadcrumb-item active">Modifier emploi de surveillance</li>
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
                        <a href="{{ url('emploi') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($emplois as $emploiElement)
                    <form action="{{ url('update-emploiExamenTeacher/'.$emploiElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Classe(Groupe)</label>
                            <select name="teacher_id" id="teacher_id" class="form-control" required>
                                <option value="{{ $emploiElement->teacher_id }}" selected> {{ $emploiElement->teacher->full_name }}</option>
                                <option value="" disabled>-----------------------</option>
                                @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"> {{ $teacher->full_name }}</option>
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
                                @else
                                    <option value="{{ $emploiElement->session }}" selected>Controle</option>
                                    <option value="Principale">Principale</option>
                                    <option value="">Aucune session</option>
                                @endif
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
                <form action="{{ url('update-emploiSurveillanceTeacher/'.$emploiElement->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                    @csrf
                    @method('PUT')
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <img class="emploiTemps" src={{ asset($upload.'/emploi-examen-teacher/'.$emploiElement->fichier) }} alt="Emploi"/>
                            <br><br>
                            <label for="">Fichier (png/jpg)</label>
                            <input type="file" value="" name="fichier" class="form-control" required>
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