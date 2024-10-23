@extends('adminlayoutscolarite.layout')
@section('title', 'Liste des emploi de temps')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
    <h1 class="m-0">Liste des emploi de temps pour les étudiants</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Liste des emploi de temps des Groupes</li>
    </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.textable {
overflow: hidden;
text-overflow: ellipsis;
display: -webkit-box;
-webkit-line-clamp: 1; /* number of lines to show */
-webkit-box-orient: vertical;
}
.emploiTemps{
width: 60px;
height: 40px;
border: 1px solid #ccc;
transition: transform .2s; /* Animation */
margin: 0 auto;
}
.emploiTemps:hover {
transform: scale(4.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="16%">Emploi</th>
                            <th width="9%">Année</th>
                            <th width="7%">Semestre</th>
                            <th>Classe</th>
                            <th width="12%">Date</th>
                            <th width="5%">Action</th>
                            {{-- <th width="5%">Supp</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emploiStudent as $emploi)
                        
                        <tr>
                        <td class="text-center">
                            <div class="filtr-item">
                                <a href={{ asset($upload.'/emploi-student-file/'.$emploi->fichier) }} target="_blank" data-toggle="lightbox" data-title="sample 4 - red">
                                <img class="emploiTemps" src={{ asset($upload.'/emploi-student-file/'.$emploi->fichier) }} alt="Emploi"/>
                                </a>
                            </div>
                        </td>
                        <td>{{ $emploi->annee_universitaire }}</td>
                        <td class="text-center">{{ $emploi->semestre }}</td>
                        <td>{{ $emploi->classe->abbreviation }}</td>
                        <td>{{ date('F d, Y', strtotime($emploi->created_at)) }}</td>
                        
                        <td class="text-center">
                            <a href="{{ url('show-emploiStudent/'.$emploi->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                            {{-- <a href="{{ url('edit-emploiStudent/'.$emploi->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a> --}}
                        </td>
                        {{-- <td class="text-center">
                            <form action="{{ url('delete-emploiStudent/'.$emploi->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </form>
                        </td> --}}
                        </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Emploi</th>
                            <th>Année</th>
                            <th>Semestre</th>
                            <th>Classe</th>
                            <th>Date</th>
                            <th>Action</th>
                            {{-- <th>Supp</th> --}}
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