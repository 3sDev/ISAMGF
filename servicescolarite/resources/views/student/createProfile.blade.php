@extends('adminlayoutscolarite.layout')
@section('title', 'Profil Etudiant')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Profil Etudiant</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('students') }}">Liste des étudiants</a></li>
                <li class="breadcrumb-item active">Profil Etudiant</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<style>
    .profileStudent {
        font-weight: bold;
        color: blueviolet;
    }
</style>

    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            @foreach ($profiles as $profile)

                    @if ($profile->profile_student == [])
                    <div class="card">
                        <div class="card-header">
                            
                            <h5>Ajouter le profile d`étudiant <span class="profileStudent">{{ $profile->prenom.' '.$profile->nom }}</span>
                                <a href="{{ url('students') }}" class="btn btn-danger float-right">Retour</a>
                            </h5>
                            
                        </div>
                        <div class="card-body">

                    <form action="{{ url('studentprofile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" style="display:none;" name="student_id" value="{{ $profile->id }}" class="form-control">

                        <div class="row" style="margin-top: 3%">
                            <div class="col-md-4">
                                <label for="">Date de naissance</label>
                                <input type="date" name="ddn" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Téléphone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Genre</label><br>
                                <select name="genre" class="form-control" data-size="3" data-style="btn btn-primary btn-round">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>    
                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 3%">
                            <div class="col-md-4">
                                <label for="">Gouvernaurat</label>
                                <input type="text" name="gov" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Rue</label>
                                <input type="text" name="rue" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Code postal</label>
                                <input type="text" name="codepostal" class="form-control">
                            </div>
                        </div>

                        <div class="mb-6" style="margin-top: 3%">
                            <div class="col-md-6 col-sm-6">
                                <label for="">Selectionner image</label>
                                <input type="file" name="profile_image" class="form-control"/>
                            </div>
                        </div>


                                {{-- <div class="row">
                                    <div class="col-md-12">
                                      <div class="card card-default">
                                        <div class="card-header">
                                          <h3 class="card-title">Dropzone.js <small><em>jQuery File Upload</em> like look</small></h3>
                                        </div>
                                        <div class="card-body">
                                          <div id="actions" class="row">
                                            <div class="col-lg-6">
                                              <div class="btn-group w-100">
                                                <span class="btn btn-success col fileinput-button">
                                                  <i class="fas fa-plus"></i>
                                                  <span>Add files</span>
                                                </span>
                                                <button type="submit" class="btn btn-primary col start">
                                                  <i class="fas fa-upload"></i>
                                                  <span>Start upload</span>
                                                </button>
                                                <button type="reset" class="btn btn-warning col cancel">
                                                  <i class="fas fa-times-circle"></i>
                                                  <span>Cancel upload</span>
                                                </button>
                                              </div>
                                            </div>
                                            <div class="col-lg-6 d-flex align-items-center">
                                              <div class="fileupload-process w-100">
                                                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="table table-striped files" id="previews">
                                            <div id="template" class="row mt-2">
                                              <div class="col-auto">
                                                  <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                              </div>
                                              <div class="col d-flex align-items-center">
                                                  <p class="mb-0">
                                                    <span class="lead" data-dz-name></span>
                                                    (<span data-dz-size></span>)
                                                  </p>
                                                  <strong class="error text-danger" data-dz-errormessage></strong>
                                              </div>
                                              <div class="col-4 d-flex align-items-center">
                                                  <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                  </div>
                                              </div>
                                              <div class="col-auto d-flex align-items-center">
                                                <div class="btn-group">
                                                  <button class="btn btn-primary start">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Start</span>
                                                  </button>
                                                  <button data-dz-remove class="btn btn-warning cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancel</span>
                                                  </button>
                                                  <button data-dz-remove class="btn btn-danger delete">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                  </button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                          Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and information about the plugin.
                                        </div>
                                      </div>
                                      <!-- /.card -->
                                    </div>
                                </div> --}}


                                <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    @else

                    <div class="card">
                        <div class="card-header">
                            
                            <h4>Modifier le profile d`étudiant <span class="profileStudent">{{ $profile->prenom.' '.$profile->nom }}</span>
                                <a href="{{ url('students') }}" class="btn btn-danger float-right">Retour</a>
                            </h4>
                            
                        </div>
                        <div class="card-body">
                        <form action="{{ url('update-profilestudent/'.$profile->profile_student->id) }}" enctype="multipart/form-data">
                        
                        @csrf
                        @method('PUT')

                        <input type="text" style="display:none;" name="student_id" value="{{ $profile->id }}" class="form-control">

                        <div class="row" style="margin-top: 3%">
                            <div class="col-md-4">
                                <label for="">Date de naissance</label>
                                <input type="date" name="ddn" value="{{ $profile->profile_student->ddn }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Téléphone</label>
                                <input type="text" name="phone" value="{{ $profile->profile_student->phone }}"  class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Genre</label><br>
                                <select name="genre" class="form-control" data-size="3" data-style="btn btn-primary btn-round">
                                    
                                    @if ( $profile->profile_student->genre == "Homme" )
                                        <option value="{{ $profile->profile_student->genre }}">{{ $profile->profile_student->genre }}</option>
                                        <option value="Femme">Femme</option>    
                                    @elseif ( $profile->profile_student->genre == "Femme")
                                        <option value="{{ $profile->profile_student->genre }}">{{ $profile->profile_student->genre }}</option>
                                        <option value="Homme">Homme</option>    
                                    @else
                                        <option value="Homme">Homme</option>
                                        <option value="Femme">Femme</option>    
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 3%">
                            <div class="col-md-4">
                                <label for="">Gouvernaurat</label>
                                <input type="text" name="gov" value="{{ $profile->profile_student->gov }}"  class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Rue</label>
                                <input type="text" name="rue" value="{{ $profile->profile_student->rue }}"  class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Code postal</label>
                                <input type="text" name="codepostal" value="{{ $profile->profile_student->codepostal }}"  class="form-control">
                            </div>
                        </div>

                            <div class="mb-3" style="margin-top: 3%">
                                <div class="col-md-4 col-sm-4">
                                  <label for="">Selectionner image</label>
                                    <input type="file" class="form-control" name="profile_image" />
                                </div>
                                <button type="submit" class="btn btn-success float-right">Modifier</button>
                            </div>
                        </form> 
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    {{-- <script>
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()
      
          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4'
          })
      
          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
          //Money Euro
          $('[data-mask]').inputmask()
      
          //Date picker
          $('#reservationdate').datetimepicker({
              format: 'L'
          });
      
          //Date and time picker
          $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
      
          //Date range picker
          $('#reservation').daterangepicker()
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
              format: 'MM/DD/YYYY hh:mm A'
            }
          })
          //Date range as a button
          $('#daterange-btn').daterangepicker(
            {
              ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate  : moment()
            },
            function (start, end) {
              $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
          )
      
          //Timepicker
          $('#timepicker').datetimepicker({
            format: 'LT'
          })
      
          //Bootstrap Duallistbox
          $('.duallistbox').bootstrapDualListbox()
      
          //Colorpicker
          $('.my-colorpicker1').colorpicker()
          //color picker with addon
          $('.my-colorpicker2').colorpicker()
      
          $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
          })
      
          $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
          })
      
        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
          window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
      
        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false
      
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)
      
        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
          url: "/target-url", // Set the url
          thumbnailWidth: 80,
          thumbnailHeight: 80,
          parallelUploads: 20,
          previewTemplate: previewTemplate,
          autoQueue: false, // Make sure the files aren't queued until manually added
          previewsContainer: "#previews", // Define the container to display the previews
          clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })
      
        myDropzone.on("addedfile", function(file) {
          // Hookup the start button
          file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
        })
      
        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
          document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })
      
        myDropzone.on("sending", function(file) {
          // Show the total progress bar when upload starts
          document.querySelector("#total-progress").style.opacity = "1"
          // And disable the start button
          file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })
      
        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
          document.querySelector("#total-progress").style.opacity = "0"
        })
      
        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
          myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
          myDropzone.removeAllFiles(true)
        }
        // DropzoneJS Demo Code End
    </script> --}}
@endsection