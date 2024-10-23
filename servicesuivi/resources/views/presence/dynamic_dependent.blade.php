@extends('adminlayoutenseignant.layout')
@section('title', 'Emploi de temps Enseignant')
@section('contentPage')
 

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.btn-link{
  color:white;
}
#div1{
  margin:auto;
  width:100%;
  padding:100px;
}

#t1 {
  display: inline-block;
  vertical-align: top;
}

.table-emploi{
  border-collapse: collapse;
 }

th, td {
  border: 1px solid #272727;
  padding: 7px;
  text-align: center;
  color:#6e83e0;
  font-weight:bold;
}

th {
  color: White;
  background-color: #575d77;
  
}

th.horaire{
  background-color: #696969;
  color:
}


.silver {
  background-color: rgb(230, 230, 230);}
.vide{
  background-color: #696969;
  width:5px;
}

td:first-child,td.lundi {
  background-color:#575d77;
  color: white;
  font-weight: bold;
  text-align: center;
  width:100px;
  
}

td.jours{
  background-color: #696969;
  width : 30px;
}

code {
   
   display: inline-block;
  vertical-align: middle;
  font-size:20px; 
}

.form-control{
  width: 100% !important;
}

div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em !important;
    /* display: inline-block; */
    width: 70% !important;
}

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #ff7b00 !important;
}
/**********   style séance    ***************/
.styleMatiere{
  font-size: 14px;
  font-weight: 600;
  color: black;
  margin-bottom: -1%;
  line-height: 12pt;
}
.styleProf{
  font-size: 14px;
  font-weight: 400;
  color: rgb(167, 167, 167);
  margin-bottom: -1%;
}
.styleSalle{
  font-size: 13px;
  font-weight: 600;
  color: rgb(197, 70, 12);
  margin-bottom: -2%;
}
.typeMatiere{
  color: #399216;
}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Emploi de temps Enseignant</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Emploi de temps Enseignant</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <section class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Emploi de temps Enseignant
                      </h3>
                      <a href="" class="btn btn-primary float-right">Ajouter</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="col-12">
                      <!-- Main content -->
                      <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                          <div class="col-12">
                            <h4>
                              <i class="fas fa-briefcase"></i> Enseignant
                              <small class="float-right"> </small>
                            </h4>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <br><hr><br>
                        <div class="row">
                          <div class="col-12">
                            <h4>
                              <i class="fas fa-file"></i> Ajouter une séance
                              <small class="float-right"> </small>
                            </h4><br>
                          </div>
                          <div class="col-12">
                            {{-- https://smartschools.tn/university/public/upload/events/ --}}
                            <form action="{{ url('seance-teacher') }}" method="POST" enctype="multipart/form-data">

                              @csrf
                              {{-- @method('PUT') --}}
            
                                  <div class="row">
                                      <div class="col-md-6">
                                        <label for="">Choisir salle</label>
                                        <select name="salle" id="salle" class="form-control" data-dependent="jour">
                                          <option value="">Selectionner Salle</option>

                                          @foreach ($salle_list as $salle)
                                            <option value="{{ $salle->fullName }}"> {{ $salle->fullName }}</option>
                                          @endforeach

                                        </select>
                                      </div>
                                      <div class="col-md-3">
                                        <label for="">Jour</label>
                                        <select name="jour" id="jour" class="form-control" data-dependent="heure">
                                          <option value="">Selectionner Jour</option>
                                        </select>
                                      </div>
                                      <div class="col-md-3">
                                        <label for="">Heure</label>
                                          <select name="heure" id="heure" class="form-control">
                                            <option value="">Selectionner Heure</option>
                                          </select>
                                      </div>
                                      {{ csrf_field() }}
                                  </div>
                                  <br><br>
                                  <div class="mb-3">
                                    <center>
                                      <button type="submit" class="btn btn-primary float-center">Ajouter</button>
                                    </center>
                                  </div>
                             
                              </form>
                            <br><hr><br>
                                
                              </div>
                            </div>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
        
                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                          <div class="col-12">
                            <br><br><a href="#" onclick="window.print();return false;" rel="noopener" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>
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
  </div>
  <!-- /.container-fluid -->
</section>

<script>
  $(document).ready(function(){

    $('.dynamic').change(function(){
      if ($(this).val() != '') 
      {
        var select    = $(this).attr("id");
        var value     = $(this).val();
        var dependent = $(this).data('dependent');
        var _token = $('input[name="_token"]').val();

        $.ajax({
          url:"{{ route('dynamicdependent.fetch') }}",
          method:"POST",
          data:{select:select, value:value, _token:_token, dependent:dependent},

          success:function(result)
          {
            $('#'+dependent).html(result);
          }
        })
      }
    });

  });
</script>
@endsection