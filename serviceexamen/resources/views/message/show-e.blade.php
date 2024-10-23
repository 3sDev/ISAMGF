
 @extends('adminlayoutscolarite.layout')
 @section('title', 'Détails Message')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- <h1 class="m-0">Détails Message</h1> --}}
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('message') }}">Messagerie</a></li>
          <li class="breadcrumb-item active">Détails Message</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<style>
.rotation {
    animation: zoom-in-zoom-out 3s ease infinite;
}
@keyframes zoom-in-zoom-out {
  0% {
    transform: scale(1, 1);
  }
  50% {
    transform: scale(1.5, 1.5);
  }
  100% {
    transform: scale(1, 1);
  }
}

/*----------------- Style of tags ------------------*/

.tags {
  zoom: 1;
}

.tags:before, .tags:after {
  content: '';
  display: table;
}

.tags:after {
  clear: both;
}

ul {
  list-style: none;
  margin-left: -5%;
}

.tags li {
  position: relative;
  float: left;
  margin: 0 0 14px 18px;
  
}

.tags li:active {
  margin-top: 1px;
  margin-bottom: 7px;
}

.tags li:after {
  content: '';
  z-index: 2;
  position: absolute;
  top: 10px;
  right: -2px;
  width: 5px;
  height: 6px;
  opacity: .95;
  background: #eb6b22;
  border-radius: 3px 0 0 3px;
  -webkit-box-shadow: inset 1px 0 #99400e;
  box-shadow: inset 1px 0 #99400e;
}

.tags a, .tags span {
  display: block;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.tags a {
  height: 26px;
  line-height: 23px;
  padding: 0 9px 0 8px;
  font-size: 15px;
  color: #555;
  text-decoration: none;
  text-shadow: 0 1px white;
  background: #fafafa;
  border-width: 1px 0 1px 1px;
  border-style: solid;
  border-color: #dadada #d2d2d2 #c5c5c5;
  border-radius: 3px 0 0 3px;
  background-image: -webkit-linear-gradient(top, #fcfcfc, #f0f0f0);
  background-image: -moz-linear-gradient(top, #fcfcfc, #f0f0f0);
  background-image: -o-linear-gradient(top, #fcfcfc, #f0f0f0);
  background-image: linear-gradient(to bottom, #fcfcfc, #f0f0f0);
  -webkit-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.7), 0 1px 2px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.7), 0 1px 2px rgba(0, 0, 0, 0.05);
}

.tags a:hover span {
  padding: 0 7px 0 6px;
  width: 130% !important;
  -webkit-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.15), 1px 1px 2px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.15), 1px 1px 2px rgba(0, 0, 0, 0.2);
}

.tags span {
  position: absolute;
  top: 1px;
  left: 100%;
  z-index: 2;
  overflow: hidden;
  width: 0;
  height: 25px;
  line-height: 21px;
  padding: 0 0 0 2px;
  color: white;
  text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
  background: #eb6b22;
  border: 1px solid;
  border-color: #d15813 #c85412 #bf5011;
  border-radius: 0 2px 2px 0;
  opacity: .95;
  background-image: -webkit-linear-gradient(top, #ed7b39, #df5e14);
  background-image: -moz-linear-gradient(top, #ed7b39, #df5e14);
  background-image: -o-linear-gradient(top, #ed7b39, #df5e14);
  background-image: linear-gradient(to bottom, #ed7b39, #df5e14);
  -webkit-transition: 0.3s ease-out;
  -moz-transition: 0.3s ease-out;
  -o-transition: 0.3s ease-out;
  transition: 0.3s ease-out;
}

</style>
    <div class="row">
        @if (session('message'))
            <h5>{{ session('message') }}</h5>
        @endif

      {{-- <div class="col-md-3">
        <a href="#" class="btn btn-primary btn-block mb-3">Compose</a>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Folders</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item active">
                <a href="#" class="nav-link">
                  <i class="fas fa-inbox"></i> Inbox
                  <span class="badge bg-primary float-right">12</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-envelope"></i> Sent
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-file-alt"></i> Drafts
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-filter"></i> Junk
                  <span class="badge bg-warning float-right">65</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-trash-alt"></i> Trash
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
      </div> --}}
      <!-- /.col -->
      @foreach ($message as $msg)
      @if ($loop->first)
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Détails Message</h3>
            <span class="float-right">{{ date('Y-m-d | H:s', strtotime($msg->created_at)) }}</span>
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="row">
              <div class="col-lg-12">
                <label for="">Envoyé vers:</label>
                <ul class="tags">
                  @foreach ($message as $msg)
                  <li><a href="#"><i class="fas fa-user"></i>&nbsp;&nbsp;{{ $msg->nameReceiver }} <span>{{ $msg->roleReceiver }}</span></a></li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <label for="">Objet</label>
                @if ($msg->fichier)
                <a href="{{ asset($upload.'/messages/services/'.$msg->fichier) }}" target="_blank">
                    <img class="rotation" src="{{ asset('dist/img/fichier.png') }}" width="30px" height="30px" alt="" style="float: right; margin-top: -.5%;">
                </a>
                @endif
                <input class="form-control" value="{{ $msg->objet }}" readonly>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-12">
                <label for="">Message</label>
                <textarea id="compose-textarea" class="form-control" rows="6" readonly>
                  {{ $msg->message }}
                </textarea>
              </div>
            </div>
            <br><br>
            <div class="float-right">
              <a href="{{ url('message') }}" class="btn btn-danger float-right">Retour</a>
              {{-- <a href="{{ url('reply-message/'.$msg->user_sender->id.'/'.$msg->user_sender->name.'/'.$msg->user_sender->role) }}" class="btn btn-primary btn-block mb-3">Répondre</a>--}}
            </div> 
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      @endif
      @endforeach
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <script>
      $(function () {
        $('#compose-textarea').summernote()
      })
    </script>
@endsection