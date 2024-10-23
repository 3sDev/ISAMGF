@extends('adminlayoutscolarite.layoutdatatable')
@section('title', 'Liste étudiants')
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
        <h1 class="m-0">Gestion des étudiants</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Gestion des étudiants</li>
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
                      <h3 class="card-title">Liste de tous les étudiants (Inscription en ligne)
                      </h3>
                      {{-- <a href="{{ url('students/create') }}" class="btn btn-primary float-right">Ajouter</a> --}}
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>CIN</th>
                                  <th>Nom et Prénom</th>
                                  <th>Classe</th>
                                  <th>Genre</th>
                                  <th>Date Inscription</th>
                                  <th>Active</th>
                                  <th class="disabled-sorting text-right">Actions</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($students as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/students/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->cin }}</td>
                              <td>{{ $item->prenom .' '. $item->nom }}</td>
                              <td>{{ $item->classe->abbreviation }}</td>
                              <td>{{ $item->genre }}</td>
                              <td>{{ date('Y-m-d - H:i', strtotime($item->created_at)) }}</td>
                              <td>

                                {{-- <form action="{{ url('update-student-account/'.$item->id) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                                  @csrf
                                  @method('PUT') --}}
                                  <input type="text" style="display: none;" name="active" value="{{ $item->active }}">

                                  @if (($item->active == '0'))
                                  <button type="submit" class="btn btn-link btn-warning btn-just-icon edit btn-sm">Désactivé</button>
                                  @endif
                                  @if (($item->active == '1'))
                                  <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm">Inscrit / Activé</button>
                                  @endif
                                  @if (($item->active == '2'))
                                  <button type="submit" class="btn btn-link btn-danger btn-just-icon edit btn-sm">Non inscrit</button>
                                  @endif
                                  @if (($item->active == '3'))
                                  <button type="submit" class="btn btn-link btn-info btn-just-icon edit btn-sm">Retrait Inscrit</button>
                                  @endif
                                  @if (($item->active == '4'))
                                  <button type="submit" class="btn btn-link btn-secondary btn-just-icon edit btn-sm">Mutation</button>
                                  @endif
                                {{-- </form> --}}
                            
                              </td>
                              <td class="text-right">
                                <a href="{{ url('students/'.$item->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                <a href="{{ url('students/'.$item->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                              </td>
                              <td>
                                <form action="{{ url('students/'.$item->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fas fa-trash"></i></button>

                                </form>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>ID</th>
                                <th>CIN</th>
                                <th>Nom et Prénom</th>
                                <th>Classe</th>
                                <th>Genre</th>
                                <th>Date Inscription</th>
                                <th>Active</th>
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