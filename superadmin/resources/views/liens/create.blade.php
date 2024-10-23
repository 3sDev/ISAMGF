@extends('adminlayoutenseignant.layout')
@section('title', 'Créer nouveau lien utile')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau lien utile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('liens') }}">Liste des liens utiles</a></li>
                <li class="breadcrumb-item active">Nouveau lien utile</li>
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

                    <form action="{{ url('liens') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Titre</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Description</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">URL</label>
                                    <input type="text" name="url" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Type</label>
                                    <input type="text" name="type" value="" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Catégorie</label>
                                    <select name="categorie" class="form-control" required>
                                        <option value="" selected>Saisir catégorie</option>
                                        <option value="" disabled>-----------------------</option>
                                        <option value="student">student</option>
                                        <option value="teacher">teacher</option>
                                        <option value="personnel">personnel</option>
                                        <option value="all">all</option>
                                    </select>
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