@extends('adminlayoutenseignant.layout')
@section('title', 'Emploi de salle')
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
  background-color: rgb(230, 230, 230);
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

</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Emploi de Groupe</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('salledisponible') }}">Liste des salles</a></li>
            <li class="breadcrumb-item active">Emploi de salle</li>
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
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="col-12">
                      <!-- Main content -->
                      <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                          <div class="col-12" style="text-align: center">

                            @foreach ($salleName as $salle)
                            <br>
                              <h5>Nom Salle :
                                 <span style="color: orangered; font-weight:bold;">{{$salle->fullName}}</span>
                              </h5>

                            @endforeach
                            
                          </div>
                          <!-- /.col -->
                        </div>                       
                        <!-- /.row -->
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
                                                      <td class= "jours"
                                                          rowspan ="6"><code>j<br/>o<br/>u
                                                        <br/>r<br/>s</code></td>
                                                      <td class="lundi"> Lundi </td>
                                                      {{-- Séance Lundi S1 --}}
                                                      @foreach ($salleEmploiLundi as $emploiLundi)
                                                       
                                                      @if (!is_null($emploiLundi))
                                                        <td>
                                                          <span class="styleHeure">{{$emploiLundi->heure_debut}} - {{$emploiLundi->heure_fin}}</span>
                                                          <p class="styleMatiere">{{$emploiLundi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiLundi->matiere->description}}</span></p>
                                                          <p class="styleProf">{{$emploiLundi->teacher->nom.' '.$emploiLundi->teacher->prenom}}</p>
                                                          <p class="styleSalle">{{$emploiLundi->classe->abbreviation}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"><br><br><br></td>
                                                      @endif
                                                          
                                                      @endforeach
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td class="mardi"> Mardi </td>

                                                      @foreach ($salleEmploiMardi as $emploiMardi)
                                                       
                                                      @if (!is_null($emploiMardi) )
                                                        <td>
                                                          <span class="styleHeure">{{$emploiMardi->heure_debut}} - {{$emploiMardi->heure_fin}}</span>
                                                          <p class="styleMatiere">{{$emploiMardi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiMardi->matiere->description}}</span></p>
                                                          <p class="styleProf">{{$emploiMardi->teacher->nom.' '.$emploiMardi->teacher->prenom}}</p>
                                                          <p class="styleSalle">{{$emploiMardi->classe->abbreviation}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"><br><br><br></td>
                                                      @endif
                                                          
                                                      @endforeach
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td class="mercredi"> Mercredi </td>

                                                      @foreach ($salleEmploiMercredi as $emploiMercredi)
                                                       
                                                      @if (!is_null($emploiMercredi) )
                                                        <td>
                                                          <span class="styleHeure">{{$emploiMercredi->heure_debut}} - {{$emploiMercredi->heure_fin}}</span>
                                                          <p class="styleMatiere">{{$emploiMercredi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiMercredi->matiere->description}}</span></p>
                                                          <p class="styleProf">{{$emploiMercredi->teacher->nom.' '.$emploiMercredi->teacher->prenom}}</p>
                                                          <p class="styleSalle">{{$emploiMercredi->classe->abbreviation}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"><br><br><br></td>
                                                      @endif
                                                          
                                                      @endforeach
                                                      
                                                    </tr>
                                                    <tr>
                                                      <td class="jeudi"> Jeudi </td>

                                                      @foreach ($salleEmploiJeudi as $emploiJeudi)
                                                       
                                                      @if (!is_null($emploiJeudi) )
                                                        <td>
                                                          <span class="styleHeure">{{$emploiJeudi->heure_debut}} - {{$emploiJeudi->heure_fin}}</span>
                                                          <p class="styleMatiere">{{$emploiJeudi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiJeudi->matiere->description}}</span></p>
                                                          <p class="styleProf">{{$emploiJeudi->teacher->nom.' '.$emploiJeudi->teacher->prenom}}</p>
                                                          <p class="styleSalle">{{$emploiJeudi->classe->abbreviation}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"><br><br><br></td>
                                                      @endif
                                                          
                                                      @endforeach
                                                
                                                    </tr>
                                                    <tr>
                                                      <td class="vendredi"> Vendredi </td>

                                                      @foreach ($salleEmploiVendredi as $emploiVendredi)
                                                       
                                                      @if (!is_null($emploiVendredi) )
                                                        <td>
                                                          <span class="styleHeure">{{$emploiVendredi->heure_debut}} - {{$emploiVendredi->heure_fin}}</span>
                                                          <p class="styleMatiere">{{$emploiVendredi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiVendredi->matiere->description}}</span></p>
                                                          <p class="styleProf">{{$emploiVendredi->teacher->nom.' '.$emploiVendredi->teacher->prenom}}</p>
                                                          <p class="styleSalle">{{$emploiVendredi->classe->abbreviation}}</p>
                                                        </td>
                                                      @else
                                                        <td class="silver"><br><br><br></td>
                                                      @endif
                                                          
                                                      @endforeach
                                                
                                                    </tr>
                                                    <tr>
                                                      <td class="samedi"> Samedi </td>

                                                      @foreach ($salleEmploiSamedi as $emploiSamedi)
                                                       
                                                      @if (!is_null($emploiSamedi) )
                                                        <td>
                                                          <span class="styleHeure">{{$emploiSamedi->heure_debut}} - {{$emploiSamedi->heure_fin}}</span>
                                                          <p class="styleMatiere">{{$emploiSamedi->matiere->subjectLabel}} <span class="typeMatiere">{{$emploiSamedi->matiere->description}}</span></p>
                                                          <p class="styleProf">{{$emploiSamedi->teacher->nom.' '.$emploiSamedi->teacher->prenom}}</p>
                                                          <p class="styleSalle">{{$emploiSamedi->classe->abbreviation}}</p>
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

                                    <div class="tab-pane show fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                      <div class="col-lg-12" style="text-align:left !important;">
                                        <div class="form-group">
                                          <br><br><br>
                                          <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">ID</th>
                                                    <th>Jour</th>
                                                    <th>Heure Début</th>
                                                    <th>Heure fin</th>
                                                    <th>Séance</th>
                                                    <th>Statut</th>
                                                    <th align="center" width="5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($salleseance as $seanceElement)
                                                <tr>
                                                    <td>{{ $seanceElement->id }}</td>
                                                    <td>{{ $seanceElement->jour }}</td>
                                                    <td>{{ $seanceElement->heure_debut }}</td>
                                                    <td>{{ $seanceElement->heure_fin }}</td>
                                                    <td>{{ $seanceElement->seance }}</td>
                    
                                                    @if (($seanceElement->statut=='1'))
                                                    <td><span class="demandEncours">Séance occupée</span></td>
                                                    @endif
                                                    @if (($seanceElement->statut=='0'))
                                                    <td><span class="demandTraitee">Séance Disponible</span></td>
                                                    @endif
                    
                                                    <td class="text-center">
                                                        <a href="{{ url('edit-seance-salle/'.$seanceElement->id) }}" class="btn btn-link btn-warning btn-just-icon like btn-sm"><i class="nav-icon fas fa-pencil-alt"></i></a>
                                                    </td>
                                                </tr>
                    
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Jour</th>
                                                    <th>Heure Début</th>
                                                    <th>Heure Fin</th>
                                                    <th>Séance</th>
                                                    <th>Disponibilité</th>
                                                    <th></th>
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