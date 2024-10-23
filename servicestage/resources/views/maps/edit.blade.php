@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier localisation')
@section('contentPage')

<link rel='stylesheet' href='https://npmcdn.com/leaflet@0.7.7/dist/leaflet.css'>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier un localisation</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('maps') }}">Liste des localisations</a></li>
            <li class="breadcrumb-item active">Modifier une localisation</li>
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
                        <a href="{{ url('maps') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                  @foreach ($maps as $mapElement)

                  <form action="{{ url('update-maps/'.$mapElement->id) }}" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet element?')" enctype="multipart/form-data">

                    @csrf
                    {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Titre</label>
                                <input type="text" name="titre" value="{{ $mapElement->titre }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea name="description" cols="30" rows="5" class="form-control">
                                    {{ $mapElement->description }}
                                </textarea>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Catégorie</label>
                                <select name="categorie" class="form-control" data-size="8" data-style="btn btn-primary btn-round">
                                    <option value="{{ $mapElement->categorie }}">{{ $mapElement->categorie }}</option>
                                    <option value="" disabled>---------------------------------</option>
                                    <option value="Restaurants">Restaurants</option>
                                    <option value="Foyers et Locations">Foyers et Locations</option>   
                                    <option value="Centres Culturelles">Centres Culturelles</option> 
                                    <option value="Hopitaux et Urgences">Hopitaux et Urgences</option>    
                                    <option value="Moyennes de Transports">Moyennes de Transports</option>    
                                    <option value="Cafés et Salons de thé">Cafés et Salons de thé</option>    
                                    <option value="Services Universitaires">Services Universitaires</option>    
                                    <option value="Terrains et Salles de Sport">Terrains et Salles de Sport</option>    
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Rating</label>
                                <input type="text" name="rating" class="form-control" value="{{ $mapElement->rating }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="">Views</label>
                                <input type="text" name="views" class="form-control" value="{{ $mapElement->views }}" readonly>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="row" >
                            <div class="col-md-6">
                                <div id="MapLocation" style="height:350px; width: 100%;"></div>
                            </div>
                            <div class="col-md-6" style="margin-top: 7%">
                                <label for="">Laltitude</label>
                                <input id="Latitude" name="lat" class="form-control" value="{{ $mapElement->lat }}" required/>
                                {{-- <input type="text" class="form-control" placeholder="" name="lat" id="lat"> --}}
                                <label for="" style="margin-top: 3%">Longtitude</label>
                                <input id="Longitude" name="lng" class="form-control" value="{{ $mapElement->lng }}" required />
                                {{-- <input type="text" class="form-control" placeholder="" name="lng" id="lng"> --}}
                            </div>
                        </div>
                        
                        <br><br>
                        <div class="mb-3">
                            <center>
                                <button type="submit" class="btn btn-success">Modifier</button>
                            </center>
                        </div>
                    </form>
                    <br><hr><br>

                    <form action="{{ url('update-photoMap/'.$mapElement->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                        @csrf
                        @method('PUT')
                        <div class="form-input-steps" style="text-align: right;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center">
                                        <img src={{ asset($upload.'/loactions/'.$mapElement->image) }} style="width:350px !important; height: 260px;" class="profile-user-img img-fluid imgPhoto" >
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="labelright">Photo de location(Map)</label>
                                    <input type="file" value="{{ $mapElement->image }}" class="form-control" name="image" required><br>
                                    <button type="submit" class="btn btn-warning float-right">Modifier Photo</button>
                                </div>
                            </div>
                        </div>
                    </form>

                  @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
        // use below if you want to specify the path for leaflet's images
        //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

        var curLocation = [0, 0];
        // use below if you have a model
        // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [{{ $mapElement->lat }}, {{ $mapElement->lng }}];
        }

        var map = L.map('MapLocation').setView(curLocation, 15);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'true'
        });

        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
            draggable: 'true'
            }).bindPopup(position).update();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });

        $("#Latitude, #Longitude").change(function() {
            var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
            marker.setLatLng(position, {
            draggable: 'true'
            }).bindPopup(position).update();
            map.panTo(position);
        });

        map.addLayer(marker);
        })
    </script>
     <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
     <script src='https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js'></script>
@endsection