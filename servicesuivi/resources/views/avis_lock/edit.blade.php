@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier avis')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier un avis</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('avis') }}">Liste des avis</a></li>
            <li class="breadcrumb-item active">Modifier un avis</li>
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
                        <a href="{{ url('avis') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($avis as $avisElement)
                  <form action="{{ url('update-avis/'.$avisElement->id) }}" enctype="multipart/form-data">

                  @csrf
                  {{-- @method('PUT') --}}
                      <div class="row">
                          <div class="col-md-12">
                              <label for="">Titre</label>
                              <input type="text" name="titre" value="{{ $avisElement->titre }}" class="form-control" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <label for="">Description</label>
                              <textarea name="description" cols="30" rows="5" class="form-control">
                                {{ $avisElement->description }}
                              </textarea>
                          </div>
                      </div>
                      <br><hr><br>
                      <div class="row">
                          <div class="col-md-6">
                              <label for="">Date</label>
                              <input type="date" name="date" value="{{ $avisElement->date }}" class="form-control">
                          </div>
                          <div class="col-md-4" style="display:none">
                              <label for="">Adresse</label>
                              <input type="text" name="adresse" value="{{ $avisElement->adresse }}" class="form-control">
                          </div>
                          <div class="col-md-6">
                              <label for="">Type</label>
                              <select name="type" class="form-control" required>

                                @if($avisElement->type =='Scolarité')         
                                  <option value="{{ $avisElement->type}}" selected>{{ $avisElement->type }}</option>
                                  <option value="Enseignant">Enseignant</option>
                                  <option value="Personnel">Personnel</option>
                                @endif
                                @if($avisElement->type =='Enseignant')         
                                  <option value="{{ $avisElement->type }}" selected>{{ $avisElement->type }}</option>
                                  <option value="Scolarité">Scolarité</option>
                                  <option value="Personnel">Personnel</option>
                                @endif
                                @if($avisElement->type =='Personnel')  
                                  <option value="{{ $avisElement->type }}" selected>{{ $avisElement->type }}</option>
                                  <option value="Scolarité">Scolarité</option>        
                                  <option value="Enseignant">Enseignant</option>        
                                @endif

                              </select>
                          </div>
                      </div>
                      <br><hr><br>
                      <div class="row">
                        <div class="col-md-6">
                            <label for="">Views</label>
                            <input type="text" name="views" value="{{ $avisElement->views }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Rating</label>
                            <input type="text" name="rating" value="{{ $avisElement->rating }}" class="form-control" readonly>
                        </div>
                      </div>

                      <br><br>
                      <div class="mb-12">
                        <center>
                            <button type="submit" class="btn btn-success">Modifier</button>
                        </center><br>
                      </div>
                  </form>
                  <br><hr><br><br>
                  <div class="row">
                    <div class="col-md-5">
                        <form action="{{ url('update-photoAvis/'.$avisElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-input-steps" style="text-align: left;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <img src={{ asset($upload.'/avis/images/'.$avisElement->image) }} style="width:350px !important; height: 240px;">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image d'avis</label>
                                        <input type="file" value="{{ $avisElement->image }}" id="" class="form-control" name="image" required>
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
                        <form action="{{ url('update-photoPdf/'.$avisElement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-input-steps" style="text-align: left;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            @if ($avisElement->fichier)
                                                <iframe
                                                src={{ asset($upload.'/avis/files/'.$avisElement->fichier)}}
                                                width="100%"
                                                height="400">
                                                </iframe>   
                                            @else
                                            <img src="/upload/notfound.png" alt="" style="width:300px !important; height: 240px;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>fichier d'avis (PDF)</label>
                                        <input type="file" value="{{ $avisElement->fichier }}" id="" class="form-control" name="fichier">
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