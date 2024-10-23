
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Gestion des postes des personnels ')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3 class="m-0">Gestion des postes des personnels </h3>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Gestion des postes des personnels </li>
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
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="container-tab">
                                <ul class="nav nav-pills mb-8" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-categorie-tab" data-toggle="pill" href="#pills-categorie" role="tab" aria-controls="pills-categorie" aria-selected="true" >Catégorie</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-grade-tab" data-toggle="pill" href="#pills-grade" role="tab" aria-controls="pills-grade" aria-selected="false" >Grade</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-fonction-tab" data-toggle="pill" href="#pills-fonction" role="tab" aria-controls="pills-fonction" aria-selected="false">Fonction</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    <hr><br>
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane show fade active" id="pills-categorie" role="tabpanel" aria-labelledby="pills-categorie-tab">
                            <div class="col-lg-12" style="text-align:left !important;">
                                <div class="form-group">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <a href="{{ url('postePersonnels/create?category=categorie') }}" target="_blank" class="btn btn-success float-right">Ajouter</a><br><br>
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="6%">ID</th>
                                                        <th>Catégorie (FR)</th>
                                                        <th>Catégorie (AR)</th>
                                                        {{-- <th></th> --}}
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($categories as $cat)
                                                    
                                                    <tr>
                                                        <td>{{ $cat->id }}</td>
                                                        <td>{{ $cat->label_fr }}</td>
                                                        <td>{{ $cat->label_ar }}</td>
                                                        
                                                        {{--  <td class="text-center">
                                                            <a href="{{ url('edit-poste/'.$cat->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                        </td> --}}
                                                        <td class="text-center">
                                                            <form action="{{ url('delete-poste/'.$cat->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
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

                        <div class="tab-pane show fade" id="pills-grade" role="tabpanel" aria-labelledby="pills-grade-tab">
                            <div class="col-lg-12" style="text-align:left !important;">
                                <div class="form-group">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <a href="{{ url('postePersonnels/create?category=grade') }}" target="_blank" class="btn btn-success float-right">Ajouter</a><br><br>
                                            <table id="example2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="6%">ID</th>
                                                        <th>Grade (FR)</th>
                                                        <th>Grade (AR)</th>
                                                        {{-- <th></th> --}}
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($grades as $grade)
                                                    
                                                    <tr>
                                                        <td>{{ $grade->id }}</td>
                                                        <td>{{ $grade->label_fr }}</td>
                                                        <td>{{ $grade->label_ar }}</td>

                                                        {{--  <td class="text-center">
                                                            <a href="{{ url('edit-poste/'.$grade->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                        </td> --}}
                                                        <td class="text-center">
                                                            <form action="{{ url('delete-poste/'.$grade->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
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
                                    <!-- /.col -->
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane show fade" id="pills-fonction" role="tabpanel" aria-labelledby="pills-fonction-tab">
                            <div class="col-lg-12" style="text-align:left !important;">
                                <div class="form-group">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <a href="{{ url('postePersonnels/create?category=fonction') }}" target="_blank" class="btn btn-success float-right">Ajouter</a><br><br>
                                            <table id="example3" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="6%">ID</th>
                                                        <th>Fonction (FR)</th>
                                                        <th>Fonction (AR)</th>
                                                        {{-- <th></th> --}}
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($fonctions as $fonction)
                                                    
                                                    <tr>
                                                        <td>{{ $fonction->id }}</td>
                                                        <td>{{ $fonction->label_fr }}</td>
                                                        <td>{{ $fonction->label_ar }}</td>
                                                        
                                                        {{--  <td class="text-center">
                                                            <a href="{{ url('edit-poste/'.$fonction->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                        </td> --}}
                                                        <td class="text-center">
                                                            <form action="{{ url('delete-poste/'.$fonction->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
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
                                    <!-- /.col -->
                                </div>
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