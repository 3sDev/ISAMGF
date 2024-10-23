@extends('adminlayoutscolarite.layout')
@section('title', 'Modifier rattrapage')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier rattrapage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('rattrapages') }}">Liste des rattrapages</a></li>
                <li class="breadcrumb-item active">Modifier rattrapage</li>
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
                        <a href="{{ url('rattrapage') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  {{-- @foreach ($rattrapages as $rattElement) --}}
                  <form action="{{ url('update-rattrapage/') }}" enctype="multipart/form-data">
                    {{-- <form action="{{ url('update-rattrapage/'.$rattElement->id) }}" enctype="multipart/form-data"> --}}

                  @csrf
                  {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Choisir enseignant</label>
                            <select name="teacher_id" class="form-control" required>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"> {{ $teacher->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Choisir matière</label>
                            <select name="matiere_id" class="form-control" required>
                                @foreach ($matieres as $matiere)
                                    <option value="{{ $matiere->id }}"> {{ $matiere->subjectLabel }} <b>({{ $matiere->description }})</b></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Choisir classe</label>
                            <select name="classe_id" class="form-control" required>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}"> {{ $classe->classeName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Choisir salle</label>
                            <select name="salle_id" class="form-control" required>
                                @foreach ($salles as $salle)
                                    <option value="{{ $salle->id }}"> {{ $salle->fullName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Heure</label>
                            <input type="time" name="heure" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Durée</label>
                            <input type="text" name="duree" class="form-control" required>
                        </div>
                    </div>
                    <br><br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                    </div>
                  </form>
                  {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>

@endsection