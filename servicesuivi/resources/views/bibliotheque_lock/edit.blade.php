@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier le livre')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier le livre</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('bibliotheques') }}">Liste des livres</a></li>
            <li class="breadcrumb-item active">Modifier le livre</li>
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
                        <a href="{{ url('bibliotheques') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($books as $bookElement)
                    <form action="{{ url('update-bibliotheque/'.$bookElement->id) }}" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">

                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Titre</label>
                            <input type="text" name="titre" value="{{ $bookElement->titre }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" cols="30" rows="5" class="form-control">
                            {{ $bookElement->description }}
                            </textarea>
                        </div>
                    </div>
                    <br><hr><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Auteur</label>
                            <input type="text" name="auteur" value="{{ $bookElement->auteur }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Nombre des page</label>
                            <input type="text" name="nbrPage" value="{{ $bookElement->nbrPage }}" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-6">
                            <label for="">Catégorie de livre</label>
                            <div class="select">
                                <select name="category" class="form-control" data-style="btn btn-primary" required>
                                    <option value="{{ $bookElement->category }}">{{ $bookElement->category }}</option>
                                    <option value="" disabled>-----------------------------</option>
                                    <option value="Culture">Culture</option>
                                    <option value="Musique">Musique</option>
                                    <option value="Design">Design</option>
                                    <option value="Mécanique">Mécanique</option>
                                    <option value="Eléctronique">Eléctronique</option>
                                    <option value="Informatique">Informatique</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Langue</label>
                            <div class="select">
                                <select name="langue" class="form-control" data-style="btn btn-primary" required>
                                    <option value="{{ $bookElement->langue }}">{{ $bookElement->langue }}</option>
                                    <option value="" disabled>-----------------------------</option>
                                    <option value="Français">Français</option>
                                    <option value="Anglais">Anglais</option>
                                    <option value="Arabe">Arabe</option>
                                    <option value="Espagnol">Espagnol</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br><hr>
                    <div class="row">
                    <div class="col-md-6">
                        <label for="">Views</label>
                        <input type="text" name="views" value="{{ $bookElement->views }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="">Rating</label>
                        <input type="text" name="rating" value="{{ $bookElement->rating }}" class="form-control" readonly>
                    </div>
                    </div>
                    <br><br>
                    <center>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Modifier</button>
                        </div>
                    </center>
                  </form>

                  <br><hr><br>
                  <div class="row">
                    <div class="col-md-5">
                        <form action="{{ url('update-cover/'.$bookElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-input-steps" style="text-align: left;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <img src={{ asset($upload.'/library/cover/'.$bookElement->image) }} style="width:350px !important; height: 240px;">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image de livre</label>
                                        <input type="file" value="{{ $bookElement->image }}" class="form-control" name="image" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3" class="text-left">
                                    <button type="submit" class="btn btn-warning">Modifier Image</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <form action="{{ url('update-book/'.$bookElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-input-steps" style="text-align: left;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            @if ($bookElement->fichier)
                                                <iframe
                                                src={{ asset($upload.'/library/book/'.$bookElement->fichier)}}
                                                width="100%"
                                                height="400">
                                                </iframe>   
                                            @else
                                            <img src="/upload/notfound.png" alt="" style="width:300px !important; height: 240px;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Livre (PDF)</label>
                                        <input type="file" value="{{ $bookElement->fichier }}" class="form-control" name="fichier" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3" class="text-left">
                                    <button type="submit" class="btn btn-warning">Modifier Fichier</button>
                            </div>
                        </form>
                    </div>
                </div>   
                @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection