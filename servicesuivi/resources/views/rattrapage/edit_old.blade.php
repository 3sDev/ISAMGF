@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier rattrapage')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier rattrapage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('rattrapage') }}">Liste des rattrapages</a></li>
                <li class="breadcrumb-item active">Modifier rattrapage</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
      <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            <div class="card">
                {{-- <div class="card-header">
                    <h4>
                        <a href="{{ url('rattrapage') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div> --}}

                <div class="card-body">
                @foreach ($rattrapages as $rattrapage)
                    {{-- @foreach ($rattrapages as $rattElement) --}}
                    <form action="{{ url('update-rattrapage/'.$rattrapage->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">
                    {{-- <form action="{{ url('update-rattrapage/'.$rattElement->id) }}" enctype="multipart/form-data"> --}}
                    
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Choisir enseignant</label>
                            <select name="teacher_id" class="form-control" required>
                               
                                <option value="{{ $rattrapage->teacher->id }}"> {{ $rattrapage->teacher->full_name }}</option>
                                <option value="" @disabled(true)>--------------------------------------</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"> {{ $teacher->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Choisir classe</label>
                            <select name="classe_id" id="classes" class="form-control" required>
                                <option value="{{ $rattrapage->classes->id }}"> {{ $rattrapage->classes->abbreviation }}</b></option>
                                <option value="" @disabled(true)>--------------------------------------</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Choisir matière</label>
                            <select name="matiere_id" id="matiere" data-style="btn btn-primary" required class="form-control" required>
                                <option value="{{ $rattrapage->matieres->id }}"> {{ $rattrapage->matieres->subjectLabel }} <b>({{ $rattrapage->matieres->description }})</b></option>
                                {{-- <option value="" @disabled(true)>--------------------------------------</option> --}}
                            </select>
                        </div>
                    </div>
                    <br><hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Heure Début</label>
                            <input type="time" step="1800" id="heure_debut" name="heure_debut" value="{{ $rattrapage->heure_debut }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Heure Fin</label>
                            <input type="time" step="1800" id="heure_fin" name="heure_fin" value="{{ $rattrapage->heure_fin }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Date</label>
                            <input type="date" name="date" id="dateDay" value="{{ $rattrapage->date }}" class="form-control" required>
                        </div>
                    </div>
                    <br><hr>
                    <div class="row">
                        {{-- <div class="col-md-4">
                            <label for="">Jour</label>
                            <select name="jour" id="jour" class="form-control" data-dependent="salle" required>
                                @if (date('l', strtotime($rattrapage->date)) == 'Monday') {
                                    <option value="Lundi">Lundi</option>
                                }
                                @elseif (date('l', strtotime($rattrapage->date)) == 'Tuesday') {
                                    <option value="Mardi">Mardi</option>
                                }
                                @elseif (date('l', strtotime($rattrapage->date)) == 'Wednesday') {
                                    <option value="Mercredi">Mercredi</option>
                                }
                                @elseif (date('l', strtotime($rattrapage->date)) == 'Thursday') {
                                    <option value="Jeudi">Jeudi</option>
                                }
                                @elseif (date('l', strtotime($rattrapage->date)) == 'Friday') {
                                    <option value="Vendredi">Vendredi</option>
                                }
                                @else {
                                    <option value="Samedi">Samedi</option>
                                }
                                @endif
                                <option value="Lundi">Lundi</option>
                                <option value="Mardi">Mardi</option>
                                <option value="Mercredi">Mercredi</option>
                                <option value="Jeudi">Jeudi</option>
                                <option value="Vendredi">Vendredi</option>
                                <option value="Samedi">Samedi</option>
                            </select>
                        </div> --}}
                        <div class="col-md-6">
                            <label for="">Choisir salle</label>
                            <select name="salle_id" id="salle" class="form-control" required>
                                <option value="{{ $rattrapage->salles->id }}"> {{ $rattrapage->salles->fullName }}</b></option>
                                {{-- <option value="" @disabled(true)>--------------------------------------</option> --}}
                               
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Durée</label>
                            <input type="text" name="duree" value="{{ $rattrapage->duree }}" class="form-control">
                        </div>
                    </div>
                    <br><br>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success float-right">Modifier</button>
                    </div>
                   
                  </form>
                  @endforeach
                  {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
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
    
    // when séance dropdown changes
    $('#dateDay').change(function() {
        var dateSelected = $("#dateDay").val();
        //get day name
        var dayName =['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var day = dayName[new Date(dateSelected).getDay()];
    
        console.log('---------------------------------'+day);
        if (day == 'Sunday') {
            day = "Dimanche";
        } else if (day == 'Monday') {
            day = "Lundi";
        } else if (day == 'Tuesday') {
            day = "Mardi";
        } else if (day == 'Wednesday') {
            day = "Mercredi";
        } else if (day == 'Thursday') {
            day = "Jeudi";
        } else if (day == 'Saturday') {
            day = "Vendredi";
        }
        else {
            day = "Samedi";
        }
    
        console.log('date de jour'+day);
    
        var heure_debut = $("#heure_debut").val();
        var heure_fin   = $("#heure_fin").val();
    
        if(!heure_debut){alert('Saisir heure_debut'); return;}
    
        if(!heure_fin){alert('Saisir heure_fin'); return;}
    
        $.ajax({
            type: "GET",
            url: "{{ url('disponibiliteSalles') }}/"+ heure_debut+"/" + heure_fin+"/" + day,
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
@endsection