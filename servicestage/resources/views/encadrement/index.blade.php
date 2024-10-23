
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Encadrement PFE')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Encadrement PFE</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Encadrement PFE</li>
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
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title"></h3>
                    <a href="{{ url('events/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Encadrant</th>
                                <th>Etudiant</th>
                                <th>Groupe</th>
                                <th>Stage</th>
                                <th>Binôme</th>
                                <th>Soutenance</th>
                                <th>Sujet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Stagespfe as $pfeElement)
                            
                            <tr>
                                <td><span>{{ $pfeElement->encadrant_pfe }}</span></td>
                            <td>{{ $pfeElement->student->full_name }}</td>
                            <td><span>{{ $pfeElement->classe->abbreviation }}</span></td>
                            
                            @if ($pfeElement->sous_type=='اقتراح مشروع تخرج في شركة')
                                <td>Industriel</td>
                            @else
                                <td>Didactique</td>
                            @endif
                            <td><span>{{ $pfeElement->binome_pfe }}</span></td>
                            <td><span>{{ $pfeElement->soutenance_pfe }} </span></td>
                            <td>
                                <span>{{ $pfeElement->nom_pfe }}</span>
                            {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                Projet Fin d'Etude
                            </button>
                            
                            <center>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Information PFE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body" style="text-align: left !important;">
                                        <b>Sujet:</b><br>{{ $pfeElement->nom_pfe }} <br>
                                        <b>Description:</b><br>{{ $pfeElement->problematique_pfe }} <br>
                                        <b>Bibliographie:</b><br>{{ $pfeElement->bibliographie_pfe }} <br>
                                        <b>Décision PFE:</b><br>{{ $pfeElement->desicion_pfe }} <br>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </center> --}}
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Encadrant</th>
                                <th>Etudiant</th>
                                <th>Groupe</th>
                                <th>Stage</th>
                                <th>Binôme</th>
                                <th>Soutenance</th>
                                <th>Sujet</th>
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