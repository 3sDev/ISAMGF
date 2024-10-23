@extends('adminlayoutenseignant.layout')
@section('title', 'Créer un nouveau événement')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau événement</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('events') }}">Liste des événements</a></li>
                <li class="breadcrumb-item active">Nouveau événement</li>
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

                    <form action="{{ url('events') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet element?')" enctype="multipart/form-data">

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
                                    <textarea name="description" cols="30" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                            <br><hr><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Date</label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Adresse</label>
                                    <input type="text" name="adresse" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="form-control" required>                                
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