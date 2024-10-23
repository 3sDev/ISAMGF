
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des rapports empruntés')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des rapports empruntés</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des rapports empruntés</li>
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
                                <th>Nbr rapports</th>
                                <th>Nom rapport</th>
                                <th>Date récupération</th>
                                <th>Période d'emprunter</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Stagesemprunter as $empElement)
                            
                            <tr>
                            <td>{{ $empElement->student->full_name }}</td>
                            <td><span>{{ $empElement->classe->abbreviation }}</span></td>
                            <td><span>{{ $empElement->emprunter_rapport_nombre }}</span></td>
                            <td><span>{{ $empElement->emprunter_rapport_titles }}</span></td>
                            <td><span>{{ date('Y-m-d | H:i', strtotime($empElement->updated_at)) }}</span></td>
                            <td><span>{{ $empElement->emprunter_rapport_debut }} / {{ $empElement->emprunter_rapport_fin }}</span></td>
                            <td align="center">
                               <form action="{{ url('update-emprunter-rapport/'.$empElement->id) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                                    @csrf
                                    @method('PUT') 
                                    <input type="text" style="display: none;" name="recuperer" value="{{ $empElement->accepter }}">

                                    @if (($empElement->recuperer == '0'))
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon edit btn-sm" style="color: white">Non récupéré</button>
                                    @endif
                                    @if (($empElement->recuperer == '1'))
                                    <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm" style="color: white">Récupéré</button>
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
                                <th>Nbr rapports</th>
                                <th>Nom rapport</th>
                                <th>Date récupération</th>
                                <th>Période d'emprunter</th>
                                <th>Action</th>
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