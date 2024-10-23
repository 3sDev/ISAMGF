@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier formation')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier formation</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('formations') }}">Liste des formations</a></li>
            <li class="breadcrumb-item active">Modifier formation</li>
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
                    <a href="{{ url('formations') }}" class="btn btn-danger float-right">Retour</a>
                </h4>
            </div>

            <div class="card-body">
                @foreach ($formations as $element)
                    <form action="{{ url('update-formation/'.$element->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée ?')">
                    @csrf
                    {{-- @method('PUT') --}} 
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Nom formation</label>
                            <input type="text" name="nom_formation" value="{{ $element->nom_formation }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Structure formation</label>
                            <input type="text" name="structure" value="{{ $element->structure }}" class="form-control" required>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Séléctionner le personnel</label>
                            <select name="personnel_id" data-style="btn btn-primary" required class="form-control">
                                <option value="{{ $element->personnel_id }}" selected>{{ $element->personnel->nom.' '.$element->personnel->prenom }}</option>
                                <option value="" disabled>-------------------------------------</option>
                                @foreach ($personnels as $perso)
                                    <option value="{{ $perso->id }}"> {{ $perso->nom.' '.$perso->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Description</label>
                            <input type="text" name="description" value="{{ $element->description }}" class="form-control">
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Lieu</label>
                            <input type="text" name="lieu" value="{{ $element->lieu }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Date début formation</label>
                            <input type="date" name="date_debut" value="{{ $element->date_debut }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Date fin formation</label>
                            <input type="date" name="date_fin" value="{{ $element->date_fin }}" value="" class="form-control">
                        </div>
                    </div>
                    <br><br>
                    <center>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </center>
                    </form>

                    <br><hr><br>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form action="{{ url('update-formationFile/'.$element->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-input-steps" style="text-align: left;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <a href="{{ asset($upload.'/personnels/formations/'.$element->attestation) }}" target="_blank">
                                                    <img src={{ asset($upload.'/personnels/formations/'.$element->attestation) }} style="width:350px !important; height: 240px;">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Attestation de formation</label>
                                            <input type="file" value="{{ $element->attestation }}" id="" class="form-control" name="attestation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3" class="text-left">
                                        <button type="submit" class="btn btn-warning">Modifier Attestation</button>
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