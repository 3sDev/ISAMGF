@extends('adminlayoutscolarite.layout')
@section('title', 'Modifier Demande')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Gestion la demande du l'étudiant</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('demandestudent') }}">Demandes Etudiants</a></li>
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
    color: orangered;
    text-align: left;
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
                <h4>Modifier la demande du l'étudiant
                    <a href="{{ url('demandestudent') }}" class="btn btn-danger float-right">Retour</a>
                </h4>
            </div>

            <div class="card-body">

                @foreach ($demandestudents as $demand)

                    <form action="{{ url('update-demandestudent/'.$demand->id) }}" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')" enctype="multipart/form-data">

                    @csrf
                    {{-- @method('PUT') --}}

                            <div class="row">
                                <div class="col-md-2" style="margin-top:2%;">
                                    <div class="text-center">
                                        <img src={{ asset($upload.'/students/'.$demand->student->profile_image) }} style="width:150px !important; height: 160px;" class="profile-user-img img-fluid img-circle imgPhoto">
                                    </div>
                                </div>
                                <div class="col-md-5" style="border-left: 1px solid #ccc">
                                    <h5 class="titreDemande">Etudiant </h5>
                                    <div class="profile-head">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>CIN </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->student->cin }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Nom et prénom </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->student->prenom.' '.$demand->student->nom }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Classe</label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->classe->abbreviation }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Numéro Tél </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->student->tel1_etudiant }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5" style="border-left: 1px solid #ccc">
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <h5 class="titreDemande">Demande </h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Type </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>{{ $demand->sous_type }} / {{ $demand->type }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Langue</label>
                                                </div>
                                                <div class="col-md-8">
                                                    @if ($demand->langue=='ar')
                                                        <p>Arabe</p>
                                                    @endif
                                                    @if ($demand->langue=='fr')
                                                        <p>Français</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Date Création</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>{{ date('Y-m-d - H:i', strtotime($demand->created_at)) }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Date Exécution</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <p>{{ date('Y-m-d - H:i', strtotime($demand->updated_at)) }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Statut </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="statut" data-style="btn btn-primary btn-round" class="form-control" required>

                                                        @if ($demand->statut=='En cours')
                                                            <option value="{{ $demand->statut }}">{{ $demand->statut }}</option>
                                                            <option value="Traitée">Traitée</option>
                                                        @endif
                                                        @if ($demand->statut=='Traitée')
                                                            <option value="{{ $demand->statut }}">{{ $demand->statut }}</option>
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
                            <br><br>
                            {{-- <a href="{{ url('students/'.$demand->student->id) }}" class="btn btn-link btn-dark btn-just-icon like float-right"><i class="nav-icon fas fa-user"></i></a> --}}
                            <a href="{{ url('show-demandestudent/'.$demand->id) }}" class="btn btn-link btn-info btn-just-icon edit float-right"  style="margin-right:1.4%;" target="_blank"><i class="nav-icon fas fa-eye"></i></a>
                            <button type="submit" class="btn btn-success float-right" style="margin-right:1.4%;">Modifier</button>
                        </div>
                    </form>

                @endforeach

            </div>
        </div>
    </div>
</div>
    
@endsection