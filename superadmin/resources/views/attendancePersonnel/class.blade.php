@extends('adminlayoutenseignant.layout')
@section('title', 'Absences Personnels')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Gestion des absences</li>
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

.styleAbsence{
    background-color: antiquewhite;
    padding: 5px 10px;
    border-radius: 8px;
    color: blueviolet;   
}
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
                    <h5>Liste des absences des personnels
                        <a href="{{ url('dashboards') }}" class="btn btn-danger float-right">Retour</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="container" style="margin-top: 10px;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Personnel</th>
                                    <th>Téléphone</th>
                                    <th>Jour</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                
                                <tr>
                                    <td>{{ $attendance->id }}</td>
                                    <td>{{ $attendance->personnel->nom.' '.$attendance->personnel->prenom }}</td>
                                    <td>{{ $attendance->personnel->tel1_personnel }}</td>
                                    <td>{{ $attendance->jour }}</td>
                                    <td>{{ $attendance->attendance_date }}</td>
                                    <td><span class="styleAbsence">{{ $attendance->attendance_statut }}</span></td>
                                </tr>
    
                                @endforeach
                            </tbody>
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