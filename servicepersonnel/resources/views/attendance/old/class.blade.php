@extends('adminlayoutenseignant.layout')
@section('title', 'Absences Personnels')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Gestion des absences</h1>
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
                <div class="card-header">
                    <h5>Absences Personnels
                        <a href="{{ url('dashboards') }}" class="btn btn-danger float-right">Retour</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="container" style="margin-top: 10px;">
                        <form action="{{ url('create-attendance') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col-lg-3"></div>
                                {{-- <div class="col-lg-4">
                                    <div class="form-group">
                                        <b>Liste des personnels</b>
                                        <select name="teacher_id" class="form-control" required>
                                            @foreach ($personnels as $personnel)
                                                <option value="{{ $personnel->id }}"> {{ $personnel->full_name }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                    <br>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <b>Choisir Date Présence</b>
                                        <input type="date" name="attendance_date" id="" class="form-control">                                 
                                    </div>
                                </div>

                                <div class="col-lg-3"></div>
                                
                            </div>

                            <div class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-primary btn-info btn-just-icon like text-center">Saisir</button>
                                </center>
                            </div>
                        </form>

                        <br><hr><br>
                        <h4><b>Liste de tous les absences des personnels</b></h4><br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Personnel</th>
                                    <th>Téléphone</th>
                                    <th>Jour</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th></th>
                                    {{-- <th></th> --}}
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
                                <td>{{ $attendance->attendance_statut }}</td>
                                
                                
                                {{-- <td class="text-center">
                                    <a href="{{ url('show-avis/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                    <a href="{{ url('edit-attendance/'.$attendance->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                </td> --}}
                                <td class="text-center">
                                    <form action="{{ url('delete-attendance/'.$attendance->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                        <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                                </tr>
    
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Personnel</th>
                                    <th>Téléphone</th>
                                    <th>Jour</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th></th>
                                    {{-- <th></th> --}}
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