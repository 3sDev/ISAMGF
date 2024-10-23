
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

<style>
  .inputStyle {
    background: none !important;
    border: none !important;
    width: 50px;
  }
</style>


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
                    <h3 class="card-title">Saisir les présences des étudiants</h3>
                    <a href="{{ url('classe-student-attendance') }}" class="btn btn-primary float-right">Retour</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  @foreach ($classResult as $classItem)
                        <center><h5><b>Classe :</b> {{ $classItem->classeName }}</h5>
                        <h5><b>Date de présence :</b> {{ $dateAbs }}</h5><br></center>
                    @endforeach
                    <form action="{{ url('attendances') }}" method="POST">
                      @csrf
                      <center><button type="submit" class="btn btn-secondary" onclick="return IsEmpty();"><b>Envoyer</b></button></center>
                      <br>  
                      <table border="" BORDERCOLOR="#ccc" style="padding-right:5px; table-layout:fixed;" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Date ABS</th>
                                  <th>Nom et Prénom</th>
                                  <td>Classe id</td>
                                  <td>Maths</td>
                                  <td>Physique</td>
                                  <td>Science</td>
                                  <td>Informatique</td>
                                  <td>Englais</td>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($students as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/students/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td><input type="text" class="inputStyle" name="student_id[]" value="{{ $item->id }}"></td>
                              <td><input type="text" class="inputStyle" name="dateAbs[]" value="{{ $dateAbs }}"></td>
                              <td>{{ $item->prenom .' '. $item->nom }}</td>                            
                              <td>
                                @foreach ($classResult as $classItem)
                                  <input type="text" class="inputStyle" name="classe_id[]" value="{{ $classItem->id }}">
                                @endforeach
                              </td>                            
                              <td align="center"><input type="checkbox"name="matiere_id[]"  value="1"></td>
                              <td align="center"><input type="checkbox"name="matiere_id1[]" value="2"></td>
                              <td align="center"><input type="checkbox"name="matiere_id2[]" value="12"></td>
                              <td align="center"><input type="checkbox"name="matiere_id3[]" value="4"></td>
                              <td align="center"><input type="checkbox"name="matiere_id4[]" value="6"></td>
                            
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>ID</th>
                                <th>Date ABS</th>
                                <th>Nom et Prénom</th>
                                <td>Classe id</td>
                                <td>Maths</td>
                                <td>Physique</td>
                                <td>Science</td>
                                <td>Informatique</td>
                                <td>Englais</td>
                              </tr>
                          </tfoot>
                      </table>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection