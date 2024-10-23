
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Créer un message')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Créer un message</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('message') }}">Messagerie</a></li>
          <li class="breadcrumb-item active">Créer un message</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> --}}
{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}

    <div class="row">
        @if (session('message'))
            <h5>{{ session('message') }}</h5>
        @endif
      <!-- /.col -->
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <!-- /.card-header -->
          <div class="card-body">
          {{-- 
            <table width="80%">
                <tr style="text-align: left">
                    <td> 
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="etudiant">
                        <label class="custom-control-label" for="customSwitch1">Rédiger un message pour étudiants</label>
                      </div>
                    </td>                           
                </tr>
                <tr style="text-align: left">
                  <td> 
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="customSwitch2" name="enseignant">
                      <label class="custom-control-label" for="customSwitch2">Rédiger un message pour service administratif</label>
                    </div>
                  </td>                           
                </tr>
            </table>
  
          <hr> --}}
          <div class="row">
              {{-- <div class="col-lg-12" style="text-align:left !important;">      
                  <div id="delivery" style="display:none;">
                      <div class="form-group">

                        <form action="{{ url('addmessage') }}" method="POST" enctype="multipart/form-data">

                          @csrf

                          <center><br><h4>Message vers étudiant</h4><br><br></center>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">Choisir la classe</label>
                                  <select id="classes" name="classe_id" data-style="btn btn-primary" required class="form-control">
                                      <option value="" selected disabled>Selectionner Classe</option>
                                      @foreach ($cls as $key => $cl)
                                          <option value="{{ $key }}"> {{ $cl }}</option>
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="">Choisir l'étudiant</label>
                                  <select name="student_id" id="student" data-style="btn btn-primary" required class="form-control">

                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="">Objet</label>
                              <input class="form-control" name="objet" placeholder="Objet" required>
                            </div>
                            <div class="form-group">
                              <label for="">Message</label>
                              <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px" required>
                              </textarea>
                            </div>
                            <div class="form-group">
                              <label for="">Media</label>
                              <input type="file" name="fichier" class="form-control">
                            </div>
                            <div class="float-right">
                              <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Envoyer</button>
                            </div>

                          </form>

                          </div>
                        </div>
                    </div>
                </div>
              </div> --}}

              <div class="col-lg-12" style="text-align:left !important;">
                  <div id="FormEnseignant" >
                    <div class="form-group">

                      <form action="{{ url('addmessagemultiple') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'envoyer ce message?')" enctype="multipart/form-data">

                        @csrf

                        <center><br><h4>Message vers Admin (Service)</h4><br><br></center>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label for="">Choisir Admin</label>
                                <select name="user_receiver_id[]" class="form-control selectpicker" multiple data-live-search="true" required>
                                    {{-- <option value="" selected disabled>Selectionner Classes</option> --}}
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"> {{ $user->name }} ({{ $user->role }})</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="">Objet</label>
                            <input class="form-control" name="objet" placeholder="Objet" required>
                          </div>
                          <div class="form-group">
                            <label for="">Message</label>
                            <textarea name="message" rows="6" class="form-control" required>
                            </textarea>
                          </div>
                          <div class="form-group">
                            <label for="">Media</label>
                            <input type="file" name="fichier" class="form-control">
                          </div>
                          <div class="float-right">
                            <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Envoyer</button>
                          </div>

                        </form>

                        </div>
                  </div>
              </div>
          </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  <script>
    // when section dropdown changes
    $('#classes').change(function() {

        var studentID = $(this).val();

        if (studentID) {

            $.ajax({
                type: "GET",
                url: "{{ url('getStudent') }}?classe_id=" + studentID,
                success: function(res) {

                    if (res) {

                        $("#student").empty();
                        $("#student").append('<option selected disabled>Selectionner Etudiant</option>');
                        $.each(res, function(key, value) {
                            $("#student").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {

                        $("#student").empty();
                    }
                }
            });
        } else {

            $("#student").empty();
        }
    });

  </script>

    <script>
      var checkbox = document.getElementById('customSwitch1');
      var delivery_divEtudiant = document.getElementById('delivery');
      checkbox.onclick = function() {
          console.log(this);
         if(this.checked) {
          delivery_divEtudiant.style['display'] = 'block';
         } else {
          delivery_divEtudiant.style['display'] = 'none';
         }
      };
      </script>
      <script>
      var checkbox = document.getElementById('customSwitch2');
      var delivery_divEnseignant = document.getElementById('FormEnseignant');
      checkbox.onclick = function() {
          console.log(this);
         if(this.checked) {
          delivery_divEnseignant.style['display'] = 'block';
         } else {
          delivery_divEnseignant.style['display'] = 'none';
         }
      };
      </script>

    
@endsection