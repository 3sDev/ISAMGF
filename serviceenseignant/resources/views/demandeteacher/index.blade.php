@extends('adminlayoutenseignant.layout')
@section('title', 'Liste des demandes pour les enseignants')

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
            <li class="breadcrumb-item active">Demandes Enseignants</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste de tous les demandes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Enseignant</th>
                                <th>Poste</th>
                                <th>Téléphone</th>
                                <th>Date</th>
                                <th></th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandeteachers as $demand)
                            
                            <tr>
                            <td>{{ $demand->id }}</td>
                            <td>{{ $demand->type }}</td>
                            {{-- 
                            @if (($demand->statut=='Envoyée'))
                            <td><span class="demandEnvoyee">{{ $demand->statut }}</span></td>
                            @endif --}}
                            @if (($demand->statut=='En cours'))
                            <td><span class="demandEncours">{{ $demand->statut }}</span></td>
                            @endif
                            @if (($demand->statut=='Traitée'))
                            <td><span class="demandTraitee">{{ $demand->statut }}</span></td>
                            @endif
                            
                            <td>{{ $demand->teacher->prenom.' '.$demand->teacher->nom }}</td>
                            <td>{{ $demand->teacher->poste }}</td>
                            <td>{{ $demand->teacher->tel1_teacher }}</td>
                            <td>{{ date('Y-m-d / H:i', strtotime($demand->created_at)) }}</td>
                            {{-- <td>{{ strtotime($demand->created_at).date('Y-m-d') }}</td> --}}
                            
                            <td class="text-center">
                                <a href="{{ url('edit-demandeteacher/'.$demand->id) }}" class="btn btn-link btn-success btn-just-icon edit btn-sm"><i class="nav-icon fas fa-edit"></i></a>
                                {{-- <a href="{{ url('show-demandeteacher/'.$demand->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm" target="_blank"><i class="nav-icon fas fa-eye"></i></a> --}}
                            </td>
                            {{--  <td>
                                <form action="{{ url('delete-demandeteacher/'.$demand->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td> --}}
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Enseignant</th>
                                <th>Poste</th>
                                <th>Téléphone</th>
                                <th>Date</th>
                                <th></th>
                                {{-- <th></th> --}}
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