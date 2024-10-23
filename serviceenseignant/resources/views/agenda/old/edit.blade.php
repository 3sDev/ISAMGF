@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier Agenda')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier un agenda</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('agenda') }}">Mes notes</a></li>
                <li class="breadcrumb-item active">Modifier Agenda</li>
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
                        <a href="{{ url('agenda') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($agenda as $agd)
                  <form action="{{ url('update-agenda/'.$agd->id) }}" enctype="multipart/form-data">

                  @csrf
                  {{-- @method('PUT') --}}
                      <div class="row">
                          <div class="col-md-12">
                              <label for="">Titre</label>
                              <input type="text" name="titre" value="{{ $agd->titre }}" class="form-control" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <label for="">Description</label>
                              <textarea name="description" cols="30" rows="5" class="form-control">
                                {{ $agd->description }}
                              </textarea>
                          </div>
                      </div>
                      <br><hr><br>
                      <div class="row">
                        <div class="col-md-6">
                            <label for="">Date Rappel</label>
                            <input type="date" name="date_rappel" value="{{ $agd->date_rappel }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                        <label for="">Fichier</label>
                        <input type="file" name="fichier" class="form-control">
                        </div>
                      </div>
                      <br>

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