
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
          <li class="breadcrumb-item"><a href="{{ url('classe-student-attendance') }}">Choisir une classe</a></li>
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

.fa {
  color:rgb(73, 73, 73)
}

.textable {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}

input[type="radio"]:checked + .card {
  background: #f1f1f1;
}

.card.backgroundCard {
  background: #f1f1f1;
}

input[type=radio]:checked  + .card{
  background: #3057d5;
  border-color: #3057d5;
  transform: scale(1.2);
  opacity: 1;
}

input[type=radio]:focus + .card{
  box-shadow: 0 0 0 4px rgba(48, 86, 213, 0.2);
  border-color: #3056d5;
}

.cardLabel{
  cursor: pointer;
}

.cardLabel:hover{
  border: 1px solid #3056d5;
}
</style>


<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />

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
                    
                    <form action="{{ url('attendances') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de sauvegarder ces données?')">
                      @csrf

                      @foreach ($classResult as $classItem)
                        <center>
                          <h5><b>Semestre :</b> {{ $semestre }}</h5>
                          <h5><b>Classe :</b> {{ $classItem->abbreviation }}</h5>
                          <h5><b>Date de présence :</b> {{ $dateAbs }}  /  {{ $seanceAbs }}</h5><br>
                      </center>
                      @endforeach
                      <div class="row">

                        <input type="text" style="display:none;" name="date_absence" value="{{ $dateAbs }}"><br>
                        <input type="text" style="display:none;" name="seance_absence" value="{{ $seanceAbs }}"><br>
                        <input type="text" style="display:none;" name="classe_id" value="{{ $classeId }}">


                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <b>Liste des enseignants</b>
                                <select name="teacher_id" class="form-control" required style="width: 100% !important" required> 
                                  <option value="">Séléctionner enseignant</option>
                                    @foreach ($seancesClass as $itemTeacher)
                                        <option value="{{ $itemTeacher->teacher->id }}"> {{  $itemTeacher->teacher->full_name }}</option>
                                    @endforeach
                                </select>                                    
                            </div>
                            <br>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <b>Liste des matières</b>
                                <select name="matiere_id" class="form-control" required style="width: 100% !important" required>
                                  <option value="">Séléctionner matière</option>
                                  @foreach ($seancesClass as $itemMatiere)
                                    <option value="{{ $itemMatiere->matiere->id }}"> {{  $itemMatiere->matiere->subjectLabel.'('.$itemMatiere->matiere->description.')' }}</option>
                                  @endforeach
                                </select>                                    
                            </div>
                        </div>

                        <div class="col-lg-2">
                          <div class="form-group">
                              <b>Date début séance</b>
                              <select id="attendance_seance_debut" name="attendance_seance_debut" class="form-control" style="width: 100% !important;" required>
                                <option value="">Séléctionner heure début</option>
                                @foreach ($seancesClass as $itemHeure)
                                  <option value="{{ $itemHeure->heure_debut }}"> {{  $itemHeure->heure_debut }}</option>
                                @endforeach
                            </select>                                   
                          </div>
                        </div>

                        <div class="col-lg-2">
                          <div class="form-group">
                              <b>Date fin séance</b>
                              <select id="attendance_seance_fin" name="attendance_seance_fin" class="form-control" style="width: 100% !important;" required>
                                <option value="">Séléctionner heure fin</option>
                                @foreach ($seancesClass as $itemHeure)
                                  <option value="{{ $itemHeure->heure_fin }}"> {{  $itemHeure->heure_fin }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="col-lg-1"></div>
                        
                    </div>
{{-- 
<div class="row">
  @foreach ($seancesClass as $itemMatiere)
    <div class="col-lg-3">
      <label class="">
        <div class="card bg-light" style="width: 18rem;">
          <input type="radio" name="tri" value="" class="" />
          <div class="card-body">
            <p class="card-text">{{ $itemMatiere->matiere->subjectLabel }} - {{ $itemMatiere->matiere->description }}</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ $itemMatiere->teacher->full_name }}</li>
            <li class="list-group-item"><i class="fa fa-clock" aria-hidden="true"></i> {{ $itemMatiere->heure_debut .' | '. $itemMatiere->heure_fin }}</li>
            <li class="list-group-item"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $itemMatiere->salle->fullName }}</li>
          </ul>
        </div>
      </label>
    </div>
  @endforeach
</div> --}}

                      <center><button type="submit" class="btn btn-secondary" onclick="return IsEmpty();"><b>Envoyer</b></button></center>
                      <br>  
                      <center>
                      <table border="" BORDERCOLOR="#ccc" style="padding-right:5px; table-layout:fixed; width:50% !important" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th width="20%">ID</th>
                                  <th width="60%">Nom et Prénom</th>
                                  <td width="20%">Absences</td>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($students as $item)
                              
                            <tr>
                              {{-- <td><img src="/upload/students/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                              <td><input type="text" class="inputStyle" name="student_id[]" value="{{ $item->id }}" readonly></td>
                              <td>{{ $item->prenom .' '. $item->nom }}</td>                            
                                         
                              <td align="center">
                                <select id='selec3' name="presence[]"> 
                                    <option value='P'> P </option>
                                    <option value='A'> A </option>
                                    {{-- <option value='R'> R </option> --}}
                                </select>
                              </td>
                            
                            </tr>
                            @endforeach
                          </tbody>
                          <tfoot>
                              <tr>
                                <th>ID</th>
                                <th>Nom et Prénom</th>
                                <td>Absences</td>
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
<script>
  $(this).attr('name');
$('.check-on').on('change', function() {
  let radioName = $(this).attr('name');
  $(`.check-on[name=${radioName}]`).closest('.card.backgroundCard').removeClass('backgroundCard');
  $(this).closest('.card').addClass('backgroundCard');
});
</script>
@endsection