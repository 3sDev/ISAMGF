@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier actualité')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier actualité</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('news') }}">Liste des actualités</a></li>
            <li class="breadcrumb-item active">Modifier actualité</li>
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
                <div class="card-header">
                    <h4>
                        <a href="{{ url('news') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                    @foreach ($news as $newsElement)
                    <form action="{{ url('update-news/'.$newsElement->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">

                    @csrf
                    {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Titre</label>
                                <input type="text" name="titre" value="{{ $newsElement->titre }}" class="form-control" required>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea name="description" cols="30" rows="5" class="form-control">
                                {{ $newsElement->description }}
                                </textarea>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Date</label>
                                <input type="date" name="date" value="{{ $newsElement->date }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Adresse</label>
                                <input type="text" name="adresse" value="{{ $newsElement->adresse }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Lien</label>
                                <input type="text" name="link" value="{{ $newsElement->link }}" class="form-control">
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="row">
                        <div class="col-md-6">
                            <label for="">Views</label>
                            <input type="text" name="views" value="{{ $newsElement->views }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Rating</label>
                            <input type="text" name="rating" value="{{ $newsElement->rating }}" class="form-control" readonly>
                        </div>
                        </div>
                        <br><br>
                        <center>
                            <button type="submit" class="btn btn-success">Modifier</button>
                        </center>
                    </form>

                    <br><hr><br>

                    <form action="{{ url('update-photoNews/'.$newsElement->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                        @csrf
                        @method('PUT')
                        <div class="form-input-steps" style="text-align: right;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center">
                                        <img src={{ asset($upload.'/news/'.$newsElement->image) }} style="width:350px !important; height: 260px;" class="profile-user-img img-fluid imgPhoto" >
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="labelright">Photo d'actualité</label>
                                    <input type="file" value="{{ $newsElement->image }}" class="form-control" name="image" required><br>
                                    <button type="submit" class="btn btn-warning float-right">Modifier Photo</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection