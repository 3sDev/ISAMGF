
@extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des rattrapages')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0">Liste des rattrapages</h4>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des rattrapages</li>
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
.demandEnvoyee {
    background-color: #87887f85;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 10%;
}

.demandRefuse {
    background-color: #eb1f108c;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 10%;
}

.demandTraitee {
    background-color: #40da1283;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 10%;
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <a href="{{ url('rattrapage/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th>Date</th>
                                <th>H_Debut</th>
                                <th>H_Fin</th>
                                <th>Durée</th>
                                <th>Matière</th>
                                <th>Enseignant</th>
                                <th>Classe</th>
                                <th>Salle</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rattrapages as $rattrapage)
                                @if (Carbon\Carbon::now() > $rattrapage->date )
                                    <tr style="background: rgb(255, 228, 219)">
                                @else
                                    <tr style="background: rgb(225, 255, 211)">
                                @endif
                                <td>{{ $rattrapage->id }}</td>
                                <td>{{ $rattrapage->date }}</td>
                                <td>{{ $rattrapage->heure_debut }}</td>
                                <td>{{ $rattrapage->heure_fin }}</td>
                                <td>{{ $rattrapage->duree }}</td>
                                <td>{{ $rattrapage->matieres->subjectLabel }} <b>({{ $rattrapage->matieres->description }})</b></td>
                                <td>{{ $rattrapage->teacher->full_name }}</td>
                                <td>{{ $rattrapage->classes->abbreviation }}</td>
                                <td>{{ $rattrapage->salles->fullName }}</td>
                                
                                <td class="text-right">
                                    <a href="{{ url('rattrapage/'.$rattrapage->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                                <td>
                                    <form action="{{ url('delete-rattrapage/'.$rattrapage->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                        <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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