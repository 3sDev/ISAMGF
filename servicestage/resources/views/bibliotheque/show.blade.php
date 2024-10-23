@extends('adminlayoutenseignant.layout')
@section('title', 'Détails de livre')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails de livre</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('bibliotheques') }}">Liste des livres</a></li>
          <li class="breadcrumb-item active">Détails de livre</li>
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
                        <a href="{{ url('bibliotheques') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($books as $bookElement)

                        <form action="{{ url('update-bibliotheque/'.$bookElement->id) }}" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <!-- Box Comment -->
                              <div class="card card-widget">
                                <div class="card-header">
                                  <div class="user-block">
                                    <img class="img-circle" src={{ asset('dist/img/admin.png') }} alt="Admin Image">
                                    <span class="username"><a href="{{ URL('profile.show') }}">{{ Auth::user()->name }}</a></span>
                                    <span class="description">{{ Auth::user()->role }}</span>
                                  </div>
                                  <!-- /.user-block -->
                                  <div class="card-tools">
                                    <span class="float-right text-muted">{{ date('Y-m-d H:i', strtotime($bookElement->created_at)) }}</span>
                                  </div>
                                  <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  @if ($bookElement->image)
                                    <img src={{ asset($upload.'/library/cover/'.$bookElement->image) }} class="img-fluid" >
                                  @endif
                  
                                  <h3>{{ $bookElement->titre }}</h3>
                                  <p>{{ $bookElement->description }}</p>
                                  <div class="row" style="text-align: center;">
                                    <div class="col-md-8" style="text-align: left;">
                                      <i class="fa fa-address-book" aria-hidden="true"><span> Auteur: </span></i>
                                      <span class="nav-text-details"> {{ $bookElement->auteur }}</span>
                                    </div>
                                    <div class="col-md-4" style="text-align: left;">
                                      <i class="fa fa-bookmark" aria-hidden="true"><span> Catégorie: </span></i>
                                      <span class="nav-text-details"> {{ $bookElement->category }}</span>
                                    </div>
                                  </div>
                                  @if ($bookElement->fichier)
                                    <hr>
                                    <p style="text-align: center;">
                                      <a class="btn btn-secondary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Le livre (PDF)
                                      </a>
                                    </p>
                                    <div class="collapse" id="collapseExample">
                                      <iframe src={{ asset($upload.'/library/book/'.$bookElement->fichier) }}
                                        width="100%"
                                        height="678">
                                      </iframe>
                                    </div>
                                  @endif


                                  <button type="button" style="display:none;" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Fichier</button>
                                </div>
                                <div class="card-footer">
                                  <div class="row" style="text-align: center;">
                                    <div class="col-md-3">
                                      <i class="fa fa-flag" aria-hidden="true"></i><span class="nav-text-details"> {{ $bookElement->langue }}</span>
                                    </div>
                                    <div class="col-md-3">
                                      <i class="fa fa-file" aria-hidden="true"></i><span class="nav-text-details"> {{ $bookElement->nbrPage }} pages</span>
                                    </div>
                                    <div class="col-md-3">
                                      <i class="fa fa-star" aria-hidden="true"></i><span class="nav-text-details"> {{ $bookElement->rating }}/5</span>
                                    </div>
                                    <div class="col-md-3">
                                      <i class="fa fa-eye" aria-hidden="true"></i><span class="nav-text-details">&nbsp; {{ $bookElement->views }} vue(s)</span>
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