@extends('adminlayoutenseignant.layout')
@section('title', 'Créer une salle')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Créer une salle</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('salles') }}">Liste des salles</a></li>
                <li class="breadcrumb-item active">Créer une salle</li>
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

                    <form action="{{ url('salles') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cette donnée ?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Nom Local</label>
                                    <input type="text" name="fullName" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Emplacement</label>
                                    <input type="text" name="emplacement" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Type salle</label>
                                    <select name="type_salle" class="form-control" required>
                                        <option value="Salle cours">Salle cours</option>
                                        <option value="Labo">Labo</option>
                                        <option value="Salle TD">Salle TD</option>
                                        <option value="Amphi">Amphi</option>
                                        <option value="Atelier">Atelier</option>
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