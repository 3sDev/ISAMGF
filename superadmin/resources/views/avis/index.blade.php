
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des avis enseignants')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des avis</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des avis</li>
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
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="6%">Image</th>
                                <th width="10%">titre</th>
                                <th width="35%">Description</th>
                                <th width="10%">Type</th>
                                <th width="10%">Date</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($avis as $avisElement)
                            
                            <tr>
                            <td>{{ $avisElement->id }}</td>
                            <td>
                                <div class="filter-container p-0 row">
                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                        <a href={{ asset($upload.'/avis/images/'.$avisElement->image) }} target="_blank" data-toggle="lightbox" data-title="sample 4 - red">
                                        <img class="img-circle" src={{ asset($upload.'/avis/images/'.$avisElement->image) }} width="60px" height="60px" alt="avis"/>
                                        </a>
                                    </div>
                                </div>  
                            </td>
                            <td><span class="textable">{{ $avisElement->titre }}</span></td>
                            <td><span class="textable">{{ $avisElement->description }}</span></td>
                            <td><span class="textable">{{ $avisElement->type }}</span></td>
                            <td>{{ $avisElement->date }}</td>
                            
                            <td class="text-right">
                                <a href="{{ url('show-avis/'.$avisElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="6%">Image</th>
                                <th width="10%">titre</th>
                                <th width="35%">Description</th>
                                <th width="10%">Type</th>
                                <th width="5%">Date</th>
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