@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier Demande')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Gestion demande personnel</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('demandepersonnel') }}">Demandes Personnels</a></li>
            <li class="breadcrumb-item active">Traiter la demande</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.titreDemande{
    background-color: rgb(235, 235, 235);
    padding: 10px 22px;
    border-radius: 12px;
}

.profile-img img {
    width: 180px !important;
    height: 180px !important;
    margin-left: 10%;
    margin-top: 7%;
}
.rotation {
    animation: zoom-in-zoom-out 3s ease infinite;
}

@keyframes zoom-in-zoom-out {
  0% {
    transform: scale(1, 1);
  }
  50% {
    transform: scale(1.5, 1.5);
  }
  100% {
    transform: scale(1, 1);
  }
}

.inline-block {
   display: inline-block;
   margin-top: 4%;
   margin-right: 4%;
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
                <h5>Demande Enseignant
                    <a href="{{ url('demandepersonnel') }}" class="btn btn-danger float-right">Retour</a>
                </h5>
            </div>

            <div class="card-body">

                @foreach ($demandepersonnels as $demand)

                    <form action="{{ url('update-demandepersonnel/'.$demand->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette demande?')">

                    @csrf
                    {{-- @method('PUT') --}}

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="profile-img">
                                        <img class="img-circle" src={{ asset($upload.'/personnels/'.$demand->personnel->profile_image) }} alt="Personnel Image">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="titreDemande">Personnel :</h5>
                                    <div class="profile-head">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>CIN </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{$demand->personnel->cin}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Nom et prénom (FR) </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->personnel->prenom.' '.$demand->personnel->nom }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Nom et prénom (AR) </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->personnel->prenom_ar.' '.$demand->personnel->nom_ar }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Email </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{$demand->personnel->email}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5" style="border-left: 1px solid #ccc">
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <h5 class="titreDemande">Demande :</h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Type :</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>{{ $demand->type }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Date de création</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>{{ date('Y-m-d / H:i', strtotime($demand->created_at)) }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Date d'éxecution :</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>{{ date('Y-m-d / H:i', strtotime($demand->updated_at)) }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Statut :</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="statut" data-style="btn btn-primary btn-round" class="form-control" required>

                                                        @if ($demand->statut=='En cours')
                                                            <option value="{{ $demand->statut }}">{{ $demand->statut }}</option>
                                                            {{-- <option value="Envoyée">Envoyée</option> --}}
                                                            <option value="Traitée">Traitée</option>
                                                        @endif
                                                        @if ($demand->statut=='Traitée')
                                                            <option value="{{ $demand->statut }}">{{ $demand->statut }}</option>
                                                            {{-- <option value="Envoyée">Envoyée</option> --}}
                                                            <option value="En cours">En cours</option>
                                                        @endif

                                                    </select>
                                                    <br>
                                                    <button type="submit" class="btn btn-success float-left">Modifier</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
  
                        </div>
                    </form>


                <form action="{{ url('show-demandepersonnel/'.$demand->id) }}" method="post" target="_blank">
                    @csrf
                    <div class="row">
                        @if ($demand->type == 'شهادة عمل')

                            <div class="col-md-3" style="left: 1%;">
                                <label for="">Afficher la demande</label>
                                <select id ="signatureChoix" name="signatureChoix" data-style="btn btn-primary btn-round" style="width: 100%;" class="form-control" required>
                                    <option value="" selected>Séléctionner</option>
                                    <option value="" disabled>---------------------</option>
                                    <option value="Directeur">Directeur</option>
                                    <option value="Secrétaire général">Secrétaire général</option>
                                </select>
                                <input type="hidden" id="idDemande" value="{{ $demand->id }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-info" style="margin-top: 9%;"><i class="nav-icon fas fa-eye"></i></button>
                                <br><br>
                            </div>
                    
                        @else

                        <div class="col-md-4">
                            <label for="">Afficher la demande</label>
                            <button type="submit" class="btn btn-info" style="margin-left: 3%;"><i class="nav-icon fas fa-eye"></i></button>
                            <br><br>
                        </div>

                        @endif
                        <div class="col-md-6">

                            <div id="banner">
                                @if ($demand->image_formation || $demand->file_rib || $demand->file_main_levee || $demand->file_domicialisation_salaire)
                                    <label for="">Pièce(s) jointe(s) de la demande :</label><br>
                                @endif
                                @if ($demand->image_formation)
                                    <div class="inline-block">
                                        <a href="{{ asset($upload.'/demandesPersonnels/formation/'.$demand->image_formation) }}" target="_blank">
                                            <center>
                                                <img class="rotation" src="{{ asset('dist/img/fichier.png') }}" width="30px" height="30px" alt=""><br>
                                                <span>Fichier Formation</span>
                                            </center>
                                        </a>
                                    </div>
                                @endif
                                @if ($demand->file_rib)
                                    <div class="inline-block">
                                        <a href="{{ asset($upload.'/demandesPersonnels/rib/'.$demand->file_rib) }}" target="_blank">
                                            <center>
                                                <img class="rotation" src="{{ asset('dist/img/fichier.png') }}" width="30px" height="30px" alt=""><br>
                                                <span>Fichier RIB</span>
                                            </center>
                                        </a>
                                    </div>
                                @endif
                                @if ($demand->file_main_levee)
                                    <div class="inline-block">
                                        <a href="{{ asset($upload.'/demandesPersonnels/mainLevee/'.$demand->file_main_levee) }}" target="_blank">
                                            <center>
                                                <img class="rotation" src="{{ asset('dist/img/fichier.png') }}" width="30px" height="30px" alt=""><br>
                                                <span>Fichier Main Levée</span>
                                            </center>
                                        </a>
                                    </div>
                                @endif
                                @if ($demand->file_domicialisation_salaire)
                                    <div class="inline-block">
                                        <a href="{{ asset($upload.'/demandesPersonnels/domicialisationSalaire/'.$demand->file_domicialisation_salaire) }}" target="_blank">
                                            <center>
                                                <img class="rotation" src="{{ asset('dist/img/fichier.png') }}" width="30px" height="30px" alt=""><br>
                                                <span>Fichier Domicialisation de salaire</span>
                                            </center>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <br><br>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- <script>
    // when date_fin dropdown changes
    $('#signatureChoix').change(function() {
        var signature = $("#signatureChoix").val();
        var idDemande = $("#idDemande").val();
        var linkDirec = "{{ url('show-demandepersonnel/'."+idDemande+".'?typeDemande=Directeur') }}";
        var linkSecre = "url('show-demandepersonnel/"+idDemande+"?typeDemande=Secrétaire général')";

        if (signature == "Directeur") {
            $("#myButton").empty();
            $("#myButton").append(`<a href=`+ linkDirec + ` class="btn btn-link btn-info btn-just-icon edit float-left" target="_blank" style="margin-left: 2%; margin-top: 30%;"><i class="nav-icon fas fa-eye"></i></a>`);
        } else {
            $("#myButton").empty();
            $("#myButton").append('<a href="{{ '+linkSecre+' }}" class="btn btn-link btn-info btn-just-icon edit float-left" target="_blank" style="margin-left: 2%; margin-top: 30%;"><i class="nav-icon fas fa-eye"></i></a>');
        }
    });
</script> --}}  
@endsection