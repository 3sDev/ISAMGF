@extends('adminlayoutenseignant.layout')
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
                @foreach ($rattrapages as $rattrapage)
                    {{-- @foreach ($rattrapages as $rattElement) --}}
                    <form action="{{ url('update-rattrapage/'.$rattrapage->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">
                    {{-- <form action="{{ url('update-rattrapage/'.$rattElement->id) }}" enctype="multipart/form-data"> --}}
                    
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Choisir enseignant</label>
                            <select name="teacher_id" class="form-control" required>
                               
                                <option value="{{ $rattrapage->teacher->id }}"> {{ $rattrapage->teacher->full_name }}</option>
                                <option value="" @disabled(true)>--------------------------------------</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"> {{ $teacher->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Choisir matière</label>
                            <select name="matiere_id" class="form-control" required>
                                <option value="{{ $rattrapage->matieres->id }}"> {{ $rattrapage->matieres->subjectLabel }} <b>({{ $rattrapage->matieres->description }})</b></option>
                                <option value="" @disabled(true)>--------------------------------------</option>
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
                                <option value="{{ $rattrapage->classes->id }}"> {{ $rattrapage->classes->abbreviation }}</b></option>
                                <option value="" @disabled(true)>--------------------------------------</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Choisir salle</label>
                            <select name="salle_id" class="form-control" required>
                                <option value="{{ $rattrapage->salles->id }}"> {{ $rattrapage->salles->fullName }}</b></option>
                                <option value="" @disabled(true)>--------------------------------------</option>
                                @foreach ($salles as $salle)
                                    <option value="{{ $salle->id }}"> {{ $salle->fullName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Date</label>
                            <input type="date" name="date" value="{{ $rattrapage->date }}" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="">Heure Début</label>
                            <input type="time" step="1800" name="heure_debut" value="{{ $rattrapage->heure_debut }}" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="">Heure Fin</label>
                            <input type="time" step="1800" name="heure_fin" value="{{ $rattrapage->heure_fin }}" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="">Durée</label>
                            <input type="text" name="duree" value="{{ $rattrapage->duree }}" class="form-control">
                        </div>
                    </div>
                    <br><br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success float-right">Modifier</button>
                    </div>
                   
                  </form>
                  @endforeach
                  {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>

@endsection