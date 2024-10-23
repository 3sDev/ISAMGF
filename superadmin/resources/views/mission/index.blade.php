
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des ordres et missions')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Ordres et missions</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Ordres et missions</li>
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
                <div class="card-header">
                    <h3 class="card-title">Liste des ordres et missions</h3>
                    <a href="{{ url('missions/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th>Titre</th>
                                <th width="10%">Date début</th>
                                <th width="10%">Date fin</th>
                                <th>Nom et Prénom</th>
                                <th>Fichier</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($missions as $missionElement)
                            
                            <tr>
                            <td>{{ $missionElement->id }}</td>
                            <td><span>{{ $missionElement->titre }}</span></td>
                            {{-- <td><span class="textable">{{ $missionElement->titre }}</span></td> --}}
                            <td><span>{{ $missionElement->date_debut }}</span></td>
                            <td><span>{{ $missionElement->date_fin }}</span></td>
                            <td><span>{{ $missionElement->personnel->nom.' '.$missionElement->personnel->prenom }}</span></td>
                            <td align="center">
                                @if ($missionElement->fichier)
                                    <a href={{ asset($upload.'/missions/'.$missionElement->fichier) }} target="_blank">
                                        <img src="https://smartschools.tn/isamgf/servicestage/public/upload/file.png" alt="" style="width:30px">
                                    </a>
                                @endif   
                            </td>
                            <td class="text-right">
                                {{-- <a href="{{ url('show-missions/'.$missionElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('missions/'.$missionElement->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ url('delete-missions/'.$missionElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Nom et Prénom</th>
                                <th>Fichier</th>
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