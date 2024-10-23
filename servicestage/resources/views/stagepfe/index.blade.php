
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des PFE')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des PFE + Mémoire Mastère</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des PFE</li>
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
                {{-- <div class="card-header">
                    <h3 class="card-title"></h3>
                    <a href="{{ url('events/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Etudiant</th>
                                <th>Groupe</th>
                                <th>Type</th>
                                <th>Stage</th>
                                <th>Binôme</th>
                                <th>Encadrant</th>
                                <th>Société</th>
                                <th>Statut</th>
                                <th width="14%">D.Demande</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Stagespfe as $pfeElement)
                            
                            <tr>
                            <td>{{ $pfeElement->student->full_name }}</td>
                            <td><span>{{ $pfeElement->classe->abbreviation }}</span></td>
                            <td><span>{{ $pfeElement->classe->category }}</span></td>

                            @if ($pfeElement->sous_type=='اقتراح مشروع تخرج في شركة')
                                <td>Industriel</td>
                            @else
                                <td>Didactique</td>
                            @endif

                            <td><span>{{ $pfeElement->binome_pfe }}</span></td>
                            <td><span>{{ $pfeElement->encadrant_pfe }}</span></td>
                            <td><span>{{ $pfeElement->nom_societe_pfe }} </span></td>
                            <td><span>{{ $pfeElement->statut }} </span></td>
                            <td>
                                {{ date('Y-m-d | H:i', strtotime($pfeElement->created_at)) }}

                                {{-- @if ($pfeElement->datedebut_pfe)
                                <span>{{ date('Y-m-d', strtotime($pfeElement->datedebut_pfe)) }} 
                                    / {{ date('Y-m-d', strtotime($pfeElement->datefin_pfe)) }}
                                </span>
                                @else
                                    <span>--------------</span>
                                @endif --}}
                            </td>
                            
                            <td class="text-right">
                                {{-- <a href="{{ url('show-pfe/'.$pfeElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('pfe/'.$pfeElement->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ url('delete-pfeDirection/'.$pfeElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Etudiant</th>
                                <th>Groupe</th>
                                <th>Type</th>
                                <th>Stage</th>
                                <th>Binôme</th>
                                <th>Encadrant</th>
                                <th>Société</th>
                                <th>D.Demande</th>
                                <th>Statut</th>
                                <th></th>
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