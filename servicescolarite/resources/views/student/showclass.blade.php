
 @extends('adminlayoutscolarite.layout')
 @section('title', 'Liste des étudiants')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des étudiants</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des étudiants</li>
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
.btn-link {color:white;}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h3 class="card-title">Liste des étudiants</h3> --}}
                    <a href="{{ url('classe-student') }}" class="btn btn-primary float-right">Retour</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @foreach ($classResult as $classItem)
                        <center><h5>Classe : <b>{{ $classItem->abbreviation }}</b></h5></center><br>
                    @endforeach
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom et Prénom</th>
                                <th>Cin</th>
                                <th>Téléphone</th>
                                <th>Active</th>
                                <th>Date Inscription</th>
                                <th class="disabled-sorting text-center">Actions</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $item)
                            
                          <tr>
                            {{-- <td><img src="/upload/students/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->prenom .' '. $item->nom }}</td>
                            <td>{{ $item->cin }}</td>
                            <td>{{ $item->tel1_etudiant }}</td>

                            <td class="text-center">
                                @if (($item->active == '0'))
                                <button type="submit" class="btn btn-link btn-warning btn-just-icon edit btn-sm">Désactivé</button>
                                @endif
                                @if (($item->active == '1'))
                                <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm">Activé</button>
                                @endif
                            </td>

                            <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                          
                            <td class="text-center">
                              <a href="{{ url('students/'.$item->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                              <a href="{{ url('students/'.$item->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            {{-- <td>
                              <form action="{{ url('students/'.$item->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fas fa-trash"></i></button>

                              </form>
                            </td> --}}
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                              <th>ID</th>
                              <th>Nom et Prénom</th>
                              <th>Cin</th>
                              <th>Téléphone</th>
                              <th>Active</th>
                              <th>Date Inscription</th>
                              <th class="disabled-sorting text-right">Actions</th>
                              {{-- <th></th> --}}
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