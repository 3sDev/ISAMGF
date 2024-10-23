
 @extends('adminlayoutenseignant.layoutdatatable')
 @section('title', 'Liste groupes')
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
        
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Gestion des classes</li>
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
                      <h3 class="card-title">Liste des classes (Groupes)</h3>
                      <!-- a href="{{ url('createClasse') }}" class="btn btn-primary float-right">Ajouter</a-->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th width="8%">ID</th>
                                  <th width="20%">Nom Classe</th>
                                  <th width="20%">Section</th>
                                  <th width="20%">Niveau</th>
                                  <th width="6%" class="text-center">Semestre 1</th>
                                  <th width="6%" class="text-center">Semestre 2</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($classes as $item)
                              
                            <tr>
                              <td align="center">{{ $item->id }}</td>
                              <td>{{ $item->abbreviation }}</td>
                              <td>{{ $item->section->abbreviation }}</td>
                              <td>{{ $item->level->description }}</td>
                            
                              {{-- <td align="center">
                                <a href="{{ url('classe-matieres/'.$item->id) }}" class="btn btn-link btn-success btn-just-icon like btn-sm"><i class="nav-icon fas fa-cogs"></i></a>
                              </td> --}}
                              <td align="center">
                                <a href="{{ url('emploi-classe-semestre/'.$item->id.'/1') }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-calendar"></i></a>
                                {{-- <a href="{{ url('edit-groupe/'.$item->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a> --}}
                              </td>
                              <td align="center">
                                <a href="{{ url('emploi-classe-semestre/'.$item->id.'/2') }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-calendar"></i></a>
                                {{-- <form action="{{ url('delete-classe/'.$item->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form> --}}
                              </td>
                            
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>ID</th>
                                <th>Nom Classe</th>
                                <th>Section</th>
                                <th>Niveau</th>
                                <th>Semestre 1</th>
                                <th>Semestre 2</th>
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