
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Mes notes')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Mes notes</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Mes notes</li>
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
.badge{
    font-size: 15px;
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mes notes</h3>
                    <a href="{{ url('agenda/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">titre</th>
                                <th width="35%">Description</th>
                                <th width="15%">Date Rappel</th>
                                <th width="8%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda as $agd)
                            
                            <tr>
                            <td>{{ $agd->id }}</td>
                            <td><span class="textable">{{ $agd->titre }}</span></td>
                            <td><span class="textable">{{ $agd->description }}</span></td>
                            <span style="display: none;">{{ $dateNow = now(); }}<span>
                            @if ($agd->date_rappel > $dateNow)
                                <td><span class="float-center badge badge-success">
                                    {{ $agd->date_rappel }}</span>
                                </td>
                            @else
                                <td><span class="float-center badge badge-danger">
                                    {{ $agd->date_rappel }}</span>
                                </td>
                            @endif
                            <td class="text-center">
                                <a href="{{ url('show-agenda/'.$agd->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                                <a href="{{ url('agenda/'.$agd->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td class="text-center">
                                <form action="{{ url('delete-agenda/'.$agd->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th >titre</th>
                                <th >Description</th>
                                <th >Date Rappel</th>
                                <th ></th>
                                <th></th>
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