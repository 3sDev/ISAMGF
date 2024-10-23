
@extends('adminlayoutenseignant.layout')
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
     <div class="col-md-12">
       <div class="card card-primary card-outline">
         <div class="card-header">
           <h3 class="card-title">Détails Message</h3>
           <span class="float-right">{{ date('Y-m-d | H:s', strtotime($msg->created_at)) }}</span>
         </div>
         <!-- /.card-header -->
         <div class="card-body">

           <div class="row">
             <div class="col-lg-4">
                 <label for="">Admin</label>
                 <input class="form-control" value="{{ $msg->nameSender .'('.$msg->roleSender.')' }}" readonly>
             </div>
             <div class="col-lg-8">
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
             <a href="{{ url('reply-message/'.$msg->user_sender_id.'/'.$msg->nameSender.'/'.$msg->roleSender.'/'.$msg->objet) }}" class="btn btn-primary btn-block mb-3">Répondre</a>
           </div>
         </div>
         <!-- /.card-body -->
       </div>
       <!-- /.card -->
     </div>
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