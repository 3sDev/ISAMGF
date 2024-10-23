@extends('adminlayoutenseignant.layout')
@section('title', 'Créer congé')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nouveau demande du congé</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('conges') }}">Liste des congés</a></li>
                <li class="breadcrumb-item active">Nouveau congé</li>
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

                <div class="card-body">

                    <form action="{{ url('conges') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'ajouter cet element?')" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Année</label>
                                <select name="annee" id="annee" data-style="btn btn-primary" required class="form-control" required>
                                    <option value="" selected disabled>Selectionner année</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->annee }}"> {{ $year->annee }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Séléctionner le personnel</label>
                                <select name="personnel_id" id="personnel_id" data-style="btn btn-primary" required class="form-control" required>
                                    <option value="" selected disabled>Selectionner personnel</option>
                                    @foreach ($personnels as $perso)
                                        <option value="{{ $perso->id }}"> {{ $perso->nom.' '.$perso->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Catégorie congé</label>
                                <select name="categorie_conges_id" id="categorie_conges_id" data-style="btn btn-primary" required class="form-control" required>
                                    <option value="" selected disabled>Selectionner catégorie</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"> {{ $cat->nom }}</option>
                                    @endforeach
                                </select>
                                <p id="resultSolde"></p>
                                <p id="inputResult1"></p>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Date début</label>
                                <input type="date" id="date_debut" name="date_debut" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Date fin</label>
                                <input type="date" id="date_fin" name="date_fin" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Période (par jours)</label>
                                <p id="inputResult"> </p>
                            </div>
                        </div>
                        <br><br>
                        <div class="mb-3">
                            <p id="myButton"> </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    // when personnel dropdown changes
    $('#categorie_conges_id').change(function() {
        var idCategorie  = $("#categorie_conges_id").val();
        var idPersonnel  = $("#personnel_id").val();
        var annee        = $("#annee").val();

        $.ajax({
            type: "GET",
            url: "{{ url('getSoldePersonnelAjax') }}/"+idPersonnel+"/"+idCategorie+"/"+annee,
            success: function(res) {
                if (res) {
                console.log(res);
                    $("#resultSolde").empty();
                    $("#inputResult1").empty();
                    res.map(element=>{
                    $("#resultSolde").append('<span style="color: orangered;">Solde: '+element.solde+'</span><br><input type="hidden" name="solde" id="solde" value="'+element.solde+'" class="form-control" readonly>');
                    $("#inputResult1").append('<input type="hidden" id="mySolde" name="mySolde" value="'+element.solde+'" class="form-control" min="1" max="'+element.solde+'" required>');
                    })
                } else {
                    $("#resultSolde").empty();
                    $("#inputResult1").empty();
                }
            }
        });
        
    });
</script>
<script>
    // when date_fin dropdown changes
    $('#date_fin').change(function() {
        var revDateDebut = $("#date_debut").val();
        var revDateFin   = $("#date_fin").val();
        var mySolde      = $("#mySolde").val();

        if (revDateDebut < revDateFin) {
            const finalDateDebut = new Date(revDateDebut).getTime();
            const finalDateFin   = new Date(revDateFin).getTime();

            var diff = finalDateDebut - finalDateFin;
            var days_difference = Math.abs(diff / (1000 * 3600 * 24)); 

            $("#inputResult").empty();
            $("#inputResult").append('<input type="number" id="duree" name="duree" value="'+days_difference+'" class="form-control" min="1" max="'+days_difference+'" required readonly>');
            if (days_difference < mySolde) {
                $("#myButton").empty();
                $("#myButton").append('<button type="submit" class="btn btn-primary float-right">Ajouter</button>');
            } else {
                $("#myButton").empty();
                $("#myButton").append('<span>Vérifier la période du congé (Elle est dépassée le solde)!!');
            }
        }
        if (revDateDebut > revDateFin) {
            alert("Erreur: la date fin de congé est inférieure à la date début!!");
        }
        
    });
</script>

<script>
$(document).ready(function() {   
    function calculateTime() {

        //get values
        var valuestart = $("input[name='date_debut']").val();
        var valuestop  = $("input[name='date_fin']").val();

        //calculate time difference  
        var time_difference = valuestop.getTime() - valuestart.getTime();  

        //calculate days difference by dividing total milliseconds in a day  
        var days_difference = time_difference / (1000 * 60 * 60 * 24);  
        
        alert (days_difference);

    $("#iputresult").html('<input type="text" name="duree" id="result" value="12" class="form-control" readonly>' )             
    }
    $("input").change(calculateTime);
    calculateTime();
});
</script>
@endsection