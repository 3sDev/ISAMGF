
 @extends('adminlayoutenseignant.layoutdatatable')
 @section('title', 'Liste des personnels')
 @section('contentPage')

 <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Gestion des personnels</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Gestion des personnels</li>
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
                      <h3 class="card-title">Liste de tous les personnels
                      </h3>
                      <a href="{{ url('personnels/create') }}" class="btn btn-primary float-right">Ajouter</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>CIN</th>
                                  <th>Nom et Prénom</th>
                                  <th>Email</th> 
                                  <th>Profile</th>
                                  <th class="disabled-sorting text-right">Actions</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($personnels as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->cin }}</td>
                              <td>{{ $item->prenom .' '. $item->nom }}</td>
                              <td>{{ $item->email }}</td>
                              <td>
                                {{-- @if (($item->email!='')) --}}
                                  <a href="{{ url('personnels/'.$item->id.'/profile') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="nav-icon fas fa-user"></i></a>
                                {{-- @endif --}}
                                {{-- @if (($item->email==''))
                                  <a href="{{ url('teachers/'.$item->id) }}" class="btn btn-link btn-success btn-just-icon edit"><i class="material-icons">brush</i></a>
                                @endif --}}
                              </td>
                              <td class="text-right">
                                <a href="{{ url('personnels/'.$item->id) }}" class="btn btn-link btn-info btn-just-icon like"><i class="nav-icon fas fa-eye"></i></a>
                                <a href="{{ url('personnels/'.$item->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a>
                              </td>
                              <td>
                                <form action="{{ url('personnels/'.$item->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-link btn-danger btn-just-icon remove"><i class="fas fa-trash"></i></button>

                                </form>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>ID</th>
                                <th>Matricule</th>
                                  <th>Nom et Prénom</th>
                                  <th>Email</th> 
                                  <th>Profile</th>
                                  <th class="disabled-sorting text-right">Actions</th>
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
  </div>
  <!-- /.container-fluid -->
</section>

@endsection