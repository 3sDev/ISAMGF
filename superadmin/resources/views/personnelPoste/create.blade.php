@extends('adminlayoutenseignant.layout')
@section('title', 'Créer une poste personnel')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Ajouter une poste personnel</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('postePersonnels') }}">Postes personnels</a></li>
                <li class="breadcrumb-item active">Créer une poste personnel</li>
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

                    <form action="{{ url('postePersonnels') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter une matière?')" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PUT') --}}

                        @if ($_GET['category'] == 'categorie')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Catégorie(profession)</label>
                                    <input type="text" name="label_fr" class="form-control" required>
                                </div>
                                <div class="col-md-6" style="direction: rtl;" >
                                    <label style="float: right;">الخطة الوظيفية</label>
                                    <input type="text" name="label_ar" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="category" value="categorie" class="form-control">
                            </div>
                        @endif

                        @if ($_GET['category'] == 'grade')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Grade</label>
                                    <input type="text" name="label_fr" class="form-control" required>
                                </div>
                                <div class="col-md-6" style="direction: rtl;" >
                                    <label style="float: right;">الرتبة</label>
                                    <input type="text" name="label_ar" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="category" value="grade" class="form-control">
                            </div>
                        @endif

                        @if ($_GET['category'] == 'fonction')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Fonction</label>
                                    <input type="text" name="label_fr" class="form-control" required>
                                </div>
                                <div class="col-md-6" style="direction: rtl;" >
                                    <label style="float: right;"> الصنف</label>
                                    <input type="text" name="label_ar" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" name="category" value="fonction" class="form-control">
                            </div>
                        @endif

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