
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Les disponibilités des salles')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Les disponibilités des salles</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('sallestatut') }}">Choisir une date</a></li>
          <li class="breadcrumb-item active">Disponibilité des salles</li>
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
.empty {
    background-color: rgb(103, 145, 70);
  
}
.fill {
    background-color: rgb(179, 57, 57);

}
.textTable {
    font-size: 15px;
    text-align: center;
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
                    <h5><b>Date séléctionnée :</b> {{ $dateAbs }} / {{ $seanceAbs }}</h5><br></center>

                    <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: left !important" class="textTable" width="14%">Salle</th>
                                <th class="textTable">08:30 - 10:00</th>
                                <th class="textTable">10:05 - 11:35</th>
                                <th class="textTable">11:40 - 13:10</th>
                                <th class="textTable">13:15 - 14:45</th>
                                <th class="textTable">14:50 - 16:20</th>
                                <th class="textTable">16:25 - 17:55</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                @foreach ($Salle1 as $id1)
                                @if ($loop->first)
                                    <td><a href="{{ url('emploi-salle/'.$id1->salle_id) }}" target="_blank" >{{ $id1->fullName }}</a></td>
                                @endif
                                    
                                @if ($id1->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle2 as $id2)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id2->salle_id) }}" target="_blank" >{{ $id2->fullName }}</a></td>
                                @endif
                                    
                                @if ($id2->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle3 as $id3)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id3->salle_id) }}" target="_blank" >{{ $id3->fullName }}</a></td>
                                @endif
                                    
                                @if ($id3->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle4 as $id4)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id4->salle_id) }}" target="_blank" >{{ $id4->fullName }}</a></td>
                                @endif
                                    
                                @if ($id4->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle5 as $id5)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id5->salle_id) }}" target="_blank" >{{ $id5->fullName }}</a></td>
                                @endif
                                    
                                @if ($id5->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle6 as $id6)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id6->salle_id) }}" target="_blank" >{{ $id6->fullName }}</a></td>
                                @endif
                                    
                                @if ($id6->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle7 as $id7)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id7->salle_id) }}" target="_blank" >{{ $id7->fullName }}</a></td>
                                @endif
                                    
                                @if ($id7->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle8 as $id8)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id8->salle_id) }}" target="_blank" >{{ $id8->fullName }}</a></td>
                                @endif
                                    
                                @if ($id8->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle9 as $id9)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id9->salle_id) }}" target="_blank" >{{ $id9->fullName }}</a></td>
                                @endif
                                    
                                @if ($id9->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle10 as $id10)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id10->salle_id) }}" target="_blank" >{{ $id10->fullName }}</a></td>
                                @endif
                                    
                                @if ($id10->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle11 as $id11)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id11->salle_id) }}" target="_blank" >{{ $id11->fullName }}</a></td>
                                @endif
                                    
                                @if ($id11->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle12 as $id12)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id12->salle_id) }}" target="_blank" >{{ $id12->fullName }}</a></td>
                                @endif
                                    
                                @if ($id12->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle13 as $id13)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id13->salle_id) }}" target="_blank" >{{ $id13->fullName }}</a></td>
                                @endif
                                    
                                @if ($id13->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle14 as $id14)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id14->salle_id) }}" target="_blank" >{{ $id14->fullName }}</a></td>
                                @endif
                                    
                                @if ($id14->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle15 as $id15)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id15->salle_id) }}" target="_blank" >{{ $id15->fullName }}</a></td>
                                @endif
                                    
                                @if ($id15->statut == '0')
                                    <td class="empty"></td>
                                            {{-- @foreach ($rattrapages as $rattrapage)
                                            @if ($rattrapage->heure_debut == $id15->heure_debut)
                                                <td class="empty">{{$id15->heure_debut}}</td>
                                            @else
                                                <td class="empty"></td>
                                            @endif
                                            @endforeach  --}}
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle16 as $id16)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id16->salle_id) }}" target="_blank" >{{ $id16->fullName }}</a></td>
                                @endif
                                    
                                @if ($id16->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle17 as $id17)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id17->salle_id) }}" target="_blank" >{{ $id17->fullName }}</a></td>
                                @endif
                                    
                                @if ($id17->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle18 as $id18)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id18->salle_id) }}" target="_blank" >{{ $id18->fullName }}</a></td>
                                @endif
                                    
                                @if ($id18->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle19 as $id19)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id19->salle_id) }}" target="_blank" >{{ $id19->fullName }}</a></td>
                                @endif
                                    
                                @if ($id19->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle20 as $id20)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id20->salle_id) }}" target="_blank" >{{ $id20->fullName }}</a></td>
                                @endif
                                    
                                @if ($id20->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle21 as $id21)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id21->salle_id) }}" target="_blank" >{{ $id21->fullName }}</a></td>
                                @endif
                                    
                                @if ($id21->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle22 as $id22)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id22->salle_id) }}" target="_blank" >{{ $id22->fullName }}</a></td>
                                @endif
                                    
                                @if ($id22->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle23 as $id23)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id23->salle_id) }}" target="_blank" >{{ $id23->fullName }}</a></td>
                                @endif
                                    
                                @if ($id23->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle24 as $id24)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id24->salle_id) }}" target="_blank" >{{ $id24->fullName }}</a></td>
                                @endif
                                    
                                @if ($id24->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($Salle25 as $id25)
                                @if ($loop->first)
                                <td><a href="{{ url('emploi-salle/'.$id25->salle_id) }}" target="_blank" >{{ $id25->fullName }}</a></td>
                                @endif
                                    
                                @if ($id25->statut == '0')
                                    <td class="empty"></td>
                                        
                                @else
                                    <td class="fill"></td>
                                @endif
                                    
                                @endforeach
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Salle</th>
                                <th class="textTable">08:30 - 10:00</th>
                                <th class="textTable">10:05 - 11:35</th>
                                <th class="textTable">11:40 - 13:10</th>
                                <th class="textTable">13:15 - 14:45</th>
                                <th class="textTable">14:50 - 16:20</th>
                                <th class="textTable">16:25 - 17:55</th>
                            </tr>
                        </tfoot>
                    </table>
                    <br><hr><br>
                    <h5><b>Rattrapage séléctionné :</b> {{ $dateAbs }} / {{ $seanceAbs }}</h5><br></center>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th>Enseignant</th>
                                <th>Matière</th>
                                <th>Classe</th>
                                <th>Séance</th>
                                <th>Durée</th>
                                <th>Salle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rattrapages as $rattrapage)
                                @if (Carbon\Carbon::now() > $rattrapage->date )
                                    <tr style="background: rgb(255, 228, 219)">
                                @else
                                    <tr style="background: rgb(225, 255, 211)">
                                @endif
                                <td>{{ $rattrapage->id }}</td>
                                <td>{{ $rattrapage->teacher }}</td>
                                <td>{{ $rattrapage->matiere }} - <b>({{ $rattrapage->matiereDescription }})</b></td>
                                <td>{{ $rattrapage->classe }}</td>
                                <td>{{ $rattrapage->heure_debut }} | {{ $rattrapage->heure_fin }}</td>
                                <td>{{ $rattrapage->duree }}</td>
                                <td>{{ $rattrapage->salle }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>ID</th>
                            <th>Enseignant</th>
                            <th>Matière</th>
                            <th>Classe</th>
                            <th>Séance</th>
                            <th>Durée</th>
                            <th>Salle</th>
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