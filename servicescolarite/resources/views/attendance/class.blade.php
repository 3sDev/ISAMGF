@extends('adminlayoutscolarite.layout')
@section('title', 'Classe étudiants')
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
<link rel="stylesheet" href="{{ URL::asset('css/ajaxSelect.css') }}" />
<style>
    .btn-link{color: white;}
    .btn-link:hover{color: white;}
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
                    <h5>Choisir une classe pour gérer les absences
                        <a href="{{ url('dashboards') }}" class="btn btn-danger float-right">Retour</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="container" style="margin-top: 10px;">
                        <form action="{{ url('create-attendances') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <b>Liste des classes</b>
                                        <select name="classe_id" class="form-control" required>
                                            @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <b>Choisir Date</b>
                                        <input type="date" name="dateattendance" id="dateID" class="form-control" required>                                    
                                    </div>
                                    <br>
                                </div>

                                </div>

                                <div class="col-lg-2"></div>
                                
                            </div>

                            <div class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-primary btn-info btn-just-icon like text-center">Ajouter</button>
                                </center>
                            </div>
                        </form>

                        <hr><br>
                        <h4><b>Liste de tous les absences</b></h4><br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th >Enseignant</th>
                                    <th >Etudiant</th>
                                    <th >Classe</th>
                                    <th >Matière</th>
                                    <th>Date</th>
                                    <th>Seance</th>
                                    <th >Justification</th>
                                    <th width="4%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $absElement)
                                
                                <tr>
                                <td>
                                    @if ($absElement->qui_save_absent == 'Enseignant')
                                        <span class="demandEncours">Enseignant</span>
                                    @else 
                                        <span class="demandTraitee">Scolarité</span>
                                    @endif
                                </td>
                                <td><span>{{ $absElement->teacher->nom.' '.$absElement->teacher->prenom }}</span></td>
                                <td><span>{{ $absElement->student->nom.' '.$absElement->student->prenom }}</span></td>
                                <td><span>{{ $absElement->classe->abbreviation }}</span></td>
                                <td>{{ $absElement->matiere->subjectLabel }}</td>
                                <td>{{ date('Y-m-d', strtotime($absElement->attendance_date)) }}</td>
                                <td>{{ $absElement->attendance_seance_debut }} | {{ $absElement->attendance_seance_fin }}</td>
                                <td>
                                    @if ((empty($absElement->justification)))
                                        <span class="demandEncours">Non justifié</span>
                                    @else 
                                    {{-- (($absElement->justification !== 'null')) --}}
                                        <span class="demandTraitee">Justifié <i class="fa fa-info-circle" title="{{ $absElement->justification }}" aria-hidden="true"></i></span>
                                    @endif
                                </td>
                                
                                {{-- <td class="text-right">
                                    <a href="{{ url('show-avis/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                    <a href="{{ url('edit-attendance/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                </td> --}}
                                <td align="center">
                                    @if ($absElement->qui_save_absent == 'Enseignant')
                                        -
                                    @else 
                                    <form action="{{ url('delete-attendance-student/'.$absElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
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
                                    <th>Etudiant</th>
                                    <th>Classe</th>
                                    <th>Matière</th>
                                    <th>Date Absent</th>
                                    <th>Seance</th>
                                    <th>Justification</th>
                                    <th width="4%"></th>
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