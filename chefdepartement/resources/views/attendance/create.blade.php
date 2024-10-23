@extends('adminlayoutenseignant.layout')
@section('title', 'Gestion des absences')
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
          <li class="breadcrumb-item"><a href="{{ url('attendances') }}">Gestion des absences</a></li>
          <li class="breadcrumb-item active">Saisir absence d'enseignant</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.inputStyle {
  background: none !important;
  border: none !important;
}
.textable {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
.textPointage{
  font-size: 16px;
  font-weight: bold;
  color:olive;
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <center>
                  @foreach ($teacherResult as $teacher)
                      <h5><b>Enseignant :</b> {{ $teacher->full_name }}  <b style="margin-left: 15%;">Jour d'absence :</b> {{ $Jour }}   
                        <b style="margin-left: 15%;">Date:  </b>{{ $DateAttendance }}
                        <a href="{{ url('attendances') }}" class="btn btn-primary float-right">Retour</a>
                      </h5>
                  @endforeach
                  </center>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <form action="{{ url('save-attendances') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de sauvegarder ces données?')">
                      @csrf

                    <input type="hidden" name="jour" value="{{ $Jour }}">
                    <input type="hidden" name="teacher_id" value="{{ $IdTeacher }}">
                    <input type="hidden" name="attendance_date" value="{{ $DateAttendance }}">
                    <h4>Saisir absences :</h4>
                      <center><button type="submit" class="btn btn-danger" onclick="return IsEmpty();"><b>Envoyer</b></button></center>
                      <br>  
                      <center>
                      <table border="" BORDERCOLOR="#ccc" style="padding-right:5px; table-layout:fixed;" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th width="40%">Matière</th>
                                  <th width="10%">Type Matière</th>
                                  <th width="10%">Heure début</th>
                                  <th width="10%">Heure fin</th>
                                  <th width="8%">Salle</th>
                                  <th width="12%">Pointage</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($emploiTeacher as $emploi)
                              
                            <tr>
                              {{-- <td><img src="/upload/students/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td><input type="text" name="nom_matiere[]" value="{{ $emploi->matiere->subjectLabel }}" class="form-control inputStyle" readonly style="width: 100% !important;"></td>                            
                              <td><input type="text" name="type_matiere[]" value="{{ $emploi->matiere->description }}" class="form-control inputStyle" readonly style="width: 100% !important;"></td>                            
                              <td><input type="text" name="heure_debut[]" value="{{ $emploi->heure_debut }}" class="form-control inputStyle" style="width: 100% !important;" readonly></td>                            
                              <td><input type="text" name="heure_fin[]" value="{{ $emploi->heure_fin }}" class="form-control inputStyle" style="width: 100% !important;" readonly></td>                            
                              <td><input type="text" name="salle[]" value="{{ $emploi->salle->fullName }}" class="form-control inputStyle" style="width: 100% !important;" readonly></td>                            
                              <td align="center" style="background-color: rgb(151, 151, 151)">
                                <select class="form-control" id='selec3' name="presence[]" style="width: 100% !important;"> 
                                    <option value='A'> Absent(e) </option>
                                    <option value='P'> Présent(e) </option>
                                </select>
                              </td>
                              <td style="display: none;"><input type="text" name="seance_id[]" value="{{ $emploi->id }}" class="form-control inputStyle" style="width: 100% !important;" readonly></td>                            
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </center>
                    </form>
                    <br><hr><br>
                    <h4>Liste des absences :</h4>
                    <table border="" BORDERCOLOR="#ccc" style="padding-right:5px; table-layout:fixed;" class="table table-bordered table-striped">
                      <thead style="background-color: rgb(27, 57, 102); color:white;">
                          <tr>
                            <th width="40%">Matière</th>
                            <th width="10%">Date début</th>
                            <th width="10%">Date fin</th>
                            <th width="10%">Jour</th>
                            <th width="10%">Salle</th>
                            <th width="10%">Statut</th>
                            <th width="8%"></th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($attendanceTeachers as $attendance)
                          
                        <tr style="background-color: rgb(233, 255, 214)">
                          <td><span>{{ $attendance->nom_matiere ?? 'None'}} ({{ $attendance->type_matiere ?? 'None' }})</span></td>                       
                          <td><span>{{ $attendance->heure_debut ?? 'None' }}  </span></td>                          
                          <td><span>{{ $attendance->heure_fin ?? 'None' }} </span></td>                           
                          <td><span>{{ $attendance->jour ?? 'None' }} </span></td>                           
                          <td><span>{{ $attendance->salle ?? 'None' }}  </span></td>                          
                          <td align="center" style="background-color: rgb(255, 214, 214)">
                            <span class="textPointage">Absent(e)</span>
                          </td>
                          <td style="display: none;"><input type="text" name="" value="{{ $attendance->id ?? 'None' }}" class="form-control inputStyle" style="width: 100% !important;" readonly></td>                            
                          <td align="center">
                            <form action="{{ url('delete-attendancePageCreate/'.$attendance->id ?? 'None') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ces données?')">
                              <input type="hidden" name="jour" value="{{ $Jour }}">
                              <input type="hidden" name="attendance_date" value="{{ $DateAttendance }}">
                              <input type="hidden" name="teacher_id" value="{{ $IdTeacher }}">  
                              <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
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