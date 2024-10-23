@extends('adminlayoutenseignant.layout')
@section('title', 'Détails de stage')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails de stage</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('stages') }}">Liste des stages</a></li>
          <li class="breadcrumb-item active">Détails de stage</li>
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

            @foreach ($stages as $stageElement)

            <div class="col-12">
              {{--<div class="callout callout-info">
                <h5><i class="fas fa-info"></i>  Le service qui traité ce stage :</h5>
                <div class="card-header" style="border-bottom: none;">
                  <div class="user-block">
                    <img class="img-circle" src={{ asset('https://www.pngmart.com/files/21/Admin-Profile-PNG-Clipart.png') }} alt="User Image">
                    <span class="username">{{ $stageElement->user->name }}</span>
                    <span class="description">{{ $stageElement->user->role }}</span> 
                  </div>
                  <!-- /.user-block -->
                  <div class="card-tools">
                    <span class="float-right text-muted">{{ date('Y-m-d H:i', strtotime($stageElement->created_at)) }}</span>
                  </div>
                  <!-- /.card-tools -->
                </div>
              </div>--}}

              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-graduation-cap"></i> Etudiant
                      <small class="float-right"> </small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    <p class="lead">Informations personnels</p>
                    <address>
                      <strong>Nom et prénom(Fr) :</strong> {{ $stageElement->student->prenom.' '.$stageElement->student->nom }}<br>
                      <strong>Nom et prénom(Ar) :</strong> {{ $stageElement->student->prenom_ar.' '.$stageElement->student->nom_ar }}<br>
                      <strong>Classe :</strong> {{ $stageElement->classe->abbreviation }}<br>
                      <strong>CIN :</strong> {{ $stageElement->student->matricule }}<br>
                      <strong>Email :</strong> {{ $stageElement->student->email }}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <p class="lead">Adresse d'étudiant</p>
                    <address>
                      <strong>Code Postal:</strong> {{ $stageElement->student->codepostal_etudiant }}<br>
                      <strong>Gouvernorat :</strong> {{ $stageElement->student->gov }}<br>
                      <strong>Rue :</strong> {{ $stageElement->student->rue_etudiant }}<br>
                      <strong>Date naissance :</strong> {{ $stageElement->student->ddn }}<br>
                      <strong>Téléphone :</strong> {{ $stageElement->student->tel1_etudiant }}<br>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <p class="lead">Photo étudiant</p>
                    
                    <img class="img-circle" src={{ asset($upload.'/students/'.$stageElement->student->profile_image) }} width="120px" alt="Student Image">
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <br><hr><br>
                <!-- Table row -->
                <div class="row">
                  <h4>
                    <i class="fas fa-globe"></i> Société
                    <small class="float-right"> </small>
                  </h4><br>
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th width="20%">Nom société</th>
                        <th width="60%">Description société</th>
                        <th width="20%">Encadrant Société</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>{{ $stageElement->nom_socite }}</td>
                        <td>{{ $stageElement->info_socite }}</td>
                        <td>{{ $stageElement->encadrant_societe }}</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <br><hr><br>
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-file"></i> Stage
                      <small class="float-right"> </small>
                    </h4>
                  </div>
                  <div class="col-12">
                    {{-- https://smartschools.tn/university/public/upload/events/ --}}
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:20%">Sujet</th>
                          <td>{{$stageElement->sujet}}</td>
                        </tr>
                        <tr>
                          <th>Date début</th>
                          <td>{{$stageElement->date_debut}}</td>
                        </tr>
                        <tr>
                          <th>Date Fin</th>
                          <td>{{$stageElement->date_fin}}</td>
                        </tr>
                        <tr>
                          <th>Statut</th>
                          <td>{{$stageElement->statut}}</td>
                        </tr>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        @if ($stageElement->rapport_file !='')
                        <hr>
                        <p style="text-align: left;">
                          <a class="btn btn-secondary" data-toggle="collapse" href="#collapseRapport" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Rapport de stage (PDF)
                          </a>
                        </p>
                        <div class="collapse" id="collapseRapport">
                          <iframe
                            src='https://smartschools.tn/university/public/upload/library/stages/{{ $stageElement->rapport_file }}'
                            width="100%"
                            height="678">
                          </iframe>
                        </div>
                        @endif
                      </div>
                      <div class="col-sm-6">
                        @if ($stageElement->attesstation_file !='')
                        <hr>
                        <p style="text-align: left;">
                          <a class="btn btn-secondary" data-toggle="collapse" href="#collapseAttestation" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Attestation de stage (PDF)
                          </a>
                        </p>
                        <div class="collapse" id="collapseAttestation">
                          <iframe
                            src='https://smartschools.tn/university/public/upload/library/stages/{{ $stageElement->attesstation_file }}'
                            width="100%"
                            height="678">
                          </iframe>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <br><br><a href="#" onclick="window.print();return false;" rel="noopener" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection