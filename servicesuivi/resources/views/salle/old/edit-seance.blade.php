@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier une séance')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier une séance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('salledisponible') }}">Liste des salles</a></li>
                <li class="breadcrumb-item active">Modifier une séance</li>
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
                    {{-- <h4>
                        <a href="{{ url('avis') }}" class="btn btn-danger float-right">Retour</a>
                    </h4> --}}
                </div>

                <div class="card-body">
                  @foreach ($seances as $seance)
                    <h4>
                        <a href="{{ url('emploi-salle/'.$seance->salle_id) }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                  <form action="{{ url('update-seance-salle/'.$seance->id) }}" enctype="multipart/form-data">

                  @csrf
                  {{-- @method('PUT') --}}
                      <div class="row">
                        <div class="col-md-6">
                            <label for="">Jour</label>
                            <input type="text" name="jour" value="{{ $seance->jour }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Heure</label>
                            <input type="text" name="heure" value="{{ $seance->heure }}" class="form-control" required>
                        </div>
                      </div>
                      <br><hr><br>
                      <div class="row">
                          <div class="col-md-6">
                              <label for="">Nom séance</label>
                              <input type="text" name="seance" value="{{ $seance->seance }}" class="form-control" required>
                          </div>
                          <div class="col-md-6">
                              <label for="">Statut</label>
                              <input type="text" name="statut" value="{{ $seance->statut }}" class="form-control" readonly>
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