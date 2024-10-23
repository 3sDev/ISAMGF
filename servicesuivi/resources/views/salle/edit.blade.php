@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier salle')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier salle</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('salles') }}">Liste des salles</a></li>
                <li class="breadcrumb-item active">Modifier un salle</li>
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
                <div class="card-header">
                    <h4>
                        <a href="{{ url('salles') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                    @foreach ($salles as $salleElement)
                    <form action="{{ url('update-salle/'.$salleElement->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr modifier cette donnée ?')">

                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Nom Local</label>
                            <input type="text" name="fullName" value="{{ $salleElement->fullName }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Emplacement</label>
                            <input type="text" name="emplacement" value="{{ $salleElement->emplacement }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Type salle</label>
                            <select name="type_salle" class="form-control" required>
                                <option value="{{ $salleElement->type_salle }}">{{ $salleElement->type_salle }}</option>
                                <option value="" disabled>--------------------------</option>
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
                        <button type="submit" class="btn btn-success float-right">Modifier</button>
                    </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection