
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des toutes les salles')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des salles</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des salles</li>
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
                    <h3 class="card-title">Liste des salles (Emploi Salles)</h3>
                    <a href="{{ url('salles/create') }}" class="btn btn-primary float-right">Ajouter</a>
                    <a href="{{ url('salles/affecter') }}" class="btn btn-success float-right" style="margin-right: 1.5%;">Affecter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Salle</th>
                                <th width="30%">Département</th>
                                {{-- <th width="15%">Disponibilité</th> --}}
                                <th width="10%">Date création</th>
                                <th align="center" width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salles as $salleElement)
                            <tr>
                            <td>{{ $salleElement->id }}</td>
                            <td><span class="textable">{{ $salleElement->fullName }}</span></td>
                            <td>{{ $salleElement->departmentLabel }}</td>
                            {{-- <td><progress value="20" max="100"></progress></td> --}}
                            
                            <td>{{ date('Y-m-d', strtotime($salleElement->created_at)) }}</td>
                            
                            <td class="text-center">
                                <a href="{{ url('emploi-salle/'.$salleElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Salle</th>
                                <th width="20%">Département</th>
                                {{-- <th width="15%">Disponibilité</th> --}}
                                <th width="10%">Date création</th>
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