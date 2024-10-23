@extends('adminlayoutenseignant.layout')
@section('title', 'Ajouter un fichier de téléchargement')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Nouveau téléchargement</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('downloads') }}">Espace de téléchargements</a></li>
            <li class="breadcrumb-item active">Ajouter un fichier de téléchargement</li>
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

                <div class="card-body">

                    <form action="{{ url('downloads') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cette donnée?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Titre</label>
                                    <input type="text" name="titre" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Description</label>
                                    <textarea name="description" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Catégorie</label>
                                    <select name="categorie" class="form-control" data-size="8" data-style="btn btn-primary btn-round" required>
                                        <option value="">Choisir une catégorie</option>
                                        <option value="" disabled>-----------------------------</option>
                                        <option value="Etudiant">Etudiant</option>
                                        <option value="Enseignant">Enseignant</option>
                                        <option value="Personnel">Personnel</option>     
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Fichier</label>
                                    <input type="file" name="fichier" class="form-control" required>
                                </div>
                            </div>
                            <br><br>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>

    
@endsection