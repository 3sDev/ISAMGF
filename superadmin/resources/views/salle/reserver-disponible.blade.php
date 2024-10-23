
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Réserver une salle')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Réserver une salle</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('sallestatut') }}">Choisir une date</a></li>
          <li class="breadcrumb-item active">Séléctionner une salle</li>
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
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('reserver-seance-salle') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <b>Liste des salles</b>
                                    <select name="salle" style="width:100%;" class="form-control" required>
                                        <option value="">Séléctionner une salle</option>
                                        @foreach ($salleEmplois as $element)
                                            <option value="{{ $element->id }}">{{ $element->fullName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4"></div>                            
                        </div>

                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-primary btn-info btn-just-icon like text-center">Réserver</button>
                            </center>
                        </div>
                    </form>

                   
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection