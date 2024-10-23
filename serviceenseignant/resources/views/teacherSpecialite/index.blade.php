
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Gestion des spécialités enseignants')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0">Liste des spécialités enseignants </h4>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des spécialités enseignants</li>
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
                    
                    <div class="col-lg-12" style="text-align:left !important;">
                        <div class="form-group">
                            <br>
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8">
                                    <a href="{{ url('specialiteTeachers/create') }}" class="btn btn-success float-right">Ajouter</a><br><br>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="6%">ID</th>
                                                <th>Spécialité</th>
                                                <th width="8%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($specialites as $spec)
                                            
                                            <tr>
                                                <td>{{ $spec->id }}</td>
                                                <td>{{ $spec->label}}</td>
                                                
                                                <td class="text-center">
                                                    <form action="{{ url('delete-specialite/'.$spec->id) }}" onsubmit="return confirm('Confirmation!')">
                                                        <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-2"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection