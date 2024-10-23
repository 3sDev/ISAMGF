
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
            <div class="row">
                <div class="col-lg-12" style="text-align:left !important;">
                    <div id="FormEnseignant" >
                      <div class="form-group">
                        <form action="{{ url('addmessageservice') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr d\'envoyer ce message?')" enctype="multipart/form-data">
                          @csrf
                          <center><br><h4>Message vers Admin (Service)</h4><br><br></center>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label for="">Choisir Admin</label>
                                  <select id="users" name="user_receiver_id" data-style="btn btn-primary" required class="form-control">
                                    <option value="{{ $IDUSER }}" selected> {{ $NAMEUSER }} ({{ $ROLEUSER }})</option>
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
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection