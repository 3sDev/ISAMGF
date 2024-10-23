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
/**************************************************/
.crossed
{
  background-image: linear-gradient(to bottom right,  transparent calc(50% - 1px), rgb(173, 173, 173), transparent calc(50% + 1px)); 
}

.styleSemestre{
  color: #ff7b00;
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
                                  <i class="fas fa-calendar"></i> Emploi de Temps -  <span class="styleSemestre">Semestre {{ $mySemestre }}</span>
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
                                            <div class="form-group">
                      
                                              <div id="div1">
                                                <div id="t1" class="myDivToPrint ">
                                                  <center><h4>Emploi du temps professeur: <b>{{ $item->prenom.' '.$item->nom }}</b></h4></center>      
                                                  <table class="table-emploi" style="100% !important;">
                                                    
                                                    <tr>
                                                      <td class= "jours"
                                                          rowspan ="6"><code>j<br/>o<br/>u
                                                        <br/>r<br/>s</code></td>
                                                        <td class="lundi"> Lundi </td>
                                                        {{-- Séance Lundi S1 --}}
                                                        @foreach ($teacherEmploiLundi as $emploiLundi)
                                                         
                                                        @if (!is_null($emploiLundi))
                                                          @if ($emploiLundi->type_seance == '15')
                                                            <td class="crossed">
                                                          @else
                                                            <td>
                                                          @endif
                                                            <span class="styleHeure">{{$emploiLundi->heure_debut}} - {{$emploiLundi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiLundi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiLundi->matiere->description}} / {{$emploiLundi->matiere->semestre}}</span></p>
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
                                                          @if ($emploiMardi->type_seance == '15')
                                                            <td class="crossed">
                                                          @else
                                                            <td>
                                                          @endif
                                                            <span class="styleHeure">{{$emploiMardi->heure_debut}} - {{$emploiMardi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiMardi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiMardi->matiere->description}} / {{$emploiMardi->matiere->semestre}}</span></p>
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
                                                          @if ($emploiMercredi->type_seance == '15')
                                                            <td class="crossed">
                                                          @else
                                                            <td>
                                                          @endif
                                                            <span class="styleHeure">{{$emploiMercredi->heure_debut}} - {{$emploiMercredi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiMercredi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiMercredi->matiere->description}} / {{$emploiMercredi->matiere->semestre}}</span></p>
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
                                                          @if ($emploiJeudi->type_seance == '15')
                                                          <td class="crossed">
                                                          @else
                                                            <td>
                                                          @endif
                                                            <span class="styleHeure">{{$emploiJeudi->heure_debut}} - {{$emploiJeudi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiJeudi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiJeudi->matiere->description}} / {{$emploiJeudi->matiere->semestre}}</span></p>
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
                                                          @if ($emploiVendredi->type_seance == '15')
                                                            <td class="crossed">
                                                          @else
                                                            <td>
                                                          @endif
                                                            <span class="styleHeure">{{$emploiVendredi->heure_debut}} - {{$emploiVendredi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiVendredi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiVendredi->matiere->description}} / {{$emploiVendredi->matiere->semestre}}</span></p>
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
                                                          @if ($emploiSamedi->type_seance == '15')
                                                            <td class="crossed">
                                                          @else
                                                            <td>
                                                          @endif
                                                            <span class="styleHeure">{{$emploiSamedi->heure_debut}} - {{$emploiSamedi->heure_fin}}</span>
                                                            <p class="styleMatiere">{{$emploiSamedi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiSamedi->matiere->description}} / {{$emploiSamedi->matiere->semestre}}</span></p>
                                                            <p class="styleProf">{{$emploiSamedi->classe->abbreviation}}</p>
                                                            <p class="styleSalle">{{$emploiSamedi->salle->fullName}}</p>
                                                          </td>
                                                        @else
                                                        <td class="silver"><br><br><br></td>
                                                        @endif
                                                            
                                                        @endforeach
                                                        
                                                      </tr>
                                                    </table>
                                                  
                                                </div>  
                                                </div>
                                                <!-- partial -->
                      
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
                                                <td class="text-center">
                                                  <form action="{{ url('deleteSeanceSemestre/'.$emploit->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fas fa-trash"></i></button>
                        
                                                  </form>
                                                </td>
                                                
                                              </tr>
                                              @endforeach
                                            </tbody>
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
                                      <form action="{{ url('seance-teacher') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cette séance?')" enctype="multipart/form-data">
          
                                        @csrf
                                        {{-- @method('PUT') --}}
                                            <div class="row">
                                              <div class="col-md-2">
                                                <label for="">Semestre</label>
                                                <input type="text" id="semestre" name="semestre" value="{{ $mySemestre }}" class="form-control" readonly>
                                              </div>
                                                <div class="col-md-3">
                                                  <label for="">Choisir classe</label>
                                                  <select name="classe_id" id="classes" class="form-control" required>
                                                    <option value="" selected disabled>Selectionner Classe</option>
                                                      @foreach ($classes as $classe)
                                                          <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Choisir matière</label>
                                                    <select name="matiere_id" id="matiere" data-style="btn btn-primary" required class="form-control" required>
                                                      <option value="">Selectionner Matiére</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3" style="display: nonee;">
                                                  <label for="">Type Séance</label>
                                                  <select id="type_seance" name="type_seance" class="form-control" >
                                                    <option value="1" selected>full-time</option>
                                                    <option value="15">1/2 time(par quinzaine)</option>
                                                  </select>
                                                  {{-- <input type="time" class="form-control" step="1800" name="heure_debut" id="heure_debut" required> --}}
                                                </div>
                                            </div>
                                            <br><hr>
                                            <div class="row">
                                               
                                                
                                                <div class="col-md-3">
                                                  <label for="">Heure Debut</label>
                                                  <select id="heure_debut" name="heure_debut" class="form-control" required>
                                                    <option value="">Séléctionner heure début</option>
                                                    <option value="08:30">08:30</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                </select>
                                                </div>
                                                <div class="col-md-3">
                                                  <label for="">Heure Fin</label>
                                                  <select id="heure_fin" name="heure_fin" class="form-control" required>
                                                    <option value="">Séléctionner heure fin</option>
                                                    <option value="09:00">09:00</option>
                                                    <option value="09:30">09:30</option>
                                                    <option value="10:00">10:00</option>
                                                    <option value="10:30">10:30</option>
                                                    <option value="11:00">11:00</option>
                                                    <option value="11:30">11:30</option>
                                                    <option value="12:00">12:00</option>
                                                    <option value="12:30">12:30</option>
                                                    <option value="13:00">13:00</option>
                                                    <option value="13:30">13:30</option>
                                                    <option value="14:00">14:00</option>
                                                    <option value="14:30">14:30</option>
                                                    <option value="15:00">15:00</option>
                                                    <option value="15:30">15:30</option>
                                                    <option value="16:00">16:00</option>
                                                    <option value="16:30">16:30</option>
                                                    <option value="17:00">17:00</option>
                                                    <option value="17:30">17:30</option>
                                                  </select>    
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
                                                  <select name="salle" id="salle" class="form-control" data-dependent="jour" required>
                                                    <option value="">Selectionner Salle</option>
          
                                                      {{--@foreach ($salles as $salle)
                                                          <option value="{{ $salle->id }}"> {{ $salle->fullName }}</option>
                                                      @endforeach--}}
          
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
    var semestreSelect = $("#semestre").val();
      
      if (semestreSelect == 1) {
        semestre = "S1";
      }
      if (semestreSelect == 2) {
        semestre = "S2";
      }

      if (classeID) {
        $.ajax({
            type: "GET",
            url: "{{ url('getMatiere') }}?classe_id=" + classeID+"&semestre=" + semestre,
            success: function(res) {

                if (res) {

                    $("#matiere").empty();
                    $("#matiere").append('<option value="" selected disabled>Selectionner Matière</option>');

                    res.map(element=>{
                      $("#matiere").append('<option value="'+element.matiere_id+'">' + element.subjectLabel +'<b>('+element.description+'/'+element.semestre+')</b></option>');
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

// when séance dropdown changes
$('#jour').change(function() {
    var day = $("#jour").val();
    var heure_debut = $("#heure_debut").val();
    var heure_fin   = $("#heure_fin").val();
    var type_seance = $("#type_seance").val();
    var semestre    = $("#semestre").val();

    if(!heure_debut){alert('Saisir Heure Début'); return;}
    if(!heure_fin){alert('Saisir Heure Fin'); return;}
    if(!type_seance){alert('Saisir le type de séance'); return;}
    console.log("semestre is:"+semestre);

    $.ajax({
        type: "GET",
        url: "{{ url('disponibiliteSallesSeancesSemestre') }}/"+ heure_debut+"/" + heure_fin+"/" + day+"/" + type_seance+"/" + semestre,
        success: function(res) {

            if (res) {
            console.log(res);
                $("#salle").empty();
                $("#salle").append('<option value="" selected disabled>Selectionner Salle</option>');
                
                res.map(element=>{
                $("#salle").append('<option value="'+element.id+'">' + element.fullNAme + '</option>');
                })

            } else {
                $("#salle").empty();
            }
        }
    });
    
});

</script>


<script>
  $(document).ready(function() {   
      function verifyInputSeance() {
  
          //get values
          var valuestart = $("select[name='heure_debut']").val();
          var valuestop = $("select[name='heure_fin']").val();
  
          var splitted1 = valuestart.split(":");
          var splitted2 = valuestop.split(":");
  
          var splitted1ToIntP1 = parseFloat(splitted1[0]);
          var splitted1ToIntP2 = parseFloat(splitted1[1]);
  
          var splitted2ToIntP1 = parseFloat(splitted2[0]);
          var splitted2ToIntP2 = parseFloat(splitted2[1]);
  
          if (splitted1ToIntP1 > splitted2ToIntP1) {
              alert('Erreur: Date début du séance est supérieur à la date fin!!');
          }
          else{
              $("#messageTestSeance").html('<span></span>' )  
          }
      }
      $("select").change(verifyInputSeance);
      verifyInputSeance();
  });
</script>
<script>
    $(document).ready(function() {   
      function calculateTime() {
  
          //get values
          var valuestart = $("select[name='heure_debut']").val();
          var valuestop = $("select[name='heure_fin']").val();
  
          var splitted1 = valuestart.split(":");
          var splitted2 = valuestop.split(":");
  
          var splitted1ToIntP1 = parseFloat(splitted1[0]);
          var splitted1ToIntP2 = parseFloat(splitted1[1]);
  
          var splitted2ToIntP1 = parseFloat(splitted2[0]);
          var splitted2ToIntP2 = parseFloat(splitted2[1]);
  
          var sommeSplite1 = (splitted1ToIntP1 * 60) + splitted1ToIntP2;
          var sommeSplite2 = (splitted2ToIntP1 * 60) + splitted2ToIntP2;
  
          var resf = (sommeSplite2 - sommeSplite1) / 60;
          var resFinal = parseFloat(resf.toFixed(1));
  
      $("#iputresult").html('<input type="text" name="duree" id="result" value="'+resFinal+'" class="form-control" readonly>' )             
  
      }
      $("select").change(calculateTime);
      calculateTime();
  });
</script>
@endsection