
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des formations')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des formations</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des formations</li>
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
                    <a href="{{ url('formations/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Personnel</th>
                                <th>Nom formation</th>
                                <th>Lieu</th>
                                <th width="10%">D_Début</th>
                                <th width="10%">D_Fin</th>
                                <th>Attestation</th>
                                <th width="9%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formations as $element)
                            
                            <tr>
                            <td>{{ $element->personnel->nom.' '.$element->personnel->prenom }}</td>
                            <td><span>{{ $element->nom_formation }}</span></td>
                            <td><span>{{ $element->lieu }}</span></td>
                            <td><span>{{ $element->date_debut }}</span></td>
                            <td><span>{{ $element->date_fin }}</span></td>
                            <td class="text-center">
                                <div class="filter-container p-0 row">
                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                        <a href={{ asset($upload.'/personnels/formations/'.$element->attestation) }} target="_blank" data-toggle="lightbox" data-title="sample 4 - red">
                                        <img style="border-radius: 10px;" src={{ asset($upload.'/personnels/formations/'.$element->attestation) }} width="60px" height="60px" alt="avis"/>
                                        </a>
                                    </div>
                                </div>  
                            </td>
                            <td class="text-right">
                                <a href="{{ url('show-formation/'.$element->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                <a href="{{ url('edit-formation/'.$element->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ url('delete-formation/'.$element->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
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