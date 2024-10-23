@extends('adminlayoutenseignant.layout')
@section('title', 'Présence Enseignant')
@section('contentPage')
 

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>

code {
   
   display: inline-block;
  vertical-align: middle;
  font-size:20px; 
}

.form-control{
  width: 100% !important;
}

div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em !important;
    /* display: inline-block; */
    width: 70% !important;
}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #ff7b00 !important;
}
/**********   style séance    ***************/
.styleMatiere{
  font-size: 14px;
  font-weight: 600;
  color: black;
  margin-bottom: -1%;
  line-height: 12pt;
}
.styleProf{
  font-size: 14px;
  font-weight: 400;
  color: rgb(167, 167, 167);
  margin-bottom: -1%;
}
.styleSalle{
  font-size: 13px;
  font-weight: 600;
  color: rgb(197, 70, 12);
  margin-bottom: -2%;
}
.typeMatiere{
  color: #399216;
}
/********* Imprimer emploi du temps **********/
@media print {
    .myDivToPrint {
        background-color: white;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        margin: 0;
        padding: 15px;
        font-size: 14px;
        line-height: 18px;
    }
}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Présences enseignant</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('presences') }}">Gestion des enseignants (Présences)</a></li>
          <li class="breadcrumb-item active">Présences enseignant</li>
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
                      <h3 class="card-title">Présence enseignant
                      </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    @foreach ($teachers as $item)

                    <div class="col-12">
                      <!-- Main content -->
                      <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                          <div class="col-12">
                            <h4>
                              <i class="fas fa-briefcase"></i> Enseignant
                              <small class="float-right"> </small>
                            </h4>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                          <div class="col-sm-4 invoice-col">
                            <p class="lead">Informations personnels</p>
                            <address>
                              {{ $item->prenom.' '.$item->nom }}<br>
                              {{ $item->prenom_ar.' '.$item->nom_ar }}<br>
                              <strong>CIN :</strong> {{ $item->cin }}<br>
                              <strong>Email :</strong> {{ $item->email }}<br>
                              <strong>Active :</strong> {{ $item->active }}
                            </address>
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 invoice-col">
                            <p class="lead">Adresse Enseignant</p>
                            <address>
                              <strong>Code Postal:</strong> {{ $item->codepostal_teacher }}<br>
                              <strong>Gouvernorat :</strong> {{ $item->gov }}<br>
                              <strong>Rue :</strong> {{ $item->rue_teacher }}<br>
                              <strong>Date naissance :</strong> {{ $item->ddn }}<br>
                              <strong>Téléphone :</strong> {{ $item->tel1_teacher }}<br>
                            </address>
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 invoice-col">
                            <p class="lead">Photo Enseignant</p>
                            
                            <img class="img-circle" src={{ asset('https://cdn-icons-png.flaticon.com/512/36/36585.png') }} width="100px" alt="Teacher">
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <br><hr><br>
                        <div class="row">
                          <div class="col-12">
                            <h4>
                              <i class="fas fa-file"></i> Sasir une nouvelle absence
                              <small class="float-right"> </small>
                            </h4><br>
                          </div>
                          <div class="col-12">
                            {{-- https://smartschools.tn/university/public/upload/events/ --}}
                            <form action="{{ url('save-attendance') }}" method="POST" enctype="multipart/form-data">

                              @csrf
                              {{-- @method('PUT') --}}
                                  <br>
                                  <div class="row">
                                    <input type="text" name="teacher_id" style="display: none;" value="{{ $item->id }}" id="teacher_id">

                                    <div class="col-md-3"></div>
                                      <div class="col-md-3">
                                        <label for="">Date d'absence</label>
                                        <input type="date" class="form-control" name="attendance_date">
                                      </div>
                                      <div class="col-md-3">
                                      <center>
                                        <label for="">&nbsp;</label><br>
                                        <button type="submit" class="btn btn-primary float-center">Ajouter</button>
                                      </center>
                                    </div>
                                    <div class="col-md-3"></div>
                                  </div>
                                  <br><br>
                             
                              </form>
                            <br><hr><br>
                            <div class="row">
                              <div class="col-12">
                                <h4>
                                  <i class="fas fa-calendar"></i> Liste des absences
                                  <small class="float-right"> </small>
                                </h4>
                              </div>
                            </div><br>

                                  <div class="tab-content" id="pills-tabContent">

                                      <div class="col-lg-12" style="text-align:left !important;">
                                        <div class="form-group">
                                          <br><br>
                                          <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="8%">ID</th>
                                                    <th width="15%">Date d'absence</th>
                                                    <th width="25%">Justification</th>
                                                    <th width="15%">Date Justification</th> 
                                                    <th width="5%">Modifier</th>
                                                    <th width="5%">Supprimer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach ($attendances as $attendance)
                                                
                                              <tr>
                                                {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                                                <td>{{ $attendance->id }}</td>
                                                <td>{{ $attendance->attendance_date }}</td>
                                                <td>{{ $attendance->justification }}</td>
                                                <td>{{ $attendance->date_justification }}</td>

                                                <td class="text-center">
                                                  <a href="{{ url('edit-presence/'.$attendance->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                </td>
                                                <td class="text-center">
                                                  <form action="{{ url('delete-attendance/'.$attendance->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
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
                                                    <th width="8%">ID</th>
                                                    <th width="15%">Date d'absence</th>
                                                    <th width="25%">Justification</th>
                                                    <th width="15%">Date Justification</th> 
                                                    <th width="5%">Modifier</th>
                                                    <th width="5%">Supprimer</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                    
                                        </div>
                                      </div>
                                  </div>

                                

                              </div>
                            </div>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
        
                      </div>
                    </div>
                    @endforeach
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
    <!-- Script to print the content of a div -->

@endsection