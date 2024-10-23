@extends('adminlayoutenseignant.layout')
@section('title', 'Emploi de temps Enseignant')
@section('contentPage')

@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.btn-link{
  color:white;
}
#div1{
  margin:auto;
  width:100%;
  margin-top: 5% !important;
  /* padding:100px; */
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
  background-color: rgb(230, 230, 230);}
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
/**************************************************/
.rotation {
    animation: zoom-in-zoom-out 3s ease infinite;
}

@keyframes zoom-in-zoom-out {
  0% {
    transform: scale(1, 1);
  }
  50% {
    transform: scale(1.5, 1.5);
  }
  100% {
    transform: scale(1, 1);
  }
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
              {{-- <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Emploi de temps Enseignant
                      </h3>
                  </div> --}}
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
                            <address>
                              <strong>Nom et prénom(Fr) :</strong> {{ $item->prenom.' '.$item->nom }}<br>
                              <strong>Type compte :</strong> @if (($item->active == '0'))
                              <button type="submit" class="btn btn-link btn-warning btn-just-icon edit btn-sm">Désactivé</button>
                              @endif
                              @if (($item->active == '1'))
                              <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm">Activé</button>
                              @endif
                              @if (($item->active == '2'))
                              <button type="submit" class="btn btn-link btn-danger btn-just-icon edit btn-sm">Fin Vacation</button>
                              @endif
                              @if (($item->active == '3'))
                              <button type="submit" class="btn btn-link btn-danger btn-just-icon edit btn-sm">Fin Contractuel</button>
                              @endif
                              @if (($item->active == '4'))
                              <button type="submit" class="btn btn-link btn-secondary btn-just-icon edit btn-sm">Fin Expert</button>
                              @endif
                              @if (($item->active == '5'))
                              <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm">Mutation</button>
                              @endif
                              @if (($item->active == '6'))
                              <button type="submit" class="btn btn-link btn-info btn-just-icon edit btn-sm">Retraite</button>
                              @endif
                              @if (($item->active == '7'))
                              <button type="submit" class="btn btn-link btn-warning btn-just-icon edit btn-sm">Coopération</button>
                              @endif
                            </address>
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 invoice-col">
                            <address>
                              <strong>Email :</strong> {{ $item->email }}<br>
                              <strong>Téléphone :</strong> {{ $item->tel1_teacher }}<br>
                            </address>
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 invoice-col">
                            <img class="img-circle" src={{ asset($upload.'/teachers/'.$item->profile_image) }} width="60px" alt="">
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        
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
                                        <a class="nav-link" id="pills-emploi-tab" data-toggle="pill" href="#pills-emploi" role="tab" aria-controls="pills-emploi" aria-selected="false">Emploi de temps (image)</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="pills-seance-tab" data-toggle="pill" href="#pills-seance" role="tab" aria-controls="pills-seance" aria-selected="false">Liste des séances</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="pills-voeux-tab" data-toggle="pill" href="#pills-voeux" role="tab" aria-controls="pills-voeux" aria-selected="false">Fiche des voeux</a>
                                      </li>

                                    </ul>
                                </div>

                                  <div class="tab-content" id="pills-tabContent">

                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                      <div class="col-lg-12" style="text-align:left !important;">      
                                            <div class="form-group" id="myPrint" style="background-color: white">
                      
                                              <div id="div1">
                                                <div id="t1" class="myDivToPrint ">
                                                  <br>
                                                  <center><h4>Emploi du temps enseignant: <b>{{ $item->prenom.' '.$item->nom }}</b></h4></center>      
                                                  <br>
                                                  <table class="table-emploi" style="100% !important;">
                                                    
                                                    <tr>
                                                      <td class= "jours"
                                                          rowspan ="6"><code>j<br/>o<br/>u
                                                        <br/>r<br/>s</code></td>
                                                        <td class="lundi"> Lundi </td>
                                                        {{-- Séance Lundi S1 --}}
                                                        @foreach ($teacherEmploiLundi as $emploiLundi)
                                                         
                                                        @if (!is_null($emploiLundi))
                                                          <td>
                                                            <span class="styleHeure">{{$emploiLundi->heure_debut}} - {{$emploiLundi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiLundi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiLundi->matiere->description}}</span></p>
                                                            <p class="styleProf">{{$emploiLundi->classe->abbreviation}}</p>
                                                            <p class="styleSalle">{{$emploiLundi->salle->fullName}}</p>
                                                          </td>
                                                        @else
                                                          <td class="silver"><br><br><br></td>
                                                        @endif
                                                            
                                                        @endforeach
                                                        
                                                      </tr>
                                                      <tr>
                                                        <td class="mardi"> Mardi </td>
  
                                                        @foreach ($teacherEmploiMardi as $emploiMardi)
                                                         
                                                        @if (!is_null($emploiMardi) )
                                                          <td>
                                                            <span class="styleHeure">{{$emploiMardi->heure_debut}} - {{$emploiMardi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiMardi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiMardi->matiere->description}}</span></p>
                                                            <p class="styleProf">{{$emploiMardi->classe->abbreviation}}</p>
                                                            <p class="styleSalle">{{$emploiMardi->salle->fullName}}</p>
                                                          </td>
                                                        @else
                                                          <td class="silver"><br><br><br></td>
                                                        @endif
                                                            
                                                        @endforeach
                                                        
                                                      </tr>
                                                      <tr>
                                                        <td class="mercredi"> Mercredi </td>
  
                                                        @foreach ($teacherEmploiMercredi as $emploiMercredi)
                                                         
                                                        @if (!is_null($emploiMercredi) )
                                                          <td>
                                                            <span class="styleHeure">{{$emploiMercredi->heure_debut}} - {{$emploiMercredi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiMercredi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiMercredi->matiere->description}}</span></p>
                                                            <p class="styleProf">{{$emploiMercredi->classe->abbreviation}}</p>
                                                            <p class="styleSalle">{{$emploiMercredi->salle->fullName}}</p>
                                                          </td>
                                                        @else
                                                          <td class="silver"><br><br><br></td>
                                                        @endif
                                                            
                                                        @endforeach
                                                        
                                                      </tr>
                                                      <tr>
                                                        <td class="jeudi"> Jeudi </td>
  
                                                        @foreach ($teacherEmploiJeudi as $emploiJeudi)
                                                         
                                                        @if (!is_null($emploiJeudi) )
                                                          <td>
                                                            <span class="styleHeure">{{$emploiJeudi->heure_debut}} - {{$emploiJeudi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiJeudi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiJeudi->matiere->description}}</span></p>
                                                            <p class="styleProf">{{$emploiJeudi->classe->abbreviation}}</p>
                                                            <p class="styleSalle">{{$emploiJeudi->salle->fullName}}</p>
                                                          </td>
                                                        @else
                                                          <td class="silver"><br><br><br></td>
                                                        @endif
                                                            
                                                        @endforeach
                                                  
                                                      </tr>
                                                      <tr>
                                                        <td class="vendredi"> Vendredi </td>
  
                                                        @foreach ($teacherEmploiVendredi as $emploiVendredi)
                                                         
                                                        @if (!is_null($emploiVendredi) )
                                                          <td>
                                                            <span class="styleHeure">{{$emploiVendredi->heure_debut}} - {{$emploiVendredi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiVendredi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiVendredi->matiere->description}}</span></p>
                                                            <p class="styleProf">{{$emploiVendredi->classe->abbreviation}}</p>
                                                            <p class="styleSalle">{{$emploiVendredi->salle->fullName}}</p>
                                                          </td>
                                                        @else
                                                          <td class="silver"><br><br><br></td>
                                                        @endif
                                                            
                                                        @endforeach
                                                  
                                                      </tr>
                                                      <tr>
                                                        <td class="samedi"> Samedi </td>
  
                                                        @foreach ($teacherEmploiSamedi as $emploiSamedi)
                                                         
                                                        @if (!is_null($emploiSamedi) )
                                                          <td>
                                                            <span class="styleHeure">{{$emploiSamedi->heure_debut}} - {{$emploiSamedi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiSamedi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiSamedi->matiere->description}}</span></p>
                                                            <p class="styleProf">{{$emploiSamedi->classe->abbreviation}}</p>
                                                            <p class="styleSalle">{{$emploiSamedi->salle->fullName}}</p>
                                                          </td>
                                                        @else
                                                        <td class="silver"><br><br><br></td>
                                                        @endif
                                                            
                                                        @endforeach
                                                        
                                                      </tr>
                                                    </table>
                                                    <br><br>
                                                </div>  
                                                </div>
                                                <!-- partial -->
                                              </div>
                                                <button id="convert" class="btn btn-success">
                                                  Télécharger Emploi
                                                  </button>
                                                  <div id="result">
                                                      <!-- Result will appear be here -->
                                                  </div>
                                          </div>
                                    </div>

                                    <div class="tab-pane show fade" id="pills-emploi" role="tabpanel" aria-labelledby="pills-emploi-tab">
                                      <div class="col-lg-12" style="text-align:left !important;">
                                        <div class="form-group">
                                          <br><br><br>
                                          @foreach ($emploiTeacher as $emploiFile)
                                            @if ($emploiFile->fichier)
                                              <center>
                                                <img class="" src={{ asset($upload.'/emploi-teacher-file/'.$emploiFile->fichier) }} width="70%" alt=""><br>
                                              </center>
                                            @endif
                                          @endforeach
                                          <center>
                                            <b>Pour ajouter/modifier un emploi de temps de type image <a href="{{ url('emploi') }}" class="rotation">cliquer ici</a></b>
                                          </center>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="tab-pane show fade" id="pills-seance" role="tabpanel" aria-labelledby="pills-seance-tab">
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
                                                    <th width="6%">Heure_D</th> 
                                                    <th width="6%">Heure_F</th> 
                                                    {{-- <th width="7%">Modifier</th> --}}
                                                    <th width="5%">Supprimer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach ($teacherEmploi as $emploit)
                                                
                                              <tr>
                                                {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                                                <td>{{ $emploit->id }}</td>
                                                <td>{{ $emploit->classe->abbreviation }}</td>
                                                <td>{{ $emploit->matiere->subjectLabel }}</td>
                                                <td>{{ $emploit->salle->fullName }}</td>
                                                <td>{{ $emploit->jour }}</td>
                                                <td>{{ $emploit->heure_debut }}</td>
                                                <td>{{ $emploit->heure_fin }}</td>

                                                {{-- <td class="text-center">
                                                  <a href="{{ url('editseance/'.$emploit->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                                </td> --}}
                                                <td align="center">
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
                                                  <th>ID</th>
                                                  <th>Classe</th>
                                                  <th>Matières</th>
                                                  <th>Salle</th> 
                                                  <th>Jour</th> 
                                                  <th>Heure_D</th> 
                                                  <th>Heure_F</th> 
                                                  {{-- <th width="10%">Actions</th> --}}
                                                  <th class="disabled-sorting text-center"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                    
                                        </div>
                                      </div>
                                    </div>

                                    <div class="tab-pane show fade" id="pills-voeux" role="tabpanel" aria-labelledby="pills-voeux-tab">
                                      <div class="col-lg-12" style="text-align:left !important;">
                                        <div class="form-group">
                                          <div class="row">
                                            <center>
                                              <h5>
                                                Fiche de voeux
                                              </h5>
                                            </center><br>
                                            <div class="col-12 table-responsive">
                                              <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                  <th width="15%">Année universitaire</th>
                                                  <th width="10%">Semestre</th>
                                                  <th width="25%">Jour(s) préferé(s)</th>
                                                  <th width="50%">Matière(s) préferé(s)</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                  @foreach ($voeuxTeachers as $voeu)
                                                  @if ($loop->first)
                                                    <td>{{ $voeu->anneeUniversitaire }}</td>
                                                    <td>{{ $voeu->semestre }}</td>
                                                    <td>{{ $voeu->jourPrefere }}</td>
                                                    <td>
                                                  @endif
                                                    {{ $voeu->nomMatiere }}<span style="color: orangered">({{ $voeu->typeMatiere }})</span><br>
                                                  @endforeach
                                                    </td>
                                                </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                  </div>

                                  <br><hr><br>
                                  <!-- Table row -->
                                  <div class="row">
                                    <div class="col-12">
                                      <h4>
                                        <i class="fas fa-file"></i> Ajouter une séance
                                        <small class="float-right"> </small>
                                      </h4><br>
                                    </div>
                                    <div class="col-12">
                                      {{-- https://smartschools.tn/university/public/upload/events/ --}}
                                      <form action="{{ url('seance-teacher') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Confirmation!')">
          
                                        @csrf
                                        {{-- @method('PUT') --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                  <label for="">Choisir classe</label>
                                                  <select name="classe_id" id="classes" class="form-control" required>
                                                    <option value="" selected disabled>Selectionner Classe</option>
                                                      @foreach ($classes as $classe)
                                                          <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Choisir matière</label>
                                                    <select name="matiere_id" id="matiere" data-style="btn btn-primary" required class="form-control" required>
                                                      <option value="">Selectionner Matière</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br><hr>
                                            <div class="row">
                                              <div class="col-md-3">
                                                <label for="">Heure Debut</label>
                                                <select id="heure_debut" name="heure_debut" class="form-control" required>
                                                  <option value="">Séléctionner heure début</option>
                                                  <option value="08:30">08:30</option>
                                                  <option value="10:00">10:00</option>
                                                  <option value="10:05">10:05</option>
                                                  <option value="11:35">11:35</option>
                                                  <option value="11:40">11:40</option>
                                                  <option value="13:10">13:10</option>
                                                  <option value="13:15">13:15</option>
                                                  <option value="14:45">14:45</option>
                                                  <option value="14:50">14:50</option>
                                                  <option value="16:20">16:20</option>
                                                  <option value="16:25">16:25</option>
                                                </select>
                                                {{-- <input type="time" class="form-control" step="1800" name="heure_debut" id="heure_debut" required> --}}
                                              </div>
                                              <div class="col-md-3">
                                                <label for="">Heure Fin</label>
                                                <select id="heure_fin" name="heure_fin" class="form-control" required>
                                                  <option value="">Séléctionner heure début</option>
                                                  <option value="10:00">10:00</option>
                                                  <option value="10:05">10:05</option>
                                                  <option value="11:35">11:35</option>
                                                  <option value="11:40">11:40</option>
                                                  <option value="13:10">13:10</option>
                                                  <option value="13:15">13:15</option>
                                                  <option value="14:45">14:45</option>
                                                  <option value="14:50">14:50</option>
                                                  <option value="16:20">16:20</option>
                                                  <option value="16:25">16:25</option>
                                                  <option value="17:55">17:55</option>
                                                </select>
                                                {{-- <input type="time" class="form-control" step="1800" name="heure_fin" id="heure_fin" required> --}}
                                              </div>
                                              <div class="col-md-3">
                                                <label for="">Jour</label>
                                                <select name="jour" id="jour" class="form-control" data-dependent="heure" required>
                                                  <option value="">Selectionner Jour</option>
                                                  <option value="Lundi">Lundi</option>
                                                  <option value="Mardi">Mardi</option>
                                                  <option value="Mercredi">Mercredi</option>
                                                  <option value="Jeudi">Jeudi</option>
                                                  <option value="Vendredi">Vendredi</option>
                                                  <option value="Samedi">Samedi</option>
                                                </select>
                                              </div>
                                                <div class="col-md-3">
                                                  <label for="">Choisir salle</label>
                                                  <select name="salle_id" id="salle" class="form-control" required>
                                                    <option value="">Selectionner Salle</option>
                                                    {{-- @foreach ($salles as $salle)
                                                        <option value="{{ $salle->id }}"> {{ $salle->fullName }}</option>
                                                    @endforeach --}}
                                                  </select>
                                                </div>
                                                {{ csrf_field() }}
                                            </div>
                                            <br><br>
                                            <input type="text" name="teacher_id" style="display: none;" value="{{ $item->id }}" id="teacher_id">
                                            <div class="mb-3">
                                              <center>
                                                <button type="submit" class="btn btn-primary float-center">Ajouter</button>
                                              </center>
                                            </div>
                                        </form>
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

<script>
  // when classes dropdown changes
  $('#classes').change(function() {
      var classeID = $(this).val();

      if (classeID) {

          $.ajax({
              type: "GET",
              url: "{{ url('getMatiere') }}?classe_id=" + classeID,
              success: function(res) {

                  if (res) {

                      $("#matiere").empty();
                      $("#matiere").append('<option value="" selected disabled>Selectionner Matière</option>');

                      res.map(element=>{
                        $("#matiere").append('<option value="'+element.matiere_id+'">' + element.subjectLabel +'<b>('+element.description+')</b></option>');
                      });

                  } else {
                      $("#matiere").empty();
                  }
              }
          });
      } else {
          $("#matiere").empty();
      }
  });

  // when jour dropdown changes
  $('#jour').change(function() {
      var jour = $(this).val();
      var salle = $("#salle").val();

      if(!salle){
       alert('Saisir salle');
       return;
      }

      if(!jour){
       alert('Saisir jour');
       return;
      }

      $.ajax({
          type: "GET",
          url: "{{ url('getHeureByDay') }}/"+ salle+"/" + jour,
          success: function(res) {

              if (res) {
              console.log(res);
                  $("#heure").empty();
                  $("#heure").append('<option value="" selected disabled>Selectionner Heure</option>');
                  
                  res.map(element=>{
                    $("#heure").append('<option value="'+element.heure+'">' + element.heure + '</option>');
                  })

              } else {
                  $("#heure").empty();
              }
          }
      });
      
  });


</script>
{{-- <script>
  $(document).ready(function(){

    $('.dynamic').change(function(){
      if ($(this).val() != '') 
      {
        var select    = $(this).attr("id");
        var value     = $(this).val();
        var dependent = $(this).data('dependent');
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url:"{{ route('teachers-schedule.fetch') }}",
          method:"POST",
          data:{select:select, value:value, _token:_token, dependent:dependent},

          success:function(result)
          {
            $('#'+dependent).html(result);
          }
        })
      }
    });

  });
</script> --}}
<script type="text/javascript" src="https://github.com/niklasvh/html2canvas/releases/download/0.5.0-alpha1/html2canvas.js"></script>
<script>
    //convert table to image            
    function convertToImage() {
      var resultDiv = document.getElementById("result");
      html2canvas(document.getElementById("myPrint"), {
          onrendered: function(canvas) {
              var img = canvas.toDataURL("image/jpeg");
              result.innerHTML = '<a download="{{ $item->prenom.' '.$item->nom }}.jpeg" href="'+img+'">{{ $item->prenom.' '.$item->nom }}</a>';
              }
      });
    }        
    //click event
    var convertBtn = document.getElementById("convert");
    convertBtn.addEventListener('click', convertToImage);
</script>
@endsection