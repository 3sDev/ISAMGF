
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Réservation salle')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        @foreach ($disponibilite as $seanceEl)
            @if ($loop->first)
                <h1 class="m-0">Réserver la salle <span class="titrePage">{{ $seanceEl->salle->fullName.'('.$seanceEl->salle->type_salle.')' }}</span></h1>
            @endif
        @endforeach
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('sallestatut') }}">Choisir une date</a></li>
          <li class="breadcrumb-item"><a href="{{ url('reserver-salle') }}">Séléctionner une salle</a></li>
          <li class="breadcrumb-item active">Réservation salle</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.textable {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
h3{
    font-size: 18px;
    font-weight: bold;
}
.titrePage{
    color: brown;
}
.acountSeanceA{
    color:rgb(53, 145, 17);
}
.acountSeanceB{
    color:rgb(165, 145, 30);
}
.acountSeanceC{
    color:rgb(158, 38, 38);
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('modifier-statut-salle') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de sauvegarder ces données?')">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4" style="border-right: 2px solid rgb(41, 41, 41);">
                                <h3 class="text-center">Saisir la disponibilité</h3><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="jour" id="jour" class="form-control" style="width:100%;" data-dependent="heure" required>
                                            <option value="">Jour</option>
                                            <option value="" disabled>--------------------------</option>
                                            <option value="Lundi">Lundi</option>
                                            <option value="Mardi">Mardi</option>
                                            <option value="Mercredi">Mercredi</option>
                                            <option value="Jeudi">Jeudi</option>
                                            <option value="Vendredi">Vendredi</option>
                                            <option value="Samedi">Samedi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="statut" id="statut" class="form-control" style="width:100%;" data-dependent="heure" required>
                                            <option value="">Disponibilité</option>
                                            <option value="" disabled>--------------------------</option>
                                            <option value="0">Vider</option>
                                            <option value="1">Réserver</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="heure_debut" name="heure_debut" style="width:100%;" class="form-control" required>
                                            <option value="">Heure Début</option>
                                            <option value="" disabled>--------------------------</option>
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
                                    <div class="col-md-6">
                                        <select id="heure_fin" name="heure_fin" style="width:100%;" class="form-control" required>
                                            <option value="">Heure Fin</option>
                                            <option value="" disabled>--------------------------</option>
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
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            @foreach ($disponibilite as $seanceEl)
                                                @if ($loop->first)
                                                <input type="hidden" name="salle_id" value="{{ $seanceEl->salle->id}}" class="form-control">
                                                @endif
                                            @endforeach
                                            
                                            <button type="submit" class="btn btn-primary btn-info btn-just-icon like">Réserver</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <h3 class="text-center">Emploi de temps du salle</h3><br>
                                <table class="table table-bordered table-striped" width="90%">
                                    <thead>
                                        <tr style="background: rgb(50, 52, 90); color:white;">
                                            <th>Classe</th>
                                            <th>Matiere</th>
                                            <th>Enseignant</th>
                                            <th>Jour</th>
                                            <th>Séance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emploi as $element)
                                        
                                        <tr>
                                            <td>{{ $element->nomClasse }}</td>
                                            <td>{{ $element->nomMatiere }}</td>
                                            <td>{{ $element->nomEnseignant }}</td>
                                            <td>{{ $element->jour }}</td>
                                            <td>{{ $element->heureDebut }} | {{ $element->heureFin }} </td>
                                        </tr>
            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <center>
                            </center>
                        </div>
                    </form>
                    <br><hr><br>
                    <h3 class="text-left">Liste des disponibilités du salle 
                        @if ($nbrSeanceDisponible < 40)
                            <span class="acountSeanceA">({{ $nbrSeanceDisponible }}/{{ $nbAllDisponible }})</span>
                        @elseif ($nbrSeanceDisponible > 40 AND $nbrSeanceDisponible < 70)
                            <span class="acountSeanceB">({{ $nbrSeanceDisponible }}/{{ $nbAllDisponible }})</span>
                        @else
                            <span class="acountSeanceC">({{ $nbrSeanceDisponible }}/{{ $nbAllDisponible }})</span>
                        @endif
                    </h3><br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="6%">ID</th>
                                <th>Nom salle</th>
                                <th>Type salle</th>
                                <th>Jour séance</th>
                                <th>Séance</th>
                                <th>Statut salle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disponibilite as $seanceElement)
                            
                            <tr>
                                <td>{{ $seanceElement->id }}</td>
                                <td>{{ $seanceElement->salle->fullName }}</td>
                                <td>{{ $seanceElement->salle->type_salle }}</td>
                                <td>{{ $seanceElement->jour }}</td>
                                <td>{{ $seanceElement->heure_debut }} | {{ $seanceElement->heure_fin }} </td>
                                @if (($seanceElement->statut=='1'))
                                <td><span class="demandEncours">Séance occupée</span></td>
                                @endif
                                @if (($seanceElement->statut=='0'))
                                <td><span class="demandTraitee">Séance Disponible</span></td>
                                @endif
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nom salle</th>
                                <th>Type salle</th>
                                <th>Jour séance</th>
                                <th>Séance</th>
                                <th>Statut salle</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection