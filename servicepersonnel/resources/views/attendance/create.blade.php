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
          <li class="breadcrumb-item active">Absences Personnels</li>
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
                      <h5><b style="margin-left: 15%;">Jour d'absence :</b> {{ $Jour }}   
                        <b style="margin-left: 15%;">Date:  </b>{{ $DateAttendance }}
                        <a href="{{ url('attendances') }}" class="btn btn-primary float-right">Retour</a>
                      </h5>
                  </center>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <form action="{{ url('save-attendances') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de sauvegarder ces données?')">
                      @csrf

                    <input type="hidden" name="jour" value="{{ $Jour }}">
                    <input type="hidden" name="attendance_date" value="{{ $DateAttendance }}">
                    <h4>Saisir absences :</h4>
                      <center><button type="submit" class="btn btn-danger" onclick="return IsEmpty();"><b>Envoyer</b></button></center>
                      <br>  
                      <center>
                      <table BORDERCOLOR="#ccc" style="width:60%; padding-right:5px; table-layout:fixed;" class="table table-bordered table-striped">
                          <thead>
                              <tr style="background-color: rgb(27, 57, 102); color:white;">
                                  <th width="10%">Id</th>
                                  <th width="66%">Personnels</th>
                                  <th width="24%">Présence</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($personnels as $element)
                              
                            <tr>
                              {{-- <td><img src="/upload/students/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td><input type="text" name="personnel_id[]" value="{{ $element->id }}" class="form-control inputStyle" readonly style="width: 100% !important;"></td>                            
                              <td><span>{{ $element->nom.' '.$element->prenom }}</span></td>                            
                              <td align="center" style="background-color: rgb(151, 151, 151)">
                                <select class="form-control" id='selec3' name="presence[]" style="width: 100% !important;"> 
                                  <option value='Présent(e)'> Présent(e) </option>  
                                  <option value='Absent(e)'> Absent(e) </option>
                                  <option value='Congé'> Congé</option>
                                  <option value='Maladie'> Maladie</option>
                                  <option value='Autorisation'> Autorisation</option>
                                </select>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </center>
                    </form>
                    <br><hr><br>
                    <h4>Liste des absences :</h4>
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Id</th>
                            <th>Personnels</th>
                            <th>Téléphone</th>
                            <th>Jour</th>
                            <th>Date Absence</th>
                            <th></th>
                            <th></th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($attendancePersonnels as $attendance)
                          
                        <tr>
                          <td><span>{{ $attendance->personnel->id ?? 'None'}} </span></td>                       
                          <td><span>{{ $attendance->personnel->nom.' '.$attendance->personnel->prenom }}</span></td>                       
                          <td><span>{{ $attendance->personnel->tel1_personnel ?? 'None'}} </span></td>                       
                          <td><span>{{ $attendance->jour ?? 'None' }}  </span></td>                          
                          <td><span>{{ $attendance->attendance_date ?? 'None' }} </span></td>                           
                          <td align="center" style="background-color: rgb(255, 214, 214)">
                            <span class="textPointage">{{ $attendance->attendance_statut ?? 'None' }}</span>
                          </td>
                          <td style="display: none;"><input type="text" name="" value="{{ $attendance->id ?? 'None' }}" class="form-control inputStyle" style="width: 100% !important;" readonly></td>                            
                          <td align="center">
                            <form action="{{ url('delete-attendancePageCreate/'.$attendance->id ?? 'None') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ces données?')">
                              <input type="hidden" name="jour" value="{{ $Jour }}">
                              <input type="hidden" name="attendance_date" value="{{ $DateAttendance }}">
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