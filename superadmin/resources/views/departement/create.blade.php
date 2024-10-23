@extends('adminlayoutenseignant.layout')
@section('title', 'Créer un département')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Ajouter un département</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('departements') }}">Liste des départements</a></li>
                <li class="breadcrumb-item active">Créer un département</li>
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

                <form action="{{ url('departements') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter un département?')" enctype="multipart/form-data">

                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Nom département</label>
                            <input type="text" name="departmentLabel" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Description</label>
                            <input type="text" name="description" class="form-control" >
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    
@endsection