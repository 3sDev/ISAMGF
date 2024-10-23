
@extends('adminlayoutenseignant.layout')
@section('title', 'Liste des clubs')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
 <div class="container-fluid">
   <div class="row mb-2">
     <div class="col-sm-6">
       <h1 class="m-0">Liste des demandes clubs</h1>
     </div><!-- /.col -->
     <div class="col-sm-6">
       <ol class="breadcrumb float-sm-right">
         <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
         <li class="breadcrumb-item active">Liste des demandes clubs</li>
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
            {{-- <div class="card-header">
                <h3 class="card-title"></h3>
                <a href="{{ url('events/create') }}" class="btn btn-primary float-right">Ajouter</a>
            </div> --}}
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Etudiant</th>
                            <th>Groupe</th>
                            <th>Nom Club</th>
                            <th>Date d’adhésion</th>
                            <th width="10%">Acceptation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ActivitesClub as $clubElement)
                        
                        <tr>
                        <td>{{ $clubElement->student->full_name }}</td>
                        <td><span>{{ $clubElement->classe->abbreviation }}</span></td>
                        <td><span>{{ $clubElement->type_club }}</span></td>
                        <td><span>{{ date('Y-m-d | H:i', strtotime($clubElement->updated_at)) }}</span></td>
                        <td align="center">
                            <form action="{{ url('update-club-accepter/'.$clubElement->id) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                                @csrf
                                @method('PUT') 
                                <input type="hidden" name="accepter" value="{{ $clubElement->accepter }}">
                                <input type="hidden" name="student_id" value="{{ $clubElement->student_id }}">
                                <input type="hidden" name="classe_id" value="{{ $clubElement->classe_id }}">
                                <input type="hidden" name="club_id" value="{{ $clubElement->club_id }}">
                                <input type="hidden" name="demande_id" value="{{ $clubElement->id }}">
                                <input type="hidden" name="club" value="{{ $clubElement->type_club }}">

                                @if (($clubElement->accepter == '0'))
                                <button type="submit" class="btn btn-link btn-danger btn-just-icon edit btn-sm" style="color: white">Non accepté</button>
                                @endif
                                @if (($clubElement->accepter == '1'))
                                <button type="submit" class="btn btn-link btn-success btn-just-icon edit btn-sm" style="color: white">Accepté</button>
                                @endif                                
                            </form>
                        </td>
                        </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Etudiant</th>
                            <th>Groupe</th>
                            <th>Nom Club</th>
                            <th>Date d’adhésion</th>
                            <th width="10%">Acceptation</th>
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