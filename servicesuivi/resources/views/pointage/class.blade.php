@extends('adminlayoutenseignant.layout')
@section('title', 'Pointage Enseignants')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Gestion des pointages</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Gestion des pointages</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<style>
.demandEnvoyee {
    background-color: #d9f00e85;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 10%;
}

.demandEncours {
    background-color: #f0550e8c;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 10%;
}

.demandTraitee {
    background-color: #43f00e83;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 10%;
}
.btn-link{color: white;}
.btn-link:hover{color: white;}
</style>
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
            <div class="card-header">
                <h5>Pointage Enseignants
                    <a href="{{ url('dashboards') }}" class="btn btn-danger float-right">Retour</a>
                </h5>
            </div>
            <div class="card-body">
                    <form action="{{ url('create-pointage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <b>Liste des enseignants</b>
                                    <select name="teacher_id" class="form-control" required>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"> {{ $teacher->full_name }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                                <br>
                            </div>

                            <!--div class="col-lg-4">
                                <div class="form-group">
                                    <b>Choisir Jour</b>
                                    <select name="jour" id="jour" class="form-control" required>
                                        <option value="" selected>Saisir jour</option>
                                        <option value="Lundi">Lundi</option>
                                        <option value="Mardi">Mardi</option>
                                        <option value="Mercredi">Mercredi</option>
                                        <option value="Jeudi">Jeudi</option>
                                        <option value="Vendredi">Vendredi</option>
                                        <option value="Samedi">Samedi</option>
                                        </select>                                   
                                </div>
                            </div-->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <b>Choisir Date</b>
                                    <input type="date" name="pointage_date" id="dateID" class="form-control">                                 
                                </div>
                            </div>

                            <div class="col-lg-2"></div>
                            
                        </div>

                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-primary btn-info btn-just-icon like text-center">pointage</button>
                            </center>
                        </div>
                    </form>

                    <hr><br>
                    <h4><b>Liste de tous les pointages des enseignants</b></h4><br>
                    <div class="container-tab">
                        <ul class="nav nav-pills mb-6" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-seance-tab" data-toggle="pill" href="#pills-seance" role="tab" aria-controls="pills-seance" aria-selected="true">Semestre 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-voeux-tab" data-toggle="pill" href="#pills-voeux" role="tab" aria-controls="pills-voeux" aria-selected="false">Semestre 2</a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane show fade active" id="pills-seance" role="tabpanel" aria-labelledby="pills-seance-tab">
                            <div class="col-lg-12" style="text-align:left !important;">
                                <div class="form-group">
                                    <br>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="16%">Type</th>
                                                <th>Enseignant</th>
                                                <th>Matière</th>
                                                <th>Jour</th>
                                                <th>Séance</th>
                                                <th>Salle</th>
                                                <th>Date</th>
                                                <th>Semestre</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pointages as $pointage)
                                            
                                            <tr>
                                            <td>
                                                @if ($pointage->lat)
                                                    <span class="demandEncours">Enseignant</span>
                                                @else 
                                                    <span class="demandTraitee">Chef département</span>
                                                @endif
                                            </td>
                                            <td>{{ $pointage->teacher->full_name }}</td>
                                            <td>{{ $pointage->nom_matiere}}  ({{$pointage->type_matiere}})</td>
                                            <td>{{ $pointage->jour }}</td>
                                            <td>{{ $pointage->heure_debut}}-{{$pointage->heure_fin}}</td>
                                            <td>{{ $pointage->salle }}</td>
                                            <td>{{ $pointage->date_pointage ?? 'null' }}</td>
                                            <td>{{ $pointage->semestre }}</td>
                                            
                                            <td class="text-right">
                                                {{-- <a href="{{ url('show-avis/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                                <a href="{{ url('edit-pointage/'.$pointage->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td>
                                                @if ($pointage->lat)
                                                    <center>-</center>
                                                @else 
                                                    <form action="{{ url('delete-pointage/'.$pointage->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                                        <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                            </tr>
                
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th width="16%">Type</th>
                                                <th>Enseignant</th>
                                                <th>Matière</th>
                                                <th>Jour</th>
                                                <th>Séance</th>
                                                <th>Salle</th>
                                                <th>Date</th>
                                                <th>Semestre</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane show fade" id="pills-voeux" role="tabpanel" aria-labelledby="pills-voeux-tab">
                            <div class="col-lg-12" style="text-align:left !important;">
                                <div class="form-group">
                                    <br>
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Enseignant</th>
                                                <th>Matière</th>
                                                <th>Jour</th>
                                                <th>Séance</th>
                                                <th>Salle</th>
                                                <th>Date</th>
                                                <th>Semestre</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pointageS2 as $pointage)
                                            
                                            <tr>
                                            <td>
                                                @if ($pointage->lat)
                                                    <span class="demandEncours">Enseignant</span>
                                                @else 
                                                    <span class="demandTraitee">Chef département</span>
                                                @endif
                                            </td>
                                            <td>{{ $pointage->teacher->full_name }}</td>
                                            <td>{{ $pointage->nom_matiere}}  ({{$pointage->type_matiere}})</td>
                                            <td>{{ $pointage->jour }}</td>
                                            <td>{{ $pointage->heure_debut}}-{{$pointage->heure_fin}}</td>
                                            <td>{{ $pointage->salle }}</td>
                                            <td>{{ $pointage->date_pointage ?? 'null' }}</td>
                                            <td>{{ $pointage->semestre }}</td>                                            
                                            
                                            <td class="text-right">
                                                {{-- <a href="{{ url('show-avis/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                                <a href="{{ url('edit-pointage/'.$pointage->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td>
                                                @if ($pointage->lat)
                                                    <center>-</center>
                                                @else 
                                                    <form action="{{ url('delete-pointage/'.$pointage->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                                        <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                            </tr>
                
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Type</th>
                                                <th>Enseignant</th>
                                                <th>Matière</th>
                                                <th>Jour</th>
                                                <th>Séance</th>
                                                <th>Salle</th>
                                                <th>Date</th>
                                                <th>Semestre</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('select option').each(
        function () {
            $(this).attr("title", $(this).text());
    });
</script>
<script>
    //Display Only Date till today // 
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('#dateID').attr('max', maxDate);

</script>
@endsection