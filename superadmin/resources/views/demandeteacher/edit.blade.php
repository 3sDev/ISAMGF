@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier Demande')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Gestion de la demande pour l'enseignant</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('demandeteacher') }}">Demandes Enseignants</a></li>
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
                    <a href="{{ url('demandeteacher') }}" class="btn btn-danger float-right">Retour</a>
                </h5>
            </div>

            <div class="card-body">

                @foreach ($demandeteachers as $demand)

                    <form action="{{ url('update-demandeteacher/'.$demand->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette demande?')">

                    @csrf
                    {{-- @method('PUT') --}}

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="profile-img">
                                        <img class="img-circle" src={{ asset($upload.'/teachers/'.$demand->teacher->profile_image) }} alt="Teacher Image">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="titreDemande">Enseignant :</h5>
                                    <div class="profile-head">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>CIN </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{$demand->teacher->cin}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Nom et prénom (FR) </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->teacher->prenom.' '.$demand->teacher->nom }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Nom et prénom (AR) </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->teacher->prenom_ar.' '.$demand->teacher->nom_ar }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Email </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{$demand->teacher->email}}</p>
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

                                                        {{-- @if ($demand->statut=='Envoyée')
                                                            <option value="{{ $demand->statut }}">{{ $demand->statut }}</option>
                                                            <option value="En cours">En cours</option>
                                                            <option value="Traitée">Traitée</option>
                                                        @endif --}}
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="mb-3">
                            <br>
                            <button type="submit" class="btn btn-success float-right">Modifier</button>
                        </div>
                    </form>

                @endforeach

            </div>
        </div>
    </div>
</div>
    
@endsection