@extends('adminlayoutscolarite.layout')
@section('title', 'Rechercher étudiants')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Filtrage des Etudiants</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Rechercher un étudiant</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<link rel="stylesheet" href="{{ URL::asset('css/ajaxSelect.css') }}" />
<style>
.btn-link{
    color:white;
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
                    <a href="{{ url('dashboards') }}" class="btn btn-danger float-right">Back</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nom et Prénom</th>
                                <th>Classe</th>
                                <th>Département</th>
                                <th>Niveau</th>
                                <th>Genre</th>
                                <th>Nature Bac</th>
                                <th>Type Inscription</th>
                                <th>Gouvernorat </th>
                                <th class="disabled-sorting text-center">Actions</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $item)
                            
                            <tr>
                                <td>{{ $item->prenom .' '. $item->nom }}</td>
                                <td>{{ $item->classe->abbreviation }}</td>
                                <td>{{ $item->filiere }}</td>
                                <td>{{ $item->diplome }}</td>
                                <td>{{ $item->genre }}</td>
                                <td>{{ $item->section_bac }}</td>
                                <td>{{ $item->type_inscription }}</td>
                                <td>{{ $item->gov }}</td>
                                <td align="center">

                                @if (($item->active == '0'))
                                <button type="submit" class="btn btn-link btn-warning btn-just-icon edit btn-sm">Désactivé</button>
                                @endif
                                @if (($item->active == '1'))
                                <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm">Inscrit / Activé</button>
                                @endif
                                @if (($item->active == '2'))
                                <button type="submit" class="btn btn-link btn-danger btn-just-icon edit btn-sm">Non inscrit</button>
                                @endif
                                @if (($item->active == '3'))
                                <button type="submit" class="btn btn-link btn-info btn-just-icon edit btn-sm">Retrait Inscrit</button>
                                @endif
                                @if (($item->active == '4'))
                                <button type="submit" class="btn btn-link btn-secondary btn-just-icon edit btn-sm">Mutation</button>
                                @endif
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nom et Prénom</th>
                                <th>Classe</th>
                                <th>Département</th>
                                <th>Niveau</th>
                                <th>Genre</th>
                                <th>Nature Bac</th>
                                <th>Type Inscription</th>
                                <th>Gouvernorat </th>
                                <th class="disabled-sorting text-center">Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection