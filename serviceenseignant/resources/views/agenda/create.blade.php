@extends('adminlayoutenseignant.layout')
@section('title', 'Créer note')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau note</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('agenda') }}">Mes note</a></li>
                <li class="breadcrumb-item active">Nouveau note</li>
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
                <form action="{{ url('agenda') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cette donnée?')" enctype="multipart/form-data">
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
                            <input type="datetime-local" name="date_rappel" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Fichier (PDF)</label>
                            <input type="file" name="fichier" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-right">ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection