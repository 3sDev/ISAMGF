
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des matières')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des matières</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des matières</li>
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
                    <h3 class="card-title">Liste des matières</h3>
                    <a href="{{ url('matieres/create') }}" class="btn btn-primary float-right">Ajouter</a>
                    {{-- <a href="{{ url('matieres/affecter') }}" class="btn btn-success float-right" style="margin-right: 1.5%;">Affecter</a> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="4%">ID</th>
                                <th>Matière</th>
                                <th>Type </th>
                                <th>Volume</th>
                                <th>Nbr élimination</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matieres as $matElement)
                            
                            <tr>
                            <td class="text-center">{{ $matElement->id }}</td>
                            <td><span class="textable">{{ $matElement->subjectLabel }}</span></td>
                            <td>{{ $matElement->description }}</td>
                            <td>{{ $matElement->volume }}</td>
                            <td>{{ $matElement->nbr_eliminatoire }}</td>
                            
                            <td class="text-center">
                                {{-- <a href="{{ url('show-matieres/'.$matElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('matieres/'.$matElement->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td class="text-center">
                                <form action="{{ url('delete-matiere/'.$matElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Matière</th>
                                <th>Type </th>
                                <th>Volume</th>
                                <th>Nbr élimination</th>
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