@extends('adminlayoutenseignant.layout')
@section('title', 'Absences Enseignants')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h4 class="m-0">Gestion des absences pour les enseignants</h4>
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
                    <div class="container">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="6%">ID</th>
                                    <th>Enseignant</th>
                                    <th>Tél Enseignant</th>
                                    <th>Jour</th>
                                    <th>Séance</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                
                                <tr>
                                    <td>{{ $attendance->id }}</td>
                                    <td>{{ $attendance->teacher->full_name }}</td>
                                    <td>{{ $attendance->teacher->tel1_teacher }}</td>
                                    <td>{{ $attendance->seance->jour }}</td>
                                    <td>{{ $attendance->seance->heure_debut}}-{{$attendance->seance->heure_fin}}</td>
                                    <td>{{ $attendance->attendance_date }}</td>
                                </tr>
    
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Enseignant</th>
                                    <th>Tél Enseignant</th>
                                    <th>Jour</th>
                                    <th>Séance</th>
                                    <th>Date</th>
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