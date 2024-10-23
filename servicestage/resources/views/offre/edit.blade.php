@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier offre')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier un offre</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('offres') }}">Liste des offres</a></li>
            <li class="breadcrumb-item active">Modifier un offre</li>
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
                        <a href="{{ url('offres') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($emplois as $emploiElement)
                  <form action="{{ url('update-offres/'.$emploiElement->id) }}" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">

                  @csrf
                  {{-- @method('PUT') --}}
                      <div class="row">
                          <div class="col-md-12">
                              <label for="">Titre</label>
                              <input type="text" name="titre" value="{{ $emploiElement->titre }}" class="form-control" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <label for="">Description</label>
                              <textarea name="description" cols="30" rows="5" class="form-control">
                                {{ $emploiElement->description }}
                              </textarea>
                          </div>
                      </div>
                      <br><hr><br>
                      <div class="row">
                          <div class="col-md-12">
                              <label for="">Nom société</label>
                              <input type="text" name="nom_societe" value="{{ $emploiElement->nom_societe }}" class="form-control">
                          </div>
                          <div class="col-md-12">
                              <label for="">Info société</label>
                              <textarea name="info_societe" cols="30" rows="5" class="form-control">
                                {{ $emploiElement->info_societe }}
                              </textarea>
                            </div>
                      </div>

                      <br><br>
                      <div class="mb-3">
                        <center>
                            <button type="submit" class="btn btn-success">Modifier</button>
                        </center>
                      </div>
                  </form>

                  <br><hr><br>
                  <div class="row">
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                        <form action="{{ url('update-offreFile/'.$emploiElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-input-steps" style="text-align: left;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            @if ($emploiElement->fichier)
                                                <iframe
                                                src={{ asset($upload.'/offre_emploi/files/'.$emploiElement->fichier)}}
                                                width="100%"
                                                height="400">
                                                </iframe>   
                                            @else
                                            <img src="/upload/notfound.png" alt="" style="width:300px !important; height: 240px;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Fichier (PDF)</label>
                                        <input type="file" value="{{ $emploiElement->fichier }}" class="form-control" name="fichier" required>
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