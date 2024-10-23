
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
        <h1 class="m-0">Gestion des enseignants</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Gestion des enseignants</li>
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
                      <h3 class="card-title">Liste de tous les enseignants
                      </h3>
                      <a href="{{ url('teachers/create') }}" class="btn btn-primary float-right">Ajouter</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th width="20%">Nom et Prénom(FR)</th>
                                  <th width="20%">Nom et Prénom(AR)</th>
                                  <th width="15%">Tél</th>
                                  <th width="15%">Email</th>
                                  <th width="10%">Affecter</th> 
                                  <th width="10%">Activation</th>
                                  <th width="10%" class="disabled-sorting text-left">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($teachers as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td>{{ $item->prenom .' '. $item->nom }}</td>
                              <td>{{ $item->prenom_ar .' '. $item->nom_ar }}</td>
                              <td>{{ $item->tel1_teacher }}</td>
                              <td>{{ $item->email }}</td>
                              <td align="center">
                                {{-- @if (($item->email!='')) --}}
                                <a href="{{ url('teachers-matieres/'.$item->id) }}" class="btn btn-link btn-danger btn-just-icon like btn-sm"><i class="nav-icon fas fa-cogs"></i></a>

                                  {{-- <a href="{{ url('teachers/'.$item->id.'/profile') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="nav-icon fas fa-user"></i></a> --}}
                                {{-- @endif --}}
                                {{-- @if (($item->email==''))
                                  <a href="{{ url('teachers/'.$item->id) }}" class="btn btn-link btn-success btn-just-icon edit"><i class="material-icons">brush</i></a>
                                @endif --}}
                              </td>
                              <td  align="center">
                                <form action="{{ url('update-teacher-account/'.$item->id) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                                  @csrf
                                  @method('PUT')
                                  <input type="text" style="display: none;" name="active" value="{{ $item->active }}">

                                  @if (($item->active == '0'))
                                  <button type="submit" class="btn btn-link btn-secondary btn-just-icon edit btn-sm">Désactivé</button>
                                  @endif
                                  @if (($item->active == '1'))
                                  <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm">Activé</button>
                                  @endif

                                </form>
                              </td>
                              <td class="text-right">
                                <a href="{{ url('teachers/'.$item->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                <a href="{{ url('teachers/'.$item->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                              </td>
                              
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th width="20%">Nom et Prénom(FR)</th>
                                  <th width="20%">Nom et Prénom(AR)</th>
                                  <th width="15%">Tél</th>
                                  <th width="15%">Email</th>
                                  <th width="10%">Affecter</th> 
                                  <th width="10%">Activation</th>
                                <th width="10%" class="disabled-sorting text-left">Actions</th>
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