@extends('adminlayoutscolarite.layout')
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
                          <div class="col-md-4">
                              <label for="">Date</label>
                              <input type="date" name="date" value="{{ $avisElement->date }}" class="form-control">
                          </div>
                          <div class="col-md-4">
                              <label for="">Adresse</label>
                              <input type="text" name="adresse" value="{{ $avisElement->adresse }}" class="form-control">
                          </div>
                          <div class="col-md-4">
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
                      <br><hr><br>
                      <div class="row">
                          <div class="col-md-6">
                              <label for="">Image d'avis</label>
                              <input type="file" name="image" class="form-control">
                          </div>
                          <div class="col-md-6">
                              <label for="">Fichier (PDF)</label>
                              <input type="file" name="fichier" class="form-control">
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