@extends('adminlayoutenseignant.layout')
@section('title', 'Créer nouveau club')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau club</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('clubStudents') }}">Liste des clubs</a></li>
                <li class="breadcrumb-item active">Nouveau club</li>
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

                    <form action="{{ url('clubStudents') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet element?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Nom Club en français</label>
                                    <input type="text" name="nom_fr" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nom Club en arabe</label>
                                    <input type="text" name="nom_ar" class="form-control" required>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Description</label>
                                    <textarea name="description" cols="30" rows="3" class="form-control" ></textarea>
                                </div>
                            </div>
                            <br><hr><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Chef du club</label>
                                    <input type="text" name="chef" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Membre 1</label>
                                    <input type="text" name="membre_1" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Membre 2</label>
                                    <input type="text" name="membre_2" class="form-control">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Membre 3</label>
                                    <input type="text" name="membre_3" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Membre 4</label>
                                    <input type="text" name="membre_4" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Membre 5</label>
                                    <input type="text" name="membre_5" class="form-control">
                                </div>
                            </div>
                            <br><hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Etat du club</label>
                                    <select name="statut" class="form-control" id="">
                                        <option value="">Choisir statut</option>
                                        <option value="Activé">Activé</option>
                                        <option value="Désactivé">Désactivé</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Logo</label>
                                    <input type="file" name="logo" class="form-control">                               
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