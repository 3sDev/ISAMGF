
@extends('adminlayoutenseignant.layoutdatatable')
@section('title', 'Liste personnels')
@section('contentPage')

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
 .btn-link{
   color:white;
 }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
 <div class="container-fluid">
   <div class="row mb-2">
     <div class="col-sm-6">
       <h1 class="m-0">Gestion des personnels</h1>
     </div><!-- /.col -->
     <div class="col-sm-6">
       <ol class="breadcrumb float-sm-right">
         <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
         <li class="breadcrumb-item active">Gestion des personnels</li>
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
                     <a href="{{ url('personnels/create') }}" class="btn btn-primary float-right">Ajouter</a>
                 </div>
                 <!-- /.card-header -->
                 <div class="card-body">
                     <table id="example1" class="table table-bordered table-striped">
                         <thead>
                             <tr>
                               <th>Matricule</th>
                               <th>Nom et Prénom</th>
                               <th>Spécialité</th>
                               <th>Tél</th>
                               <th>Activation</th>
                               {{-- <th width="12%">Actions</th>
                               <th>Supp</th> --}}
                             </tr>
                         </thead>
                         <tbody>
                           @foreach ($personnels as $personnel)
                             
                           <tr>
                             {{-- <td><img src="/upload/teachers/{{ $item->profile_image }}" alt="" class="image-table"> </td> --}}
                             <td>{{ $personnel->matricule }}</td>
                             <td>{{ $personnel->prenom .' '. $personnel->nom }}</td>
                             <td>{{ $personnel->poste }}</td>
                             <td>{{ $personnel->tel1_personnel }}</td>
                             
                             <td  align="center">
                               @if (($personnel->active == 'Désactivé'))
                               <button type="submit" class="btn btn-link btn-warning btn-just-icon edit btn-sm">Désactivé</button>
                               @endif
                               @if (($personnel->active == 'Activé'))
                               <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm">Activé</button>
                               @endif
                               @if (($personnel->active == 'Mutation'))
                               <button type="submit" class="btn btn-link btn-info btn-just-icon edit btn-sm">Mutation</button>
                               @endif
                               @if (($personnel->active == 'Retraite'))
                               <button type="submit" class="btn btn-link btn-secondary btn-just-icon edit btn-sm">Retraite</button>
                               @endif
                             </td>
                             
                           {{--   <td class="text-center">
                               <a href="{{ url('personnels/'.$personnel->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                               <a href="{{ url('personnels/'.$personnel->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                             </td>
                             <td align="center">
                               <form action="{{ url('delete-personnel/'.$personnel->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ces données?')">
                                 <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                               </form>
                             </td> --}}
                           </tr>
                           @endforeach
                         </tbody>
                         <tfoot>
                             <tr>
                               <th>Matricule</th>
                               <th>Nom et Prénom</th>
                               <th>Spécialité</th>
                               <th>Tél</th>
                               <th>Activation</th>
                               {{-- <th width="10%">Actions</th>
                               <th>Supp</th> --}}
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
 </div>
 <!-- /.container-fluid -->
</section>

@endsection