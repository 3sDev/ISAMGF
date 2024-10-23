
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Vie estidiantine')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Vie estidiantine</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Vie estidiantine</li>
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
                    <h3 class="card-title">Liste des localisations</h3>
                    <a href="{{ url('maps/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="6%">Image</th>
                                <th width="30%">titre</th>
                                <th width="20%">Categorie</th>
                                <th width="6%">Views</th>
                                <th width="6%">Rating</th>
                                <th width="8%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maps as $mapElement)
                            
                            <tr>
                            <td>{{ $mapElement->id }}</td>
                            <td>
                                <div class="filter-container p-0 row">
                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                        <a href={{ asset($upload.'/locations/'.$mapElement->image) }} target="_blank" data-toggle="lightbox" data-title="sample 4 - red">
                                        <img class="img-circle" src={{ asset($upload.'/locations/'.$mapElement->image) }} width="60px" height="60px" alt="maps"/>
                                        </a>
                                    </div>
                                </div>  
                            </td>
                            <td><span class="textable">{{ $mapElement->titre }}</span></td>
                            <td>{{ $mapElement->categorie }}</td>
                            <td>{{ $mapElement->views }}</td>
                            <td>{{ $mapElement->rating }}</td>
                            
                            <td class="text-right">
                                <a href="{{ url('show-maps/'.$mapElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                <a href="{{ url('maps/'.$mapElement->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ url('delete-maps/'.$mapElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="6%">Image</th>
                                <th width="30%">titre</th>
                                <th width="20%">Categorie</th>
                                <th width="6%">Views</th>
                                <th width="6%">Rating</th>
                                <th width="8%"></th>
                                <th width="5%"></th>
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