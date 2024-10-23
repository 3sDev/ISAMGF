@extends('adminlayoutenseignant.layout')
@section('title', 'Détails avis')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails Avis</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('avis') }}">Liste des avis</a></li>
          <li class="breadcrumb-item active">Détails Avis</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
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
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <!-- Box Comment -->
                              <div class="card card-widget">
                                <div class="card-header">
                                  <div class="user-block">
                                    <img class="img-circle" src={{ asset('upload/administrateur.png') }} alt="User Image">
                                    <span class="username"><a href="{{ URL('profile.show') }}">{{ Auth::user()->name }}</a></span>
                                    <span class="description">{{ Auth::user()->role }}</span>
                                  </div>
                                  <!-- /.user-block -->
                                  <div class="card-tools">
                                    <span class="float-right text-muted">{{ $avisElement->date }}</span>
                                  </div>
                                  <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <img src={{ asset($upload.'/avis/images/'.$avisElement->image) }} class="img-fluid" >
                  
                                  <h3>{{ $avisElement->titre }}</h3>
                                  <p>{{ $avisElement->description }}</p>
                                  <button type="button" style="display:none;" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Fichier</button>
                                  <br>
                                  @if ($avisElement->fichier)
                                  <iframe
                                  src={{ asset($upload.'/avis/files/'.$avisElement->fichier)}}
                                  width="100%"
                                  height="678">
                                  </iframe>
                                  @endif
                                  
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