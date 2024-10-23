
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des spécialités')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des spécialités</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des spécialités</li>
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
                    <a href="{{ url('specialites/create') }}" class="btn btn-primary float-right">Ajouter</a>
                    {{-- <a href="{{ url('matieres/affecter') }}" class="btn btn-success float-right" style="margin-right: 1.5%;">Affecter</a> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="4%">ID</th>
                                        <th>Spécialité</th>
                                        <th>Description </th>
                                        <th width="3%"></th>
                                        <th width="3%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($specialites as $spe)
                                    
                                    <tr>
                                    <td class="text-center">{{ $spe->id }}</td>
                                    <td><span>{{ $spe->label }}</span></td>
                                    <td>{{ $spe->description }}</td>
                                    
                                    <td class="text-center">
                                        {{-- <a href="{{ url('show-matieres/'.$matElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                        <a href="{{ url('specialites/'.$spe->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ url('delete-specialite/'.$spe->id) }}" onsubmit="return confirm('Confirmer la suppression?')">
                                            <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Spécialité</th>
                                        <th>Description </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection