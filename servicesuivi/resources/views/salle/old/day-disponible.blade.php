
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Saisir Jour de disponibilité')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Disponibilité des salles</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Choisir une date</li>
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
                <!-- /.card-header -->
                <div class="card-header">
                    <a href="{{ url('reserver-salle') }}" class="btn btn-secondary float-right">Réserver séance/salle</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('display-salle') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <b>Choisir Date de la disponibilité</b>
                                    <input type="date" name="date_disponible" id="" style="width:100%;" class="form-control" required>                                 
                                </div>
                            </div>
                            <div class="col-lg-4"></div>                            
                        </div>

                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-primary btn-info btn-just-icon like text-center">Saisir</button>
                            </center>
                        </div>
                    </form>

                    <br><hr><br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="6%">ID</th>
                                <th>Nom salle</th>
                                <th>Type salle</th>
                                <th>Jour séance</th>
                                <th>Séance</th>
                                <th>Statut salle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salleEmplois as $seanceElement)
                            
                            <tr>
                                <td>{{ $seanceElement->id }}</td>
                                <td>{{ $seanceElement->fullName }}</td>
                                <td>{{ $seanceElement->type_salle }}</td>
                                <td>{{ $seanceElement->jour }}</td>
                                <td>{{ $seanceElement->heure_debut }} | {{ $seanceElement->heure_fin }} </td>
                                @if (($seanceElement->statut=='1'))
                                <td><span class="demandEncours">Séance occupée</span></td>
                                @endif
                                @if (($seanceElement->statut=='0'))
                                <td><span class="demandTraitee">Séance Disponible</span></td>
                                @endif
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nom salle</th>
                                <th>Type salle</th>
                                <th>Jour séance</th>
                                <th>Séance</th>
                                <th>Statut salle</th>
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