@extends('adminlayoutscolarite.layout')
@section('title', 'Liste des Eliminations')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- <h1 class="m-0">Chercher éliminations</h1> --}}
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Chercher éliminations</li>
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
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chercher éliminations</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <form action="{{ url('elimination-post') }}" method="POST">
                      @csrf

                      <div class="row">
                        <div class="col-lg-2">
                            <label for="">Semestre</label>
                            <select id="semestre" name="semestre" class="form-control" style="width: 100%;" required>
                                <option value="">Selectionner semestre</option>
                                <option value="" disabled>---------------------</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <label for="">Choisir classe</label>
                            <select name="classe_id" id="classes" class="form-control" style="width: 100%;" required>
                                <option value="">Selectionner Classe</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}"> {{ $classe->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <label for="">Choisir matière</label>
                            <select name="matiere_id" id="matiere" data-style="btn btn-primary"  style="width: 100%;" class="form-control" required>
                                <option value="">Selectionner Matière</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                      <center><button type="submit" class="btn btn-primary">Afficher</button></center>
                      <br>  
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
<script>
  // when classes dropdown changes
  $('#classes').change(function() {
      var classeID = $(this).val();
      var semestreSelect = $("#semestre").val();
      if (classeID) {
  
          $.ajax({
              type: "GET",
              url: "{{ url('getMatiere') }}?classe_id=" + classeID+"&semestre=" + semestreSelect,
              success: function(res) {
  
                  if (res) {
  
                      $("#matiere").empty();
                      $("#matiere").append('<option value="" selected disabled>Selectionner Matière</option>');
  
                      res.map(element=>{
                      $("#matiere").append('<option value="'+element.matiere_id+'/'+element.nbr_eliminatoire+'">' + element.subjectLabel +'<b>('+element.description+') / '+element.nbr_eliminatoire+'</b></option>');
                      });
  
                  } else {
                      $("#matiere").empty();
                  }
              }
          });
      } else {
          $("#matiere").empty();
      }
  });
</script>
@endsection