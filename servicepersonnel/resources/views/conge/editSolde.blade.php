@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier solde personnel')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier solde personnel</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('soldes') }}">Gestion des soldes</a></li>
            <li class="breadcrumb-item active">Modifier solde personnel</li>
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
                    <a href="{{ url('soldes') }}" class="btn btn-danger float-right">Retour</a>
                </h4>
            </div>

            <div class="card-body">
                @foreach ($soldes as $element)
                    <form action="{{ url('update-solde/'.$element->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée ?')">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Personnel</label>
                                    <input type="text" name="" value="{{ $element->personnel->nom.' '.$element->personnel->prenom }}" class="form-control" readonly>

                            </div>
                            <div class="col-md-6">
                                <label for="">Téléphone</label>
                                <input type="text" name="" value="{{ $element->personnel->tel1_personnel }}" class="form-control" readonly>

                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Solde Annual</label>
                                <input type="number" name="conge_annual" value="{{ $element->conge_annual }}" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="">Solde Exceptionnel</label>
                                <input type="number" name="conge_exceptionnel" value="{{ $element->conge_exceptionnel }}" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="">Solde Compensatoire</label>
                                <input type="number" name="conge_compensatoire" value="{{ $element->conge_compensatoire }}" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="">Solde Maladie</label>
                                <input type="number" name="conge_maladie" value="{{ $element->conge_maladie }}" class="form-control" required>
                            </div>
                        </div>
                        <br><br>
                        <center>
                            <button type="submit" class="btn btn-success">Modifier</button>
                        </center>
                    </form>
                    <br><br>
                    {{-- <h3>Statistiques des congés: </h3>
                    <div class="">
                        <span>Maternité <b>{{$allMaternites}} / {{ $element->categorie->nombre}}</b></span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allMaternites*100/60}}%;" aria-valuenow="{{ $allMaternites }}" aria-valuemin="0" aria-valuemax="100">{{$allMaternites}}%</div>
                        </div>
                        <hr>
                        <span>Congé Annuel <b>{{$allAnnuels}} / 28</b> 
                        </span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allAnnuels*100/28}}%;" aria-valuenow="{{ $allAnnuels }}" aria-valuemin="0" aria-valuemax="100">{{number_format(($allAnnuels*100/28), 2, '.', ',');}}%</div>
                        </div>
                        <hr>
                        <span>Naissance d'un enfant <b>{{$allNaissEnf}} / 2</b></span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allNaissEnf*100/2}}%;" aria-valuenow="{{ $allNaissEnf }}" aria-valuemin="0" aria-valuemax="100">{{number_format(($allNaissEnf*100/2), 2, '.', ',');}}%</div>
                        </div>
                        <hr>
                        <span>Décès d'un conjoint <b>{{$allDecesConj}} / 3</b></span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allDecesConj*100/3}}%;" aria-valuenow="{{ $allDecesConj }}" aria-valuemin="0" aria-valuemax="100">{{number_format(($allDecesConj*100/3), 2, '.', ',');}}%</div>
                        </div>
                        <hr>
                        <span>Décès d'un père, d'une mère ou d'un fils <b>{{$allDecesPMF}} / 3</b></span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allDecesPMF*100/3}}%;" aria-valuenow="{{ $allDecesPMF }}" aria-valuemin="0" aria-valuemax="100">{{number_format(($allDecesPMF*100/3), 2, '.', ',');}}%</div>
                        </div>
                        <hr>
                        <span>Décès d'un frère, d'une sœur, d'un petit-fils, d'une petite fille, d'un grand père ou d'une grande mère <b>{{$allDecesFSPG}} / 2</b></span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allDecesFSPG*100/2}}%;" aria-valuenow="{{ $allDecesFSPG }}" aria-valuemin="0" aria-valuemax="100">{{number_format(($allDecesFSPG*100/2), 2, '.', ',');}}%</div>
                        </div>
                        <hr>
                        <span>Mariage du Travailleur <b>{{$allMariageTrav}} / 3</b></span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allMariageTrav*100/3}}%;" aria-valuenow="{{ $allMariageTrav }}" aria-valuemin="0" aria-valuemax="100">{{number_format(($allMariageTrav*100/3), 2, '.', ',');}}%</div>
                        </div>
                        <hr>
                        <span>Mariage d'un enfant <b>{{$allMariageEnf}} / 1</b></span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allMariageEnf*100/1}}%;" aria-valuenow="{{ $allMariageEnf }}" aria-valuemin="0" aria-valuemax="100">{{number_format(($allMariageEnf*100/1), 2, '.', ',');}}%</div>
                        </div>
                        <hr>
                        <span>Circoncision d'un enfant <b>{{$allCirconcision}} / 1</b></span>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{$allCirconcision*100/1}}%;" aria-valuenow="{{ $allCirconcision }}" aria-valuemin="0" aria-valuemax="100">{{number_format(($allCirconcision*100/1), 2, '.', ',');}}%</div>
                        </div>
                    </div> --}}
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection