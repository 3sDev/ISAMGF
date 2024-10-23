
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des sorties')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des sorties</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des sorties</li>
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
                                <th>Etudiant</th>
                                <th>Groupe</th>
                                <th>Objectif sortie</th>
                                <th>Date demande</th>
                                <th>Lieu</th>
                                <th>Encadrant</th>
                                <th>Période</th>
                                <th width="10%">Acceptation</th>
                                <th width="10%">Faite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ActivitesSortie as $sortieElement)
                            
                            <tr>
                            <td>{{ $sortieElement->student->full_name }}</td>
                            <td><span>{{ $sortieElement->classe->abbreviation }}</span></td>
                            <td><span>{{ $sortieElement->sortie_raison }}</span></td>
                            <td><span>{{ date('Y-m-d | H:i', strtotime($sortieElement->created_at)) }}</span></td>
                            <td><span>{{ $sortieElement->sortie_destination }}</span></td>
                            <td><span>{{ $sortieElement->sortie_compagnon }}</span></td>
                            <td><span>{{ date('Y-m-d', strtotime($sortieElement->sortie_debut)) }} / {{ date('Y-m-d', strtotime($sortieElement->sortie_fin)) }}</span></td>
                            <td align="center">
                               <form action="{{ url('update-sortie-accepter/'.$sortieElement->id) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                                    @csrf
                                    @method('PUT') 
                                    <input type="text" style="display: none;" name="accepter" value="{{ $sortieElement->accepter }}">

                                    @if (($sortieElement->accepter == '0'))
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon edit btn-sm" style="color: white">Non accepté</button>
                                    @endif
                                    @if (($sortieElement->accepter == '1'))
                                    <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm" style="color: white">Accepté</button>
                                    @endif                                
                                </form>
                            </td>
                            <td align="center">
                                <form action="{{ url('update-sortie-faite/'.$sortieElement->id) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                                    @csrf
                                    @method('PUT') 
                                    <input type="text" style="display: none;" name="faite" value="{{ $sortieElement->faite }}">

                                    @if (($sortieElement->faite == '0'))
                                    <button type="submit" class="btn btn-link btn-warning btn-just-icon edit btn-sm" style="color: white">Non Faite</button>
                                    @endif
                                    @if (($sortieElement->faite == '1'))
                                    <button type="submit" class="btn btn-link btn-info btn-just-icon edit btn-sm" style="color: white">Faite</button>
                                    @endif                                
                                </form>
                             </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Etudiant</th>
                                <th>Groupe</th>
                                <th>Objectif sortie</th>
                                <th>Date demande</th>
                                <th>Lieu</th>
                                <th>Encadrant</th>
                                <th>Période</th>
                                <th>Acceptation</th>
                                <th>Faite</th>
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