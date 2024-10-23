
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des congés')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des congés</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des congés</li>
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
.duree {
    background-color: rgb(255, 242, 242);
    font-weight: bold;
    color: rgb(32, 31, 29);
}
.reste {
    background-color: rgb(242, 255, 244);
    font-weight: bold;
    color: rgb(32, 31, 29);
}
.category{
    background-color: rgb(239, 229, 255);
    color: rgb(107, 4, 107);
    padding: 5px 10px;
    border-radius: 6px;
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('conges/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Personnel</th>
                                <th>Date demande</th>
                                <th>Année</th>
                                <th>Période</th>
                                <th>Durée</th>
                                <th>Catégorie</th>
                                <th width="10%">Statut</th>
                                <th width="10%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conges as $element)
                            
                            <tr>
                            <td><span>{{ $element->personnel->nom.' '.$element->personnel->prenom }}</span></td>
                            <td>{{ date('Y-m-d | H:i', strtotime($element->created_at)) }}</td>
                            <td><span>{{ $element->annee }}</span></td>
                            <td><span>{{ $element->date_debut.' | '.$element->date_fin }}</span></td>
                            <td class="text-center"><b>{{ $element->duree }}</b> jour(s)</td>
                            <td><span class="category">{{ $element->categorie->nom }}</span></td>

                            @if (($element->statut=='En cours'))
                            <td><span class="demandEnvoyee">{{ $element->statut }}</span></td>
                            @endif
                            @if (($element->statut=='Accepté'))
                            <td><span class="demandTraitee">{{ $element->statut }}</span></td>
                            @endif
                            @if (($element->statut=='Réfusé'))
                            <td><span class="demandEncours">{{ $element->statut }}</span></td>
                            @endif
                            
                            <td class="text-center">
                                {{-- <a href="{{ url('show-missions/'.$element->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('edit-conge/'.$element->id.'/'.$element->personnel->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{ url('show-DemandeConge/'.$element->id.'/'.$element->personnel->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm" target="_blank"><i class="nav-icon fas fa-eye"></i></a>
                            </td>
                            <td class="text-center">
                                @if (($element->statut=='En cours'))
                                    <form action="{{ url('delete-conge/'.$element->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                        <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                                @else
                                    <span>--</span>
                                @endif
                            </td>
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