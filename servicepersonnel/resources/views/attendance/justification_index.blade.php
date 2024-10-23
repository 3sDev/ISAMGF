@extends('adminlayoutscolarite.layout')
@section('title', 'Justifications des absences')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            {{-- <h1 class="m-0">Justifications des absences</h1> --}}
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Justifications des absences</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/ajaxSelect.css') }}" />
<style>
    .btn-link{color: white;}
    .btn-link:hover{color: white;}
    .fa-info-circle{cursor: pointer;}
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
                    <h4><b>Justifications des absences</b>
                        <a href="{{ url('dashboards') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="container" style="margin-top: 10px;">
                        <form action="{{ url('show-justification') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col-lg-1"></div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <b>Liste des classes</b>
                                        <select name="classe_id" class="form-control" required style="width:100% !important;">
                                            @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}"> {{ $classe->classeName }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <b>Choisir une date</b>
                                        <input type="date" name="dateattendance" class="form-control" style="width:100% !important;">                                    
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-3"></div>
                                
                            </div>

                            <div class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-primary btn-info btn-just-icon like text-center">Afficher</button>
                                </center>
                            </div>
                        </form>
                    </div>
                    <hr><br>
                    <h4><b>Liste de tous les absences</b></h4><br>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="13%">Etudiant</th>
                                <th width="10%">Classe</th>
                                <th width="20%">Matière</th>
                                <th width="8%">Date Absent</th>
                                <th width="10%">Justification</th>
                                <th width="4%"></th>
                                <th width="4%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $absElement)
                            
                            <tr>
                            <td>{{ $absElement->id }}</td>
                            <td><span>{{ $absElement->student->nom.' '.$absElement->student->prenom }}</span></td>
                            <td><span>{{ $absElement->classe->abbreviation }}</span></td>
                            <td>{{ $absElement->matiere->subjectLabel }}</td>
                            <td>{{ date('Y-m-d', strtotime($absElement->attendance_date)) }}</td>
                            <td>
                                @if ((empty($absElement->justification)))
                                    <span class="demandEncours">Non justifié</span>
                                @else 
                                {{-- (($absElement->justification !== 'null')) --}}
                                    <span class="demandTraitee">Justifié <i class="fa fa-info-circle" title="{{ $absElement->justification }}" aria-hidden="true"></i></span>
                                @endif
                            </td>
                            
                            <td class="text-right">
                                {{-- <a href="{{ url('show-avis/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('edit-attendance/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ url('delete-attendance/'.$absElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="13%">Etudiant</th>
                                <th width="10%">Classe</th>
                                <th width="20%">Matière</th>
                                <th width="8%">Date Absent</th>
                                <th width="10%">Justification</th>
                                <th width="4%"></th>
                                <th width="4%"></th>
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