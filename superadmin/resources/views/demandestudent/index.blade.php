@extends('adminlayoutenseignant.layoutdatatable')
@section('title', 'Liste des demandes pour les étudiants')

@section('contentPage')

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Demandes Etudiants</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste des demandes étudiants</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Sous Type</th>
                                <th width="11%">Statut</th>
                                <th>Etudiant</th>
                                <th>Classe</th>
                                <th>Date Envoi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandestudents as $demand)
                            
                            <tr>
                            <td>{{ $demand->id }}</td>
                            <td>{{ $demand->type }}</td>
                            <td>{{ $demand->sous_type }}</td>

                            @if (($demand->statut=='En cours'))
                            <td><span class="demandEncours">{{ $demand->statut }}</span></td>
                            @endif
                            @if (($demand->statut=='Traitée'))
                            <td><span class="demandTraitee">{{ $demand->statut }}</span></td>
                            @endif
                            
                            <td>{{ $demand->student->prenom.' '.$demand->student->nom }}</td>
                            <td>{{ $demand->classe->abbreviation }}</td>
                            <td>{{ date('Y-m-d | H:i', strtotime($demand->created_at)) }}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection