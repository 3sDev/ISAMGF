@extends('adminlayoutenseignant.layout')
@section('title', 'Détails d\'offre')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails d'offre</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('offres') }}">Liste des offres</a></li>
          <li class="breadcrumb-item active">Détails d'offre</li>
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
                        <a href="{{ url('offres') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($emplois as $emploiElement)

                        <form action="{{ url('update-offres/'.$emploiElement->id) }}" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <!-- Box Comment -->
                              <div class="card card-widget">
                                <div class="card-header">
                                  <div class="user-block">
                                    <img class="img-circle" src={{ asset('https://www.pngmart.com/files/21/Admin-Profile-PNG-Clipart.png') }} alt="User Image">
                                    <span class="username"><a href="{{ URL('profile.show') }}">{{ Auth::user()->name }}</a></span>
                                    <span class="description">{{ Auth::user()->role }}</span>
                                  </div>
                                  <!-- /.user-block -->
                                  <div class="card-tools">
                                    <span class="float-right text-muted">{{ date('Y-m-d H:i', strtotime($emploiElement->created_at)) }}</span>
                                  </div>
                                  <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">                  
                                  <h3>{{ $emploiElement->titre }}</h3>
                                  <p>{{ $emploiElement->description }}</p>
                                  <button type="button" style="display:none;" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Fichier</button>
                                  <br>
                                  @if ($emploiElement->fichier !='')
                                  <hr>
                                  <p style="text-align: left;">
                                    <a class="btn btn-secondary" data-toggle="collapse" href="#collapseAttestation" role="button" aria-expanded="false" aria-controls="collapseExample">
                                      Offre d'emploi (PDF)
                                    </a>
                                  </p>
                                  <div class="collapse" id="collapseAttestation">
                                    <iframe
                                      src='https://smartschools.tn/university/public/upload/emploi/{{ $emploiElement->fichier }}'
                                      width="100%"
                                      height="678">
                                    </iframe>
                                  </div>
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
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    
@endsection