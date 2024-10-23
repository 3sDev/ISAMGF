@extends('adminlayoutenseignant.layout')
@section('title', 'Créer notes')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Créer notes</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('notes') }}">Notes Professionnelles</a></li>
            <li class="breadcrumb-item active">Créer notes</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<style>
.labelright {
    display: inline-block;
    text-align: right;
    float: right !important;
}
</style>
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

                    <form action="{{ url('notes') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet element?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Séléctionner le personnel</label>
                                <select name="personnel_id" data-style="btn btn-primary" required class="form-control" required>
                                    <option value="" selected disabled>Selectionner personnel</option>
                                    @foreach ($personnels as $perso)
                                        <option value="{{ $perso->id }}"> {{ $perso->nom.' '.$perso->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labelright">السنة</label>
                                <input type="text" name="annee" value="2023" class="form-control">
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4" style="color: orangered">
                                <label class="labelright">العلاقات والمظهر</label>
                                <input type="number" name="note3" class="form-control" max="20" required>
                            </div>
                            <div class="col-md-4" style="color: orangered">
                                <label class="labelright">كيفية العمل</label>
                                <input type="number" name="note2" class="form-control" max="20" required>
                            </div>
                            <div class="col-md-4" style="color: orangered">
                                <label class="labelright">كمية العمل</label>
                                <input type="number" name="note1" class="form-control" max="20" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="labelright">ملاحظات</label>
                                <input type="text" name="observation" class="form-control">
                            </div>
                            <div class="col-md-4" style="color: orangered">
                                <label class="labelright">المواظبة</label>
                                <input type="number" name="note5" class="form-control" max="20" required>
                            </div>
                            <div class="col-md-4" style="color: orangered">
                                <label class="labelright">المثابرة</label>
                                <input type="number" name="note4" class="form-control" max="20" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-right">إضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
@endsection