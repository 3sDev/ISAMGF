@extends('adminlayoutenseignant.layout')
@section('title', 'Pointage Enseignants')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">Liste des pointages enseignants</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Liste des pointages</li>
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
                <div class="card-body">
                       
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Enseignant</th>
                                    <th>Matière</th>
                                    <th>Jour</th>
                                    <th>Séance</th>
                                    <th>Salle</th>
                                    <th>Date</th>
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
                                </tr>
                            </tfoot>
                        </table>
                        
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