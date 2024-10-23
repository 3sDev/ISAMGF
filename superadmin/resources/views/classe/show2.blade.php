@extends('adminlayoutenseignant.layout')
@section('title', 'Emploi de temps Enseignant')
@section('contentPage')
 

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.btn-link{
  color:white;
}
#div1{
  margin:auto;
  width:100%;
  padding:100px;
}

#t1 {
  display: inline-block;
  vertical-align: top;
}

.table-emploi{
  border-collapse: collapse;
 }

th, td {
  border: 1px solid #272727;
  padding: 7px;
  text-align: center;
  color:#6e83e0;
  font-weight:bold;
}

th {
  color: White;
  background-color: #575d77;
  
}

th.horaire{
  background-color: #696969;
  color:
}


.silver {
  background-color: silver;
}
.vide{
  background-color: #696969;
  width:5px;
}

td:first-child,td.lundi {
  background-color:#575d77;
  color: white;
  font-weight: bold;
  text-align: center;
  width:100px;
  
}

td.jours{
  background-color: #696969;
  width : 30px;
}

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
/************************/
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
  color: rgb(151, 48, 0);
  margin-bottom: -2%;
}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Emploi de temps Enseignant</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Emploi de temps Enseignant</li>
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
                      <h3 class="card-title">Emploi de temps Enseignant
                      </h3>
                      <a href="{{ url('teachers/create') }}" class="btn btn-primary float-right">Ajouter</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="col-12">
                      <!-- Main content -->
                      <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                          <div class="col-12">
                            <h4>
                              <i class="fas fa-briefcase"></i> Emploi du groupe
                              <small class="float-right"> </small>
                            </h4>

                          

                          </div>
                          <!-- /.col -->
                        </div>                       
                        <!-- /.row -->
                        <br><hr><br>
                        <div class="row">
                          <div class="col-12">
                           
                            <br><hr><br>
                            <div class="row">
                              <div class="col-12">
                                <h4>
                                  <i class="fas fa-calendar"></i> Emploi de Temps
                                  <small class="float-right"> </small>
                                </h4>
                              </div>

                            </div><br>
                                  <div class="container-tab">
                                  <ul class="nav nav-pills mb-6" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Emploi de temps</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Liste des séances</a>
                                    </li>
                                  </ul>
                                </div>

                                  <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                      <div class="col-lg-12" style="text-align:left !important;">      
                                            <div class="form-group">
                      
                                              <div id="div1">
                                                <div id="t1">
              
                                                  <table class="table-emploi" style="100% !important;">
                                                    
                                                    <tr>
                                                      <th style="border: 0 none; opacity:0"></th>
                                                      <th style="border: 0 none; opacity:0"></th>
                                                      <th colspan= "8" class="horaire" >Horaires</th>
                                                    <tr>
                                                      <th style="border: 0 none; opacity:0"></th>
                                                      <th style="border: 0 none; opacity:0"></th>
                                                      <th width="16%"> 08:30 - 10:00 </th>
                                                      <th width="16%"> 10:05 - 11:35 </th>
                                                      <th width="16%"> 11:40 - 13:10 </th>
                                                      <th width="4%"></th>
                                                      <th width="16%"> 13:15 - 14:45 </th>
                                                      <th width="16%"> 14:50 - 16:20 </th>
                                                      <th width="16%"> 16:25 - 17:55 </th>
                                                      
                                                    </tr>
                                                    </tr>
                                                    <tr>
                                                      <td class= "jours"
                                                          rowspan ="6"><code>j<br/>o<br/>u
                                                        <br/>r<br/>s</code></td>
                                                      <td class="lundi"> Lundi </td>
                                                      {{-- Séance Lundi S1 --}}
                                                      @foreach ($classeEmploiLundi as $emploiLundi)
                                                       
                                                      @if (!is_null($emploiLundi) && $emploiLundi!='vide')
                                                        <td>
                                                          <p>classe: {{$emploiLundi->heure}}</p>
                                                        </td>
                                                      @elseif(is_null($emploiLundi))
                                                        <td class="silver"></td>
                                                      @else
                                                        <td class="vide"></td>
                                                      @endif
                                                          
                                                      @endforeach
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td class="mardi"> Mardi </td>

                                                      @foreach ($classeEmploiMardi as $emploiMardi)
                                                       
                                                      @if (!is_null($emploiMardi) )
                                                        <td>
                                                          <p>classe: {{$emploiMardi->heure}}</p>
                                                        </td>
                                                      @elseif(is_null($emploiMardi))
                                                        <td class="silver"></td>
                                                      @else
                                                        <td class="vide"></td>
                                                      @endif
                                                          
                                                      @endforeach
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td> Mercredi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      {{-- <td class="vide"></td> --}}
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td> Jeudi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      {{-- <td class="vide"></td> --}}
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                
                                                    </tr>
                                                    <tr>
                                                      <td> Vendredi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      {{-- <td class="vide"></td> --}}
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                
                                                    </tr>
                                                    <tr>
                                                      <td> Samedi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      {{-- <td class="vide"></td> --}}
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      
                                                    </tr>
                                                  </table>
                                                  
                                                </div>  
                                                </div>
                                                <!-- partial -->
                      
                                              </div>
                                          </div>
                                    </div>

                                    <div class="tab-pane show fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                      <div class="col-lg-12" style="text-align:left !important;">
                                        <div class="form-group">
                                          <br><br><br>
                                          <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">ID</th>
                                                    <th width="25%">Classe</th>
                                                    <th width="15%">Matières</th>
                                                    <th width="8%">Salle</th> 
                                                    <th width="8%">Jour</th> 
                                                    <th width="10%">Heure</th> 
                                                    <th width="7%">Modifier</th>
                                                    <th width="5%">Supprimer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach ($classeEmploi as $emploit)
                                                
                                              <tr>
                                                {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                                                <td>{{ $emploit->id }}</td>
                                                <td>{{ $emploit->teacher->nom.' '.$emploit->teacher->prenom }}</td>
                                                <td>{{ $emploit->matiere->subjectLabel }}</td>
                                                <td>{{ $emploit->salle->fullName }}</td>
                                                <td>{{ $emploit->jour }}</td>
                                                <td>{{ $emploit->heure }}</td>

                                                <td class="text-center">
                                                  <a href="{{ url('editseance/'.$emploit->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                                </td>
                                                <td>
                                                  <form action="{{ url('deleteseance/'.$emploit->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
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
                                                  <th width="5%">ID</th>
                                                  <th width="20%">Classe</th>
                                                  <th width="12%">Matières</th>
                                                  <th width="8%">Salle</th> 
                                                  <th width="8%">Jour</th> 
                                                  <th width="10%">Heure</th> 
                                                  <th width="10%">Actions</th>
                                                  <th width="10%" class="disabled-sorting text-left"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                    
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                

                              </div>
                            </div>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
        
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                          <div class="col-12">
                            <br><br><a href="#" onclick="window.print();return false;" rel="noopener" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
                          </div>
                        </div>
                      </div>
                    </div>
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