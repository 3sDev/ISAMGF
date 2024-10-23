@extends('adminlayoutscolarite.layout')
@section('title', 'Emploi des examens')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Emploi des examens</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('emploi') }}">Liste des emploi des examens/Groupes</a></li>
          <li class="breadcrumb-item active">Emploi des examens</li>
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
                        <a href="{{ url('emploi') }}" class="btn btn-danger float-right">Retour</a>
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
                                    <img class="img-circle" src={{ asset('https://png.pngtree.com/element_our/20200702/ourlarge/pngtree-flat-cute-baby-calendar-icon-image_2292637.jpg') }} alt="User Image">
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
                                    <img class="emploiTemps" src={{ asset($upload.'/emploi-examen-student/'.$emploiElement->fichier) }} alt="Emploi"/>
                                  <p>{{ $emploiElement->description }}</p>
                                  <button type="button" style="display:none;" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Fichier</button>
                                </div>
                                <div class="card-footer">
                                  <div class="row" style="text-align: center;">
                                    <div class="col-md-3">
                                      <i class="fa fa-school" aria-hidden="true"></i><span class="nav-text-details"> {{ $emploiElement->annee_universitaire }}</span>
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