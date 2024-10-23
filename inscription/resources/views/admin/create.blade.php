@extends('adminlayoutenseignant.layout')
@section('title', 'Créer nouveau administrateur')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau administrateur</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('liens') }}">Liste des administrateurs</a></li>
                <li class="breadcrumb-item active">Nouveau administrateur</li>
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

                    <form action="{{ url('admins') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Nom et prénom</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Rôle</label>
                                    <select name="role" data-style="btn btn-primary btn-round" class="form-control" required>
                                        <option value="Service scolarité">Service scolarité</option>
                                        <option value="Service enseignants">Service enseignants</option>
                                        <option value="Service Personnels">Service Personnels</option>
                                        <option value="Service stages">Service stages</option>
                                        <option value="Service examens">Service examens</option>
                                        <option value="Chef de département">Chef de département</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Mot de passe</label>
                                    <input type="text" name="password" value="" class="form-control" required>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Photo de profil</label>
                                    <input type="file" name="profile_photo_path" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Statut de compte</label>
                                    <select name="lockout_time" data-style="btn btn-primary btn-round" class="form-control" required>
                                        <option value="1">Activé</option>
                                        <option value="0">Désactivé</option>
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