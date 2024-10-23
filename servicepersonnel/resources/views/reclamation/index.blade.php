
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des réclamations')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des réclamations</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des réclamations</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.textable {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Liste de réclamations</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                {{-- <th width="10%">Service</th> --}}
                                <th>Description</th>
                                <th>Personnels</th>
                                <th>Télephone</th>
                                <th width="12%">Statut</th>
                                <th width="15%">Date</th>
                                <th width="5%"></th>
                                {{-- <th width="5%"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reclamations as $reclam)
                            
                            <tr>
                            {{-- <td>{{ $reclam->service }}</td> --}}
                            <td><span class="textable">{{ $reclam->description }}</span></td>
                            <td>{{ $reclam->personnel->prenom.' '.$reclam->personnel->nom }}</td>
                            <td>{{ $reclam->personnel->tel1_personnel }}</td>

                            {{-- @if (($reclam->statut=='Envoyée'))
                            <td><span class="demandEnvoyee">{{ $reclam->statut }}</span></td>
                            @endif --}}
                            @if (($reclam->statut=='En cours'))
                            <td><span class="demandEncours">{{ $reclam->statut }}</span></td>
                            @endif
                            @if (($reclam->statut=='Traitée'))
                            <td><span class="demandTraitee">{{ $reclam->statut }}</span></td>
                            @endif

                            <td>{{ date('Y-m-d | H:i', strtotime($reclam->created_at)) }}</td>
                            {{-- <td>{{ strtotime($demand->created_at).date('Y-m-d') }}</td> --}}
                            
                            <td class="text-center">
                                {{-- <a href="{{ url('show-reclamation/'.$reclam->id) }}" class="btn btn-link btn-info btn-just-icon edit"><i class="material-icons">account_box</i></a> --}}
                                <a href="{{ url('edit-reclamation/'.$reclam->id) }}" class="btn btn-link btn-success btn-just-icon edit btn-sm"><i class="nav-icon fas fa-user"></i></a>
                            </td>
                            {{-- <td>
                                <form action="{{ url('delete-reclamation/'.$reclam->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td> --}}
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Description</th>
                                <th>Personnels</th>
                                <th>Téléphone</th>
                                <th>Statut</th>
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