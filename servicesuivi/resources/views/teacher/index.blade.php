@extends('adminlayoutenseignant.layoutdatatable')
{{-- @extends('adminlayoutenseignant.layout') --}}
@section('title', 'Liste enseignants')
@section('contentPage')

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.btn-link{
  color:white;
}
.statutEns{
  background-color: rgb(198, 198, 198);
  color: rgb(0, 0, 0);
  padding: 5px 12px;
  border-radius: 6px;
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
                      {{-- <a href="{{ url('teachers/create') }}" class="btn btn-primary float-right">Ajouter</a> --}}
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Nom et Prénom</th>
                                  <th>Grade</th>
                                  <th>Poste</th>
                                  <th>Tél</th>
                                  <th>Email</th>
                                  <th width="10%">Activation</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($teachers as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td>{{ $item->prenom .' '. $item->nom }}</td>
                              <td>{{ $item->type_enseignant}}</td>
                              <td>{{ $item->poste}}</td>
                              <td>{{ $item->tel1_teacher }}</td>
                              <td>{{ $item->email }}</td>
                              {{-- <td align="center">
                                <a href="{{ url('teachers-matieres/'.$item->id) }}" class="btn btn-link btn-danger btn-just-icon like btn-sm"><i class="nav-icon fas fa-cogs"></i></a>
                              </td> --}}
                              <td  align="center">
                                <input type="text" style="display: none;" name="active" value="{{ $item->active }}">

                                  @if (($item->active == '0'))
                                    <span class="statutEns">Désactivé</span>
                                  @endif
                                  @if (($item->active == '1'))
                                    <span class="statutEns">Activé</span>
                                  @endif
                                  @if (($item->active == '2'))
                                    <span class="statutEns">Fin Vacation</span>
                                  @endif
                                  @if (($item->active == '3'))
                                    <span class="statutEns">Fin Contractuel</span>
                                  @endif
                                  @if (($item->active == '4'))
                                    <span class="statutEns">Fin Expert</span>
                                  @endif
                                  @if (($item->active == '5'))
                                    <span class="statutEns">Mutation</span>
                                  @endif
                                  @if (($item->active == '6'))
                                    <span class="statutEns">Retraite</span>
                                  @endif
                                  @if (($item->active == '7'))
                                    <span class="statutEns">Coopération</span>
                                  @endif
                              </td>
                              
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th>Nom et Prénom</th>
                                  <th>Grade</th>
                                  <th>Poste</th>
                                  <th>Tél</th>
                                  <th>Email</th>
                                  <th width="10%">Activation</th>
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