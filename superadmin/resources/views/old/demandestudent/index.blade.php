@extends('adminlayoutenseignant.layoutdatatable')
@section('title', 'Liste des demandes pour les étudiants')

@section('contentPage')

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Gestion des demandes</h1>
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
                    <h3 class="card-title">Liste des demandes pour les étudiants</h3>
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
                                <th>Langue</th>
                                <th>Date Envoi</th>
                                <th></th>
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
                            <td>{{ $demand->langue }}</td>
                            <td>{{ date('Y-m-d | H:i', strtotime($demand->created_at)) }}</td>
                            {{-- <td>{{ strtotime($demand->created_at).date('Y-m-d') }}</td> --}}
                            
                            <td class="text-right">
                                <a href="{{ url('edit-demandestudent/'.$demand->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-eye"></i></a>
                                {{-- <a href="{{ url('show-demandestudent/'.$demand->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm" target="_blank"><i class="nav-icon fas fa-eye"></i></a> --}}
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Sous Type</th>
                                <th>Statut</th>
                                <th>Etudiant</th>
                                <th>Classe</th>
                                <th>Langue</th>
                                <th>Date Envoi</th>
                                <th></th>
                            </tr>
                        </tfoot>
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