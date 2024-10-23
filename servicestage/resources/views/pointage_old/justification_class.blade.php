
 @extends('adminlayoutscolarite.layout')
 @section('title', 'Justification des absences')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- <h1 class="m-0">Justification des absences</h1> --}}
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Justification des absences</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<style>
  .inputStyle {
    background: none !important;
    border: none !important;
    width: 50px;
  }
</style>


<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.textable {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
.fa-info-circle{cursor: pointer;}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Justification des absences</h3>
                    <a href="{{ url('justifications') }}" class="btn btn-danger float-right">Retour</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  @foreach ($classResult as $classItem)
                        <center><h5><b>Classe :</b> {{ $classItem->classeName }}</h5>

                        @if ($dateAbs != '')
                            <h5><b>Date de présence :</b> {{ $dateAbs }}</h5><br></center>
                        @else 
                            <h6>Date n'est pas séléctionnée</h6><br></center>
                        @endif

                        
                    @endforeach
                    <form action="{{ url('attendances') }}" method="POST">
                      @csrf
                      <br>  
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="13%">Etudiant</th>
                                <th width="20%">Matière</th>
                                <th width="8%">Date Absent</th>
                                <th width="10%">Justification</th>
                                <th width="4%"></th>
                                <th width="4%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $absElement)
                            
                            <tr>
                            <td>{{ $absElement->id }}</td>
                            <td><span>{{ $absElement->student->nom.' '.$absElement->student->prenom }}</span></td>
                            <td>{{ $absElement->matiere->subjectLabel }}</td>
                            <td>{{ date('Y-m-d', strtotime($absElement->attendance_date)) }}</td>
                            <td>
                                @if ((empty($absElement->justification)))
                                    <span class="demandEncours">Non justifié</span>
                                @else 
                                {{-- (($absElement->justification !== 'null')) --}}
                                    <span class="demandTraitee">Justifié <i class="fa fa-info-circle" title="{{ $absElement->justification }}" aria-hidden="true"></i></span>
                                @endif
                            </td>
                            
                            <td class="text-right">
                                {{-- <a href="{{ url('show-avis/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                <a href="{{ url('edit-attendance/'.$absElement->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                            <td>
                                <form action="{{ url('delete-attendance/'.$absElement->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </form>
                            </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="5%">ID</th>
                                <th width="13%">Etudiant</th>
                                <th width="20%">Matière</th>
                                <th width="8%">Date Absent</th>
                                <th width="10%">Justification</th>
                                <th width="4%"></th>
                                <th width="4%"></th>
                            </tr>
                        </tfoot>
                    </table>
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