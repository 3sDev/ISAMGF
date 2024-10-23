@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier une spécialité')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier une spécialité</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('specialites') }}">Liste des spécialités</a></li>
            <li class="breadcrumb-item active">Modifier une spécialité</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

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
                @foreach ($specialites as $spe)
                <form action="{{ url('update-specialite/'.$spe->id) }}" onsubmit="return confirm('Êtes-vous sûr de modifier cette spécialité?')" enctype="multipart/form-data">

                    @csrf
                    {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-8">
                                <label for="">Nom département</label>
                                <input type="text" name="label" value="{{ $spe->label }}" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Description</label>
                                <input type="text" name="description" value="{{ $spe->description }}" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success float-right">Modifier</button>
                        </div>
                    </form>    
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection