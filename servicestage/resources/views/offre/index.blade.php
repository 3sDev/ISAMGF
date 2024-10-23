
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des offres d\'emploi')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des offres</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des offres</li>
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
                    <h3 class="card-title">Liste des offres d'emploi</h3>
                    <a href="{{ url('offres/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">titre</th>
                                <th width="30%">Description</th>
                                <th width="10%">Société</th>
                                <th width="20%">Infos Société</th>
                                <th width="6%">Fichier</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emplois as $emploiElement)
                            
                            <tr>
                            <td>{{ $emploiElement->id }}</td>
                            {{-- <td>
                                <div class="filter-container p-0 row">
                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                        <a href={{ asset($upload.'/offre_emploi/images/'.$emploiElement->image) }} target="_blank" data-toggle="lightbox" data-title="sample 4 - red">
                                        <img class="img-circle" src={{ asset($upload.'/offre_emploi/images/'.$emploiElement->image) }} width="60px" height="60px" alt="avis"/>
                                        </a>
                                    </div>
                                </div>  
                            </td> --}}
                            <td><span class="textable">{{ $emploiElement->titre }}</span></td>
                            <td><span class="textable">{{ $emploiElement->description }}</span></td>
                            <td>{{ $emploiElement->nom_societe }}</td>
                            <td><span class="textable">{{ $emploiElement->info_societe }}</span></td>
                            <td align="center">
                                @if ($emploiElement->fichier)
                                    <a href={{ asset($upload.'/offre_emploi/files/'.$emploiElement->fichier) }} target="_blank">
                                        <img src="https://smartschools.tn/isamgf/servicestage/public/upload/file.png" alt="" style="width:30px">
                                    </a>
                                @endif   
                            </td>
                            
                            <td class="text-center">
                                {{-- <a href="{{ url('show-offres/'.$emploiElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('offres/'.$emploiElement->id.'/edit') }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td class="text-center">
                                <form action="{{ url('delete-offres/'.$emploiElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>titre</th>
                                <th>Description</th>
                                <th>Société</th>
                                <th>Infos Société</th>
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