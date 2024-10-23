@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier notes')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier notes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('notes') }}">Notes Professionnelles</a></li>
            <li class="breadcrumb-item active">Modifier notes</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<style>
    .labelright {
        display: inline-block;
        text-align: right;
        float: right !important;
    }
</style>
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
                    <a href="{{ url('notes') }}" class="btn btn-danger float-right">Retour</a>
                </h4>
            </div>

            <div class="card-body">
                @foreach ($notes as $element)
                    <form action="{{ url('update-note/'.$element->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée ?')">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Séléctionner le personnel</label>
                            <select name="personnel_id" data-style="btn btn-primary" required class="form-control">
                                <option value="{{ $element->personnel_id }}" selected>{{ $element->personnel->nom.' '.$element->personnel->prenom }}</option>
                                <option value="" disabled>--------------------------------</option>
                                @foreach ($personnels as $perso)
                                    <option value="{{ $perso->id }}"> {{ $perso->nom.' '.$perso->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="labelright">السنة</label>
                            <input type="text" name="annee" value="{{ $element->annee }}" class="form-control">
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4" style="color: orangered">
                            <label class="labelright">العلاقات والمظهر</label>
                            <input type="number" name="note3" class="form-control" value="{{ $element->note3 }}" max="20" required>
                        </div>
                        <div class="col-md-4" style="color: orangered">
                            <label class="labelright">كيفية العمل</label>
                            <input type="number" name="note2" class="form-control" value="{{ $element->note2 }}" max="20" required>
                        </div>
                        <div class="col-md-4" style="color: orangered">
                            <label class="labelright">كمية العمل</label>
                            <input type="number" name="note1" class="form-control" value="{{ $element->note1 }}" max="20" required>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="labelright">ملاحظات</label>
                            <input type="text" name="observation" class="form-control" value="{{ $element->observation }}">
                        </div>
                        <div class="col-md-4" style="color: orangered">
                            <label class="labelright">المواظبة</label>
                            <input type="number" name="note5" class="form-control" value="{{ $element->note5 }}" max="20" required>
                        </div>
                        <div class="col-md-4" style="color: orangered">
                            <label class="labelright">المثابرة</label>
                            <input type="number" name="note4" class="form-control" value="{{ $element->note4 }}" max="20" required>
                        </div>
                    </div>
                    <br><br>
                    <center>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </center>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection