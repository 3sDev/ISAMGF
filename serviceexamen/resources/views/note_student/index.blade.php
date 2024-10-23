@extends('adminlayoutscolarite.layout')
@section('title', 'Liste des notes')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
    <div class="col-sm-6">
    </div><!-- /.col -->
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Liste des notes pour les Groupes</li>
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
            <div class="card-header">
                <h3 class="card-title">Liste des notes pour les Groupes</h3>
                <a href="{{ url('noteStudents/create') }}" class="btn btn-primary float-right">Ajouter</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="25%">Titre</th>
                            <th width="9%">Année</th>
                            <th width="7%">Semestre</th>
                            <th width="7%">Type</th>
                            <th width="7%">Session</th>
                            <th>Classe</th>
                            <th width="12%">Date</th>
                            <th width="8%">Action</th>
                            <th width="5%">Supp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notesStudents as $note)
                        
                        <tr>
                        <td>{{ $note->titre }}</td>
                        <td>{{ $note->annee }}</td>
                        <td class="text-center">{{ $note->semestre }}</td>
                        <td class="text-center">{{ $note->type }}</td>
                        <td class="text-center">{{ $note->session }}</td>
                        <td>{{ $note->classe->abbreviation }}</td>
                        <td>{{ date('Y-m-d | h:s', strtotime($note->created_at)) }}</td>
                        
                        <td class="text-center">
                            <a href="{{ url('show-note/'.$note->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                            <a href="{{ url('edit-note/'.$note->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                        <td class="text-center">
                            <form action="{{ url('delete-note/'.$note->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </form>
                        </td>
                        </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Titre</th>
                            <th>Année</th>
                            <th>Semestre</th>
                            <th>Type</th>
                            <th>Session</th>
                            <th>Classe</th>
                            <th>Date</th>
                            <th width="10%">Action</th>
                            <th>Supp</th>
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