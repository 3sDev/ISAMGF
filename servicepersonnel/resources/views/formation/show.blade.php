@extends('adminlayoutenseignant.layout')
@section('title', 'Détails formation')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails formation</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('formations') }}">Liste des formations</a></li>
          <li class="breadcrumb-item active">Détails formation</li>
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
                        <a href="{{ url('formations') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($formations as $element)

                        <form action="{{ url('#') }}" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <!-- Box Comment -->
                              <div class="card card-widget">
                                <div class="card-header">
                                    <span class="username">Date création de la formation</span>
                                    <span class="float-right text-muted">{{ date('Y-m-d H:i', strtotime($element->created_at)) }}</span>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">   
                                  <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Nom et prénom :</label>
                                        <h6>{{ $element->personnel->nom.' '.$element->personnel->prenom }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Poste Personnel :</label>
                                        <h6>{{ $element->personnel->poste }}</h6>
                                    </div>
                                  </div><br>
                                  <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Email :</label>
                                        <h6>{{ $element->personnel->email }}</h6>
                                    </div>
                                    @if ($element->personnel->tel1_personnel != "null")
                                      <div class="col-md-6">
                                        <label for="">Téléphone :</label>
                                        <h6>{{ $element->personnel->tel1_personnel }}</h6>
                                      </div>
                                    @endif
                                  </div>

                                <hr>
                              
                                <div class="row">
                                  <div class="col-md-12">
                                      <label for="">Nom de la formation :</label>
                                      <h6>{{ $element->nom_formation }}</h6>
                                  </div>
                                </div><br>
                                <div class="row">
                                  <div class="col-md-4">
                                    <label for="">Lieu :</label>
                                    <h6>{{ $element->lieu }}</h6>
                                </div>
                                  <div class="col-md-4">
                                      <label for="">Date début :</label>
                                      <h6>{{ $element->date_debut }}</h6>
                                  </div>
                                  <div class="col-md-4">
                                      <label for="">Date fin :</label>
                                      <h6>{{ $element->date_fin }}</h6>
                                  </div>
                                </div><br>
                                <div class="row">
                                  <div class="col-md-6">
                                      <label for="">Description :</label>
                                      <h6>{{ $element->description }}</h6>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="">Structure :</label>
                                    <h6>{{ $element->structure }}</h6>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <hr>
                                    <center>
                                      @if ($element->attestation != 'Null')
                                        <div class="filtr-item">
                                          <h5>Attestation</h5>
                                          <a href={{ asset($upload.'/personnels/formations/'.$element->attestation) }} target="_blank" data-toggle="lightbox" data-title="sample 4 - red">
                                          <img style="border-radius: 10px;" src={{ asset($upload.'/personnels/formations/'.$element->attestation) }} width="450px" heigth="350px"/>
                                          </a>
                                        </div>  
                                      @endif
                                    </center>
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