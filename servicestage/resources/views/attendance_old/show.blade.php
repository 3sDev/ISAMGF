
 @extends('adminlayoutscolarite.layout')
 @section('title', 'Liste des étudiants')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Gestion des absences</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('show-attendances') }}">Choisir une classe</a></li>
          <li class="breadcrumb-item active">Absences</li>
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
                    <h3 class="card-title">Saisir les absences des étudiants</h3>
                    <a href="{{ url('classe-student-attendance') }}" class="btn btn-primary float-right">Retour</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <form action="{{ url('attendances') }}" method="POST">
                      @csrf

                      @foreach ($classResult as $classItem)
                        <center><h5><b>Classe :</b> {{ $classItem->classeName }}</h5>
                        <h5><b>Date de présence :</b> {{ $dateAbs }}  /  {{ $seanceAbs }}</h5><br></center>
                      @endforeach
                      <div class="row">

                        <input type="text" name="date_absence" value="{{ $dateAbs }}"><br>
                        <input type="text" name="seance_absence" value="{{ $seanceAbs }}"><br>
                        <input type="text" name="classe_id" value="{{ $classeId }}">


                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <b>Liste des enseignants</b>
                                <select name="teacher_id" class="form-control" required style="width: 100% !important">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"> {{ $teacher->nom.' '.$teacher->prenom }}</option>
                                    @endforeach
                                </select>                                    
                            </div>
                            <br>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <b>Liste des matières</b>
                                <select name="matiere_id" class="form-control" required style="width: 100% !important">
                                  @foreach ($matieres as $matiere)
                                      <option value="{{ $matiere->id }}"> {{ $matiere->subjectLabel }}</option>
                                  @endforeach
                                </select>                                    
                            </div>
                            <br>
                        </div>


                        <div class="col-lg-3"></div>
                        
                    </div>



                      <center><button type="submit" class="btn btn-secondary" onclick="return IsEmpty();"><b>Envoyer</b></button></center>
                      <br>  
                      <center>
                      <table border="" BORDERCOLOR="#ccc" style="padding-right:5px; table-layout:fixed; width:50% !important" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th width="20%">ID</th>
                                  <th width="60%">Nom et Prénom</th>
                                  <td width="20%">Absence</td>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($students as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/students/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td><input type="text" class="inputStyle" name="student_id[]" value="{{ $item->id }}"></td>
                              <td>{{ $item->prenom .' '. $item->nom }}</td>                            
                                         
                              <td align="center"><input type="checkbox"name="presence[]" value="1"></td>
                            
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>ID</th>
                                <th>Nom et Prénom</th>
                                <td>Absence</td>
                              </tr>
                          </tfoot>
                      </table>
                    </center>
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