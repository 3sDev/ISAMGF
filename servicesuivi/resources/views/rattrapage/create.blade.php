@extends('adminlayoutenseignant.layout')
@section('title', 'Créer un nouveau rattrapage')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau rattrapage</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('rattrapage') }}">Liste des rattrapages</a></li>
                <li class="breadcrumb-item active">Créer un nouveau rattrapage</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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

                <div class="card-body">

                    <form action="{{ url('rattrapages') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Choisir enseignant</label>
                                    <select name="teacher_id" class="form-control" required>
                                        <option value="">Selectionner Enseignant</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"> {{ $teacher->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Choisir classe</label>
                                    <select name="classe_id" id="classes" class="form-control" required>
                                        <option value="">Selectionner Classe</option>
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Choisir matière</label>
                                    <select name="matiere_id" id="matiere" data-style="btn btn-primary" required class="form-control" required>
                                        <option value="">Selectionner Matière</option>
                                    </select>
                                </div>
                            </div>
                            <br><hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Heure Début</label>
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
                                    {{-- <input type="time" step="1800" id="heure_debut" name="heure_debut" class="form-control" required> --}}
                                </div>
                                <div class="col-md-4">
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
                                    {{-- <input type="time" step="1800" id="heure_fin" name="heure_fin" class="form-control" required> --}}
                                </div>
                                <div class="col-md-4">
                                    <label for="">Date</label>
                                    <input type="date" id="dateDay" name="date" class="form-control" required>
                                </div>
                            </div>
                            <br><hr>
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <label for="">Jour</label>
                                    <select name="jour" id="jour" class="form-control" data-dependent="salle" required>
                                        <option value="">Selectionner Jour</option>
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
                                        <option value="">Selectionner Salle</option>
                                        {{-- @foreach ($salles as $salle)
                                            <option value="{{ $salle->id }}"> {{ $salle->fullName }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Durée</label>
                                    <p id="iputresult"> </p>
                                </div>
                                <p></p>
                            </div>
                            <br><br>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                            </div>
                        </form>
                        
                </div>
            </div>
        </div>
    </div>
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