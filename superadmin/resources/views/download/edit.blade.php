@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier fichier')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier fichier</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('downloads') }}">Espace de téléchargements</a></li>
            <li class="breadcrumb-item active">Modifier Fichier</li>
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
                        <a href="{{ url('downloads') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($downloads as $downloadElement)
                  <form action="{{ url('update-download/'.$downloadElement->id) }}" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">

                  @csrf
                  {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Titre</label>
                            <input type="text" name="titre" value="{{ $downloadElement->titre }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" cols="30" rows="5" class="form-control">
                            {{ $downloadElement->description }}
                            </textarea>
                        </div>
                    </div>
                    <br><hr><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Catégorie</label>
                            <select name="categorie" class="form-control" data-size="8" data-style="btn btn-primary btn-round" required>
                                <option value="{{ $downloadElement->categorie }}">{{ $downloadElement->categorie }}</option>
                                <option value="" disabled>-----------------------------</option>
                                <option value="Etudiant">Etudiant</option>
                                <option value="Enseignant">Enseignant</option>
                                <option value="Personnel">Personnel</option>     
                            </select>
                        </div>
                    </div>

                    <br><br>
                    <div class="mb-3">
                    <center>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </center>
                    </div>
                  </form>

                  <br><hr><br>
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="{{ url('update-downloadFile/'.$downloadElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-input-steps" style="text-align: left;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            @if ($downloadElement->fichier)
                                                <iframe
                                                src={{ asset($upload.'/telechargements/'.$downloadElement->fichier)}}
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
                                        <input type="file" value="{{ $downloadElement->fichier }}" class="form-control" name="fichier" required>
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