
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des administrateurs')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des administrateurs</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des administrateurs</li>
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
                    <a href="{{ url('admins/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th>Nom et Prénom</th>
                                <th>Rôle</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th width="12%">Date Création</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $adminElement)
                            
                            <tr>
                            <td>{{ $adminElement->id }}</td>
                            <td><span>{{ $adminElement->name }}</span></td>
                            <td><span>{{ $adminElement->role }}</span></td>
                            <td><span>{{ $adminElement->email }}</span></td>
                            @if (($adminElement->lockout_time=='0'))
                            <td><span class="demandEncours">Désactivé</span></td>
                            @endif
                            @if (($adminElement->lockout_time=='1'))
                            <td><span class="demandTraitee">Activé</span></td>
                            @endif
                            <td>{{ date('Y-m-d | H:i', strtotime($adminElement->created_at)) }}</td>
                            
                            <td class="text-center">
                                {{-- <a href="{{ url('show-admins/'.$adminElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('admins/'.$adminElement->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ url('delete-admins/'.$adminElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nom et Prénom</th>
                                <th>Rôle</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Date Création</th>
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