@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier une matière')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier une matière</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('matieres') }}">Liste des matières</a></li>
            <li class="breadcrumb-item active">Modifier une matière</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

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
                    @foreach ($matieres as $matiereElement)
                    <form action="{{ url('update-matiere/'.$matiereElement->id) }}" onsubmit="return confirm('Êtes-vous sûr d\'ajouter une matière?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="">Nom matière</label>
                                    <input type="text" name="subjectLabel" value="{{ $matiereElement->subjectLabel }}" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Type matière</label>
                                    <select name="description" id="" class="form-control" required>
                                        <option value="{{ $matiereElement->description }}">{{ $matiereElement->description }}</option>
                                        <option value="" disabled>-----------------------</option>
										<option value="Cours">Cours</option>
                                      	<option value="1/2 Cours">1/2 Cours</option>
                                      	<option value="TP/TD">TP/TD</option>
                                        <option value="TD">TD</option>
                                        <option value="TP">TP</option>
                                        <option value="½ TP">½ TP</option>
                                        <option value="½ TD">½ TD</option>
                                        <option value="Cours Intégré">Cours Intégré</option>
                                    </select>
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Volume horaire</label>
                                    <input type="text" name="volume" value="{{ $matiereElement->volume }}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nombre d’élimination</label>
                                    <input type="number" name="nbr_eliminatoire" value="{{ $matiereElement->nbr_eliminatoire }}" class="form-control">
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