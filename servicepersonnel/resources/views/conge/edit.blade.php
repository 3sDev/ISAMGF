@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier congé')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier congé</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('conges') }}">Liste des congés</a></li>
            <li class="breadcrumb-item active">Modifier congé</li>
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
.totalValues{
    color: orangered;
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
                    <a href="{{ url('conges') }}" class="btn btn-danger float-right">Retour</a>
                </h4>
            </div>

            <div class="card-body">
                @foreach ($conges as $element)
                    <form action="{{ url('update-conge/'.$element->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée ?')">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Année</label>
                                <input type="text" name="annee" value="{{ $element->annee }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="">Nom et prénom</label>
                                <select name="personnel_id" data-style="btn btn-primary" required class="form-control" readonly>
                                    <option value="{{ $element->personnel->id }}">{{ $element->personnel->nom.' '.$element->personnel->prenom }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                @if ($element->categorie->id == 1)
                                    <label for="">Catégorie congé</label> <span class="totalValues">({{$allSoldeAnnual}})</span>
                                @elseif($element->categorie->id == 2)
                                    <label for="">Catégorie congé</label> <span class="totalValues">({{$allSoldeExceptionnel}})</span>
                                @elseif($element->categorie->id == 3)
                                    <label for="">Catégorie congé</label> <span class="totalValues">({{$allSoldeCompensatoire}})</span>
                                @else
                                    <label for="">Catégorie congé</label> <span class="totalValues">({{$allSoldeMaladie}})</span>
                                @endif
                                <select name="categorie_conges_id" data-style="btn btn-primary" required class="form-control" readonly>
                                    <option value="{{ $element->categorie->id }}">{{ $element->categorie->nom }}</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Date début</label>
                                <input type="date" name="date_debut" value="{{ $element->date_debut }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="">Date fin</label>
                                <input type="date" name="date_fin" value="{{ $element->date_fin }}" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="">Période congé (jours)</label>
                                <input type="text" name="duree" value="{{ $element->duree }}" class="form-control" readonly>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Statut</label>
                                <select name="statut" data-style="btn btn-primary" required class="form-control" required>
                                    <option value="{{ $element->statut }}">{{ $element->statut }}</option>
                                    <option value=""disabled>---------------------</option>
                                    <option value="Accepté">Accepté</option>
                                    <option value="Réfusé">Réfusé</option>
                                </select>
                                <br>
                                <center>
                                    <button type="submit" class="btn btn-success">Modifier Statut</button>
                                </center>                            
                            </div>
                        </form>
                            <div class="col-md-4">
                                <form action="{{ url('update-fileConge/'.$element->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-input-steps" style="text-align: left;">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">Fichier de congé</label>
                                                <input type="file" id="" style="width: 100% !important;" class="form-control" name="fichier" required>
                                            </div>
                                        </div>
                                        <center>
                                            <button type="submit" class="btn btn-warning">Modifier Fichier</button>
                                        </center>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    @if ($element->fichier)
                                        <iframe
                                        src={{ asset($upload.'/demandesPersonnels/conge/'.$element->fichier)}}
                                        width="100%"
                                        height="400">
                                        </iframe> 
                                        <a href="{{ asset($upload.'/demandesPersonnels/conge/'.$element->fichier)}}" target="_blank">Ouvrir le fichier</a>
                                    @else
                                    <img src="{{ asset('/upload/notfound.png')}}" alt="" style="width:180px !important; height: 180px;">
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                    <br><hr>
                    <!-- Small Box (Stat card) -->
                    <h5 class="mb-2 mt-4">Soldes total de chaque catégorie du congé :</h5>
                    <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$allSoldeAnnual}}</h3>

                            <p>Congé Annual</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="{{ url('soldes') }}" target="_blank" class="small-box-footer">
                            Voir Plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$allSoldeExceptionnel}}</h3>

                            <p>Congé Exceptionnel</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="{{ url('soldes') }}" target="_blank" class="small-box-footer">
                            Voir Plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$allSoldeCompensatoire}}</h3>

                            <p>Congé Compensatoire</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="{{ url('soldes') }}" target="_blank" class="small-box-footer">
                            Voir Plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$allSoldeMaladie}}</h3>

                            <p>Congé Sanitaire</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="{{ url('soldes') }}" target="_blank" class="small-box-footer">
                            Voir Plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    </div>
                    <!-- /.row -->
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