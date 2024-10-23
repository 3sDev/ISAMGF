@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier mission')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier mission</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('missions') }}">Ordres et missions</a></li>
            <li class="breadcrumb-item active">Modifier mission</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

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
                    <a href="{{ url('missions') }}" class="btn btn-danger float-right">Retour</a>
                </h4>
            </div>

            <div class="card-body">
                @foreach ($missions as $missionElement)
                    <form action="{{ url('update-missions/'.$missionElement->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée ?')">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="row">
                    <div class="col-md-12">
                        <label for="">Titre</label>
                        <input type="text" name="titre" value="{{ $missionElement->titre }}" class="form-control" required>
                    </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Séléctionner le personnel</label>
                            <select name="personnel_id" data-style="btn btn-primary" required class="form-control">
                                <option value="{{ $missionElement->personnel_id }}" selected>{{ $missionElement->personnel->nom.' '.$missionElement->personnel->prenom }}</option>
                                <option value="" disabled>-------------------------------------</option>
                                @foreach ($personnels as $perso)
                                    <option value="{{ $perso->id }}"> {{ $perso->nom.' '.$perso->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Date début mission</label>
                            <input type="date" name="date_debut" value="{{ $missionElement->date_debut }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Date fin mission</label>
                            <input type="date" name="date_fin" value="{{ $missionElement->date_fin }}" class="form-control">
                        </div>
                    </div><br>
                    <center>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </center>
                    </form>

                    <br><hr><br>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form action="{{ url('update-missionFile/'.$missionElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-input-steps" style="text-align: left;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                @if ($missionElement->fichier)
                                                    <iframe
                                                    src={{ asset($upload.'/missions/'.$missionElement->fichier)}}
                                                    width="100%"
                                                    height="400">
                                                    </iframe>   
                                                @else
                                                <img src="/upload/notfound.png" alt="" style="width:300px !important; height: 240px;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Fichier</label>
                                            <input type="file" value="{{ $missionElement->fichier }}" class="form-control" name="fichier" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3" class="text-left">
                                        <button type="submit" class="btn btn-warning">Modifier Fichier</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div> 
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection