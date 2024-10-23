@extends('adminlayoutenseignant.layout')
@section('title', 'Détails localisation')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails localisation</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('maps') }}">Liste des localisations</a></li>
          <li class="breadcrumb-item active">Détails localisation</li>
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
                        <a href="{{ url('maps') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($maps as $maptElement)

                        <form action="{{ url('update-maps/'.$maptElement->id) }}" enctype="multipart/form-data">

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
                                    {{-- <span class="float-right text-muted">{{ $maptElement->date }}</span> --}}
                                  </div>
                                  <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <img src={{ asset($upload.'/locations/'.$maptElement->image) }} class="img-fluid" >
                  
                                  <h3>{{ $maptElement->titre }}</h3>
                                  <p>{{ $maptElement->description }}</p>
                                  <button type="button" style="display:none;" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Fichier</button>
                                
                                  <div class="row modelMap" style="margin-top: 1%">
                                    <div class="col-md-6">
                                        <div id="map" style="height:220px; width: 100%;" class="my-3"></div>
                                    </div>
                                    <div class="col-6" style="margin-top: 10%">
                                      <i class="fa fa-map-marker"></i><b>Laltitude:</b> <span class="nav-text-details"> {{ $maptElement->lat }}</span><br><br>
                                      <i class="fa fa-map-marker"></i><b>Longtitude:</b> <span class="nav-text-details"> {{ $maptElement->lng }}</span>
                                    </div>
                                  </div>

                                </div>
                                <div class="card-footer">
                                  <div class="row" style="text-align: center;">
                                    <div class="col-md-3">
                                      <i class="fa fa-file" aria-hidden="true"></i><span class="nav-text-details"> {{ $maptElement->categorie }}</span>
                                    </div>
                                    <div class="col-md-3">
                                      <i class="fa fa-star" aria-hidden="true"></i><span class="nav-text-details"> {{ $maptElement->rating }}/5</span>
                                    </div>
                                    <div class="col-md-3">
                                      <i class="fa fa-eye" aria-hidden="true"></i><span class="nav-text-details">&nbsp; {{ $maptElement->views }} vue(s)</span>
                                    </div>
                                    <div class="col-md-3">
                                      <i class="fa fa-flag" aria-hidden="true"></i><span class="nav-text-details"> {{ date('Y-m-d | H:i', strtotime($maptElement->created_at)) }}</span>
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

    <script>
      let map;
      function initMap() {
          map = new google.maps.Map(document.getElementById("map"), {
              center: { lat: {{ $maptElement->lat }}, lng:  {{ $maptElement->lng }} },
              zoom: 15,
              scrollwheel: true
          });
          const uluru = { lat: {{ $maptElement->lat }}, lng: {{ $maptElement->lng }} };
          let marker = new google.maps.Marker({
              position: uluru,
              map: map,
              draggable: true
          });
          google.maps.event.addListener(marker,'position_changed',
              function (){
                  let lat = marker.position.lat({{ $maptElement->lat }})
                  let lng = marker.position.lng({{ $maptElement->lng }})
                  $('#lat').val(lat)
                  $('#lng').val(lng)
              })
          google.maps.event.addListener(map,'click',
          function (event){
              pos = event.latLng
              marker.setPosition(pos)
          })
      }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
          type="text/javascript">
  </script>
@endsection