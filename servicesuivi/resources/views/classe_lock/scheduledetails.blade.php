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
                            
                            <img class="img-circle" src={{ asset('https://smartschools.tn/issat/storage/teacher.jpg') }} width="120px" alt="Student Image">
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <br><hr><br>
                        <!-- Table row -->
                        <div class="row">
                          <h4>
                            <i class="fas fa-globe"></i> Fiche de voeux
                            <small class="float-right"> </small>
                          </h4><br>
                          <div class="col-12 table-responsive">
                            <table class="table table-striped">
                              <thead>
                              <tr>
                                <th width="20%">Semestre</th>
                                <th width="60%">Jour(s) préferé(s)</th>
                                <th width="20%">Date de création</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                {{-- @foreach ($voeux as $voeu) --}}
                                <td>1</td>
                                <td>Lundi, Mardi, Mercredi</td>
                                <td></td>
                                    {{-- <td>{{ $voeu->semestre }}</td>
                                    <td>{{ $voeu->jour }}</td>
                                    <td>{{ $voeu->created_at }}</td> --}}
                                {{-- @endforeach --}}
                              </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <br><hr><br>
                        <div class="row">
                          <div class="col-12">
                            <h4>
                              <i class="fas fa-file"></i> Ajouter une séance
                              <small class="float-right"> </small>
                            </h4><br>
                          </div>
                          <div class="col-12">
                            {{-- https://smartschools.tn/university/public/upload/events/ --}}
                            <form action="{{ url('seance-teacher') }}" method="POST" enctype="multipart/form-data">

                              @csrf
                              {{-- @method('PUT') --}}
                                  <div class="row">
                                      <div class="col-md-6">
                                        <label for="">Choisir classe</label>
                                        <select name="classe_id" class="form-control" required>
                                            @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}"> {{ $classe->classeName }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                      <div class="col-md-6">
                                          <label for="">Choisir matière</label>
                                          <select name="matiere_id" class="form-control" required>
                                              @foreach ($matieres as $matiere)
                                                  <option value="{{ $matiere->id }}"> {{ $matiere->subjectLabel }} <b>({{ $matiere->description }})</b></option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <br><hr>
                                  <div class="row">
                                      <div class="col-md-6">
                                        <label for="">Choisir salle</label>
                                        <select name="salle_id" class="form-control" required>
                                            @foreach ($salles as $salle)
                                                <option value="{{ $salle->id }}"> {{ $salle->fullName }}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                      <div class="col-md-3">
                                        <label for="">Jour</label>
                                        <select name="jour" id="" class="form-control">
                                          <option value="Lundi">Lundi</option>
                                          <option value="Mardi">Mardi</option>
                                          <option value="Merdcredi">Merdcredi</option>
                                          <option value="Jeudi">Jeudi</option>
                                          <option value="Vendredi">Vendredi</option>
                                          <option value="Samedi">Samedi</option>
                                        </select>
                                      </div>
                                      <div class="col-md-3">
                                        <label for="">Heure</label>
                                          <select name="heure" id="" class="form-control">
                                            <option value="08:30-10:00">08:30-10:00</option>
                                            <option value="10:05-11:35">10:05-11:35</option>
                                            <option value="11:40-13:10">11:40-13:10</option>
                                            <option value="13:15-14:45">13:15-14:45</option>
                                            <option value="14:50-16:20">14:50-16:20</option>
                                            <option value="16:25:17:55">16:25:17:55</option>
                                          </select>
                                      </div>
                                  </div>
                                  <br><br>
                                  <input type="text" name="teacher_id" style="display: none;" value="{{ $item->id }}" id="teacher_id">
                                  <div class="mb-3">
                                    <center>
                                      <button type="submit" class="btn btn-primary float-center">Ajouter</button>
                                    </center>
                                  </div>
                             
                              </form>
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
                                                  {{-- <table class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr><th colspan= "8" class="horaire" >Horaires</th></tr>
                                                        <tr>
                                                            <th width="16.66%">08:30 - 10:00</th>
                                                            <th width="16.66%">10:05 - 11:35</th>
                                                            <th width="16.66%">11:40 - 13:10</th>
                                                            <th width="16.66%">13:15 - 14:45 </th> 
                                                            <th width="16.66%">14:50 - 16:20</th>
                                                            <th width="16.66%">16:25 - 17:55</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      @foreach ($teacherEmploi as $emploit)
                                                        
                                                      <tr>
                                                        @if (($emploit->jour == 'Lundi' && $emploit->heure == '08:30-10:00'))
                                                        <td>
                                                          <p>classe: {{$emploit->classe_id}}</p>
                                                          <p>matiere: {{$emploit->matiere_id}}</p>
                                                          <p>salle: {{$emploit->salle_id}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"></td>
                                                      @endif
                                                      @if (($emploit->jour == 'Lundi' && $emploit->heure == '10:05-11:35'))
                                                        <td>
                                                          <p>classe: {{$emploit->classe_id}}</p>
                                                          <p>matiere: {{$emploit->matiere_id}}</p>
                                                          <p>salle: {{$emploit->salle_id}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"></td>
                                                      @endif
                                                      @if (($emploit->jour == 'Lundi' && $emploit->heure == '11:40-13:10'))
                                                        <td>
                                                          <p>classe: {{$emploit->classe_id}}</p>
                                                          <p>matiere: {{$emploit->matiere_id}}</p>
                                                          <p>salle: {{$emploit->salle_id}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"></td>
                                                      @endif
                                                      @if (($emploit->jour == 'Lundi' && $emploit->heure == '13:15-14:45'))
                                                        <td>
                                                          <p>classe: {{$emploit->classe_id}}</p>
                                                          <p>matiere: {{$emploit->matiere_id}}</p>
                                                          <p>salle: {{$emploit->salle_id}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"></td>
                                                      @endif
                                                      @if (($emploit->jour == 'Lundi' && $emploit->heure == '14:50-16:20'))
                                                        <td>
                                                          <p>classe: {{$emploit->classe_id}}</p>
                                                          <p>matiere: {{$emploit->matiere_id}}</p>
                                                          <p>salle: {{$emploit->salle_id}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"></td>
                                                      @endif
                                                      @if (($emploit->jour == 'Lundi' && $emploit->heure == '16:25:17:55'))
                                                        <td>
                                                          <p>classe: {{$emploit->classe_id}}</p>
                                                          <p>matiere: {{$emploit->matiere_id}}</p>
                                                          <p>salle: {{$emploit->salle_id}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"></td>
                                                      @endif
                                                      </tr>
                                                      @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                          <th width="16.66%">Lundi</th>
                                                          <th width="16.66%">Mardi</th>
                                                          <th width="16.66%">Mercredi</th>
                                                          <th width="16.66%">Jeudi</th> 
                                                          <th width="16.66%">Vendredi</th>
                                                          <th width="16.66%">Samedi</th>
                                                        </tr>
                                                    </tfoot>
                                                </table> --}}
              
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
                                                      @foreach ($teacherEmploi as $emploit)
                                                      {{-- @if ($emploit->jour == 'Lundi' && $emploit->heure == '08:30-10:00')
                                                        <td class="">bb</td>
                                                      @endif --}}
                                                      @if (!($emploit->jour == 'Lundi' && $emploit->heure == '08:30-10:00'))
                                                        <td class="silver">aa</td>
                                                      @endif
                                                      @endforeach
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="vide"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td> Mardi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="vide"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td> Mercredi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="vide"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td> Jeudi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="vide"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                
                                                    </tr>
                                                    <tr>
                                                      <td> Vendredi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="vide"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                
                                                    </tr>
                                                    <tr>
                                                      <td> Samedi </td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="silver"></td>
                                                      <td class="vide"></td>
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
                                              @foreach ($teacherEmploi as $emploit)
                                                
                                              <tr>
                                                {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                                                <td>{{ $emploit->id }}</td>
                                                <td>{{ $emploit->classe->classeName }}</td>
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

@endsection