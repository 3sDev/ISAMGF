@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier Réclamation')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('reclamationPersonnel') }}">Liste des réclamations personnels</a></li>
                <li class="breadcrumb-item active">Détails réclamation</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
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
                    <h4>Détails réclamation personnel
                        <a href="{{ url('reclamationPersonnel') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($reclamationspersonnels as $reclam)

                        <form action="{{ url('update-reclamation/'.$reclam->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette réclamation ?')">

                        @csrf
                        {{-- @method('PUT') --}}

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="profile-img">
                                            <img class="img-circle" src={{ asset($upload.'/personnels/'.$reclam->personnel->profile_image) }} alt="personnel Image">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="titreDemande">Enseignant :</h5>
                                        <div class="profile-head">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Matricule </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{{ $reclam->personnel->matricule }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Nom (FR) </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{{ $reclam->personnel->prenom.' '.$reclam->personnel->nom }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Nom (Ar)</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{{ $reclam->personnel->prenom_ar.' '.$reclam->personnel->nom_ar }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Email </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{{$reclam->personnel->email}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Tél </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{{$reclam->personnel->tel1_personnel}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="border-left: 1px solid #ccc">
                                        <div class="tab-content profile-tab" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <h5 class="titreDemande">Reclamation : 
                                                    @if ($reclam->post_image)
                                                    <a href="{{ asset($upload.'/reclamationsPersonnels/'.$reclam->post_image) }}" target="_blank">
                                                        <img class="rotation" src="{{ asset('dist/img/fichier.png') }}" width="30px" height="30px" alt="" style="float: right; margin-top: -.5%;">
                                                    </a>
                                                    @endif
                                                </h5>
                                            
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Description </label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p>{{ $reclam->description }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Date de création</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p>{{ date('Y-m-d / H:i', strtotime($reclam->created_at)) }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Date d'éxecution </label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p>{{ date('Y-m-d / H:i', strtotime($reclam->updated_at)) }}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Réponse </label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea name="reponse" class="form-control" cols="40" rows="2" readonly>{{ $reclam->reponse }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top:2.5%;">
                                                    <div class="col-md-3">
                                                        <label>Statut </label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p>{{ $reclam->statut }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    
@endsection