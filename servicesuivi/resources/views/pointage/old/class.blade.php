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
                    <div class="container" style="margin-top: 10px;">
                        <form action="{{ url('create-pointage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col-lg-1"></div>
                                <div class="col-lg-5">
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

                                <div class="col-lg-5">
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
                                </div>

                                <div class="col-lg-1"></div>
                                
                            </div>

                            <div class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-primary btn-info btn-just-icon like text-center">pointage</button>
                                </center>
                            </div>
                        </form>

                        <hr><br>
                        <h4><b>Liste de tous les pointages des enseignants</b></h4><br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="17%">Type</th>
                                    <th>Enseignant</th>
                                    <th>Matière</th>
                                    <th>Jour</th>
                                    <th width="10%">Séance</th>
                                    <th>Salle</th>
                                    <th width="14%">Date</th>
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
                                <td>{{ date('Y-m-d | H:i', strtotime($pointage->created_at)) }}</td>
                                
                                
                                <td class="text-center">
                                    {{-- <a href="{{ url('show-avis/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                    @if ($pointage->lat)
                                        <center>-</center>
                                    @else 
                                        <a href="{{ url('edit-pointage/'.$pointage->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    @endif
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
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        
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
@endsection