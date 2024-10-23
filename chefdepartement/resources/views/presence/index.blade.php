
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
        <h1 class="m-0">Gestion des enseignants (Présences)</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Gestion des enseignants (Présences)</li>
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
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th width="10%">Matricule</th>
                                  <th width="20%">Nom et Prénom(FR)</th>
                                  <th width="20%">Nom et Prénom(AR)</th>
                                  <th width="20%">Email</th>
                                  <th width="20%">Tél</th>
                                  <th width="10%" class="disabled-sorting text-left">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($teachers as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td>{{ $item->matricule }}</td>
                              <td>{{ $item->prenom .' '. $item->nom }}</td>
                              <td>{{ $item->prenom_ar .' '. $item->nom_ar }}</td>
                              <td>{{ $item->email }}</td>
                              <td>{{ $item->tel1_teacher }}</td>
                              <td align="center">
                                <a href="{{ url('saisir-presence/'.$item->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                              </td>
                              
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th width="10%">Matricule</th>
                                <th width="20%">Nom et Prénom(FR)</th>
                                <th width="20%">Nom et Prénom(AR)</th>
                                <th width="20%">Tél</th>
                                <th width="20%">Email</th>
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