@extends('adminlayoutenseignant.layout')
@section('title', 'Détails ordre et mission')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails ordre & mission</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('missions') }}">Ordres et missions</a></li>
          <li class="breadcrumb-item active">Détails ordre et mission</li>
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
                        <a href="{{ url('missions') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($missions as $missionElement)

                        <form action="{{ url('update-missions/'.$missionElement->id) }}" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <!-- Box Comment -->
                              <div class="card card-widget">
                                <div class="card-header">
                                    <span class="username">Date création de la mission</span>
                                    <span class="float-right text-muted">{{ date('Y-m-d H:i', strtotime($missionElement->created_at)) }}</span>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">   
                                  <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Nom et prénom (FR)</label>
                                        <h6>{{ $missionElement->personnel->nom.' '.$missionElement->personnel->prenom }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nom et prénom (AR)</label>
                                        <h6>{{ $missionElement->personnel->nom_ar.' '.$missionElement->personnel->prenom_ar }}</h6>
                                    </div>
                                  </div><br><br>
                                  <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Email</label>
                                        <h6>{{ $missionElement->personnel->email }}</h6>
                                    </div>
                                    @if ($missionElement->profile_personnel != "null")
                                      <div class="col-md-6">
                                        <label for="">Téléphone</label>
                                        <h6>{{ $missionElement->profile_personnel->phone }}</h6>
                                      </div>
                                    @endif
                                  </div>

                                <br><hr><br>
                              
                                <div class="row">
                                  <div class="col-md-12">
                                      <label for="">Titre de la mission</label>
                                      <h6>{{ $missionElement->titre.' '.$missionElement->personnel->prenom }}</h6>
                                  </div>
                                </div><br><br>
                                <div class="row">
                                  <div class="col-md-6">
                                      <label for="">Date début</label>
                                      <h6>{{ $missionElement->date_debut }}</h6>
                                  </div>
                                  <div class="col-md-6">
                                      <label for="">Date fin</label>
                                      <h6>{{ $missionElement->date_fin }}</h6>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    
                                    <br>
                                    @if ($missionElement->fichier != 'Null')
                                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Fichier</button>
                                    @endif
                                  </div>
                                </div>

                                </div>
                              </div>
                              <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-2"></div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <br><br>
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    
@endsection