@extends('adminlayoutenseignant.layout')
@section('title', 'Créer nouveau avis')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau avis</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('avis') }}">Liste des avis</a></li>
                <li class="breadcrumb-item active">Nouveau avis</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

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

                    <form action="{{ url('avis') }}" method="POST" enctype="multipart/form-data">

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
                                    <textarea name="description" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <br><hr><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Date</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                                <div class="col-md-6" style="display: none;">
                                    <label for="">Adresse</label>
                                    <input type="text" name="adresse" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Type</label>
                                    <input type="text" name="type" value="Enseignant" class="form-control" readonly>
                                </div>
                            </div>
                            <br><hr><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Image d'avis</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Fichier (PDF)</label>
                                    <input type="file" name="fichier" class="form-control">
                                </div>
                            </div>
                            <br><br>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary float-right">ajouter</button>
                            </div>
                       
                        </form>

                </div>
            </div>
        </div>
    </div>

    
@endsection