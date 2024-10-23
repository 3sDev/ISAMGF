
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Gestion des soldes')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Gestion des soldes</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Gestion des soldes</li>
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
.duree {
    background-color: rgb(255, 242, 242);
    font-weight: bold;
    color: rgb(32, 31, 29);
}
.reste {
    background-color: rgb(242, 255, 244);
    font-weight: bold;
    color: rgb(32, 31, 29);
}
</style>

<div class="row">
    @if (session('message'))
    <h5>{{ session('message') }}</h5>
        @endif
    <div class="col-12">
        <div class="card">
            <br>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('addSoldeAndAnnee') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <label for="">Ajout solde + année de personnel</label>
                            <select name="personnel_id" id="personnel_id" data-style="btn btn-primary" style="width: 100% !important;" required class="form-control" required>
                                <option value="" selected disabled>Selectionner personnel</option>
                                @foreach ($personnels as $perso)
                                    <option value="{{ $perso->id }}"> {{ $perso->nom.' '.$perso->prenom }}</option>
                                @endforeach
                            </select><br>
                            <center>
                                <button type="submit" class="btn btn-primary">Accéder</button>
                            </center>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </form>
                <br><hr><br>
                <h4>Liste des soldes personnels</h4>
                <table id="example1" class="table table-bordered table-striped text-right">
                    <thead>
                        <tr>
                            <th>عطلة مرض</th>
                            <th>عطلة تعويضية</th>
                            <th>عطلة استثنائية</th>
                            <th>عطلة سنوية</th>
                            <th width="10%">الهاتف</th>
                            <th width="18%">الأعوان</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($soldes as $element)
                        
                        <tr>
                            <td><span>{{ $element->conge_maladie }}</span></td>
                            <td><span>{{ $element->conge_compensatoire }}</span></td>
                            <td><span>{{ $element->conge_exceptionnel }}</span></td>
                            <td><span>{{ $element->conge_annual }}</span></td>
                            <td><span>{{ $element->personnel->tel1_personnel }}</span></td>
                            <td><span>{{ $element->personnel->nom.' '.$element->personnel->prenom }}</span></td>
                            
                            {{-- <td class="text-center">
                                <a href="{{ url('show-missions/'.$element->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                <a href="{{ url('edit-solde/'.$element->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td> --}}
                            {{-- <td>
                                <form action="{{ url('delete-conge/'.$element->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td> --}}
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