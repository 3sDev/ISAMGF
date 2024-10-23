
@extends('adminlayoutscolarite.layout')
@section('title', 'Détails éliminations')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails éliminations</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('eliminations') }}">Chercher éliminations</a></li>
          <li class="breadcrumb-item active">Détails éliminations</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

<style>
  .inputStyle {
    background: none !important;
    border: none !important;
    width: 50px;
  }
.NonElim{
  background: rgb(233, 252, 205);

}
.Elim{
  background: rgb(249, 183, 183);
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title">Saisir les absences des étudiants</h3> 
                    <a href="{{ url('eliminations') }}" class="btn btn-primary float-right">Retour</a>
                </div> --}}
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <form action="{{ url('getElimination') }}" method="POST">
                      @csrf

                      @foreach ($classResult as $classItem)
                        <center>
                          <h5><b>Semestre :</b> {{ $semestre }}</h5>
                          <h5><b>Classe :</b> {{ $classItem->abbreviation }}</h5>
                          @foreach ($dataMatiere as $matiereItem)
                            <h5><b>Matière :</b> {{ $matiereItem->subjectLabel .'('.$matiereItem->description.')' }} / <b>Nombre élimination :  </b>{{$nombreElimination}}</h5>
                          @endforeach
                        </center>
                      @endforeach

                      <br>  
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                              <th width="10%">ID</th>
                              <th width="60%">Nom et Prénom</th>  
                              <th width="30%" align="center" style="text-align: center !important">Nombre des absences</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($listeStudents as $item)
                            @if ($item->nbr >= $nombreElimination)
                            <tr>
                                <td>{{ $item->idStudent }}</td>
                                <td>{{ $item->nomStudent .' '. $item->prenomStudent }}</td>
                                <td align="center">{{ $item->nbr}}</td>
                            </tr>
                            @endif
                          @endforeach
                      </tbody>
                      </table>
                    </form>

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                      <div class="col-12">
                        <br><br><a href="#" onclick="window.print();return false;" rel="noopener" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
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