
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Liste des stages professionnels')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des stages professionnels</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des stages professionnels</li>
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
                                <th>Stage</th>
                                <th>Société</th>
                                <th>Etat</th>
                                <th>Période</th>
                                <th width="10%">Action</th>
                                <th width="5%">Modif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Stagesprofessionnel as $proElement)
                            
                            <tr>
                            <td>{{ $proElement->student->full_name }}</td>
                            <td><span>{{ $proElement->classe->abbreviation }}</span></td>
                            <td><span>{{ $proElement->sous_type }}</span></td>
                            <td><span>{{ $proElement->stage_company }}</span></td>
                            <td>
                                @if ($proElement->accepter == '0' )
                                    <span>Non accepté</span>
                                @else
                                    <span>Accepté</span>
                                @endif
                                
                            </td>
                            <td><span>{{ $proElement->stage_debut }} / {{ $proElement->stage_fin }}</span></td>
                            <td align="center">
                               <form action="{{ url('update-stage-professionnel/'.$proElement->id) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                                    @csrf
                                    @method('PUT') 
                                    <input type="text" style="display: none;" name="accepter" value="{{ $proElement->accepter }}">

                                    @if (($proElement->accepter == '0'))
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon edit btn-sm" style="color: white">Réfuser</button>
                                    @endif
                                    @if (($proElement->accepter == '1'))
                                    <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm" style="color: white">Accètper</button>
                                    @endif                                
                                </form>
                            </td>
                            <td class="text-center">
                                {{-- <a href="{{ url('show-pfe/'.$pfeElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('edit-pro/'.$proElement->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Etudiant</th>
                                <th>Groupe</th>
                                <th>Stage</th>
                                <th>Société</th>
                                <th>Etat</th>
                                <th>Période</th>
                                <th>Action</th>
                                <th>Modif</th>
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