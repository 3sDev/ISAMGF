@extends('adminlayoutscolarite.layout')
@section('title', 'Notes Etudiants')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Afficher emploi des examens</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('notes') }}">Liste des notes pour les Groupes</a></li>
          <li class="breadcrumb-item active">Afficher emploi des examens</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<style>
.emploiTemps{
    width: 100%;
    height: 50%;
    border: 1px solid #ccc;
    transition: transform .2s; /* Animation */
    margin: 0 auto;
}
</style>
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
                        <a href="{{ url('notes') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($emplois as $emploiElement)

                        <form action="{{ url('update-note/'.$emploiElement->id) }}" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <!-- Box Comment -->
                              <div class="card card-widget">
                                <div class="card-header">
                                  <div class="user-block">
                                    <img class="img-circle" src={{ asset('https://image.pngaaa.com/400/1342400-middle.png') }} alt="User Image">
                                    <span class="username"><a href="{{ URL('profile.show') }}">{{ $emploiElement->classe->abbreviation }}</a></span>
                                    <span class="description">{{ $emploiElement->classe->classeName }}</span>
                                  </div>
                                  <!-- /.user-block -->
                                  <div class="card-tools">
                                    <span class="float-right text-muted"><a href="{{ url('edit-emploiExamenStudent/'.$emploiElement->id) }}" class="btn btn-primary float-right"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a></span>
                                  </div>
                                  <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">   
                                  <center><h2>{{ $emploiElement->titre }}</h2></center>
                                  <iframe
                                  src={{ asset($upload.'/notes/'.$emploiElement->fichier)}}
                                  width="100%"
                                  height="678">
                                  </iframe>
                                </div>
                                <div class="card-footer">
                                  <div class="row" style="text-align: center;">
                                    <div class="col-md-3">
                                      <i class="fa fa-school" aria-hidden="true"></i><span class="nav-text-details"> {{ $emploiElement->annee }}</span>
                                    </div>
                                    <div class="col-md-3">
                                      <i class="fa fa-star" aria-hidden="true"></i><span class="nav-text-details">Semestre {{ $emploiElement->semestre }}</span>
                                    </div>
                                    <div class="col-md-3">
                                      <i class="fa fa-info-circle" aria-hidden="true"></i><span class="nav-text-details">&nbsp; {{ $emploiElement->type }} </span>
                                    </div>
                                    <div class="col-md-3">
                                      @if ($emploiElement->session == null)
                                        <span class="nav-text-details"></span>
                                      @else
                                        <i class="fa fa-folder" aria-hidden="true"></i><span class="nav-text-details">&nbsp;Session {{ $emploiElement->session }} </span>
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
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    
@endsection