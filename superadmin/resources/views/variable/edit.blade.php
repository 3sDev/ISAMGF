@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier variable')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier variables</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Modifier les variables</li>
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

                <div class="card-body">
                  @foreach ($variable as $var)
                  <form action="{{ url('update-variable') }}" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">

                  @csrf
                  {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Nom directeur (ar)</label>
                            <input type="text" name="directeur_ar" value="{{ $var->directeur_ar }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Nom directeur (fr)</label>
                            <input type="text" name="directeur_fr" value="{{ $var->directeur_fr }}" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Nom secrétaire générale (ar)</label>
                            <input type="text" name="secretaire_ar" value="{{ $var->secretaire_ar }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Nom secrétaire générale (fr)</label>
                            <input type="text" name="secretaire_fr" value="{{ $var->secretaire_fr }}" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Adresse (ar)</label>
                            <input type="text" name="adresse_ar" value="{{ $var->adresse_ar }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Adresse (fr)</label>
                            <input type="text" name="adresse_fr" value="{{ $var->adresse_fr }}" class="form-control" required>
                        </div>
                    </div>
                    <br>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success float-right">Modifier</button>
                    </div>
                </form>
                <br><hr><br>

                <form action="{{ url('update-signDirecteur') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                    @csrf
                    @method('PUT')
                    <div class="form-input-steps" style="text-align: left;">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label style="float: left;">Signature Directeur</label>
                                <input type="file" value="{{ $var->signature_directeur }}" class="form-control" name="signature_directeur" required><br>
                                <button type="submit" class="btn btn-warning">Modifier fichier</button>
                            </div>
                            <div class="form-group col-md-6">
                                <center>
                                    <img src={{ asset($upload.'/variables/'.$var->signature_directeur) }} style="width:200px !important; height: 160px;">
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
                <br><hr><br>
                <form action="{{ url('update-signSecretaire') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                    @csrf
                    @method('PUT')
                    <div class="form-input-steps" style="text-align: left;">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label style="float: left;">Signature Secretaire Général</label>
                                <input type="file" value="{{ $var->signature_secretaire }}" class="form-control" name="signature_secretaire" required><br>
                                <button type="submit" class="btn btn-warning">Modifier fichier</button>
                            </div>
                            <div class="form-group col-md-6">
                                <center>
                                    <img src={{ asset($upload.'/variables/'.$var->signature_secretaire) }} style="width:200px !important; height: 160px;">
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
                <br><hr><br>
                <form action="{{ url('update-logoVariable') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                    @csrf
                    @method('PUT')
                    <div class="form-input-steps" style="text-align: left;">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label style="float: left;">Logo</label>
                                <input type="file" value="{{ $var->logo }}" class="form-control" name="logo" required><br>
                                <button type="submit" class="btn btn-warning">Modifier fichier</button>
                            </div>
                            <div class="form-group col-md-6">
                                <center>
                                    <img src={{ asset($upload.'/variables/'.$var->logo) }} style="width:160px !important; height: 160px;">
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection