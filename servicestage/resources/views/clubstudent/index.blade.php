
@extends('adminlayoutenseignant.layout')
@section('title', 'Liste des clubs')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
 <div class="container-fluid">
   <div class="row mb-2">
     <div class="col-sm-6">
       <h1 class="m-0">Liste des clubs</h1>
     </div><!-- /.col -->
     <div class="col-sm-6">
       <ol class="breadcrumb float-sm-right">
         <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
         <li class="breadcrumb-item active">Liste des clubs</li>
       </ol>
     </div><!-- /.col -->
   </div><!-- /.row -->
 </div><!-- /.container-fluid -->
</div>

@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
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
                   <a href="{{ url('clubStudents/create') }}" class="btn btn-primary float-right">Ajouter</a>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                   <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th width="6%">Logo</th>
                               <th>Nom AR</th>
                               <th>Nom FR</th>
                               <th>Description</th>
                               <th>Statut</th>
                               <th width="18%">Membres</th>
                               <th width="13%">Date</th>
                               <th width="9%"></th>
                               <th width="5%"></th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($clubStudents as $element)
                           
                           <tr>
                           <td>
                               <div class="filter-container p-0 row">
                                   <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                       <a href={{ asset($upload.'/clubs/'.$element->logo) }} target="_blank" data-toggle="lightbox" data-title="sample 4 - red">
                                       <img style="border-radius:10px;" src={{ asset($upload.'/clubs/'.$element->logo) }} width="60px" height="60px" alt="club"/>
                                       </a>
                                   </div>
                               </div>  
                           </td>
                           <td><span>{{ $element->nom_ar }}</span></td>
                           <td><span>{{ $element->nom_fr }}</span></td>
                           <td><span>{{ $element->description }}</span></td>
                           <td><span>{{ $element->statut }}</span></td>
                           <td>
                               <ul>
                                   <li><b>{{ $element->chef }}</b></li>
                                   <li><span>{{ $element->membre_1 }}</span></li>
                                   <li><span>{{ $element->membre_2 }}</span></li>
                                   <li><span>{{ $element->membre_3 }}</span></li>
                                   <li><span>{{ $element->membre_4 }}</span></li>
                                   <li><span>{{ $element->membre_5 }}</span></li>
                               </ul>
                           </td>
                           <td>{{ date('Y-m-d | H:i', strtotime($element->created_at)) }}</td>
                           
                           <td class="text-center">
                               <a href="{{ url('list-clubStudent/'.$element->id) }}" target="_blank" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                               <a href="{{ url('edit-clubStudent/'.$element->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                           </td>
                           <td class="text-center">
                               <form action="{{ url('delete-clubStudent/'.$element->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                   <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                               </form>
                           </td>
                           </tr>

                           @endforeach
                       </tbody>
                       <tfoot>
                           <tr>
                               <th>Logo</th>
                               <th>Nom AR</th>
                               <th>Nom FR</th>
                               <th>Description</th>
                               <th>Statut</th>
                               <th>Membres</th>
                               <th>Date</th>
                               <th></th>
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