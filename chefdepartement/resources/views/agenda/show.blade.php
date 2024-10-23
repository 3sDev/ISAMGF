@extends('adminlayoutenseignant.layout')
@section('title', 'Détails Agenda')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails Agenda</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('agenda') }}">Mes notes</a></li>
          <li class="breadcrumb-item active">Détails Agenda</li>
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
                        <a href="{{ url('agenda') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($agenda as $agd)

                        <form action="{{ url('update-agenda/'.$agd->id) }}" enctype="multipart/form-data">

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
                                    {{ date('Y-m-d H:i', strtotime($agd->created_at)) }}
                                  </div>
                                  <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">                 
                                  <h3>{{ $agd->titre }}</h3>
                                  <p>{{ $agd->description }}</p>
                                  <button type="button" class="btn btn-default btn-sm"><a href="{{ asset($upload.'/agenda/'.$agd->fichier) }}" target="_blank"><i class="fas fa-share"></i> Fichier</a></button>
                                  <span class="float-right text-muted badge badge-warning">Date Rappel: {{ $agd->date_rappel }}</span>
                                </div>
                              </div>
                              <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-2"></div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <br>
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    
@endsection