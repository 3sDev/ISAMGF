
 @extends('adminlayoutenseignant.layoutdatatable')
 @section('title', 'Liste enseignants')
 @section('contentPage')

 <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
 <style>
  .btn-link{
    color:white;
  }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Gestion emploi de temps pour les enseignants</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Emploi de temps pour les enseignants</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <section class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Liste des enseignants
                      </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th width="5%">ID</th>
                                  <th>Nom et Prénom</th>
                                  <th>Email</th>
                                  <th>Télephone</th>
                                 {{-- <th>Poste</th>--}}
                                  <th width="8%">Emploi</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($teachers as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td align="center">{{ $item->id }}</td>
                              <td>{{ $item->prenom .' '. $item->nom }}</td>
                              <td>{{ $item->email }}</td>
                              <td>{{ $item->tel1_teacher }}</td>
                              {{--<td>{{ $item->grade }}</td>--}}
                              {{-- <td>{{ $item->voeux->jour }}</td>
                              <td>{{ $item->voeux->jour }}</td> --}}
                              <td align="center">
                                <a href="{{ url('teachers-schedule/'.$item->id) }}" class="btn btn-link btn-info btn-just-icon like "><i class="nav-icon fas fa-calendar"></i></a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>ID</th>
                                <th>Nom et Prénom</th>
                                <th>Email</th>
                                <th>Télephone</th>
                                {{--<th>Poste</th>--}}
                                <th>Emploi</th>
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
  </div>
  <!-- /.container-fluid -->
</section>

@endsection