@extends('adminlayoutenseignant.layout')
@section('title', 'Détails Admin')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails Admin</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('admins') }}">Liste des administrateurs</a></li>
          <li class="breadcrumb-item active">Détails Admin</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}

    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>
                        <a href="{{ url('admins') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">

                    @foreach ($admins as $adminElement)

                        <form action="{{ url('update-admins/'.$adminElement->id) }}" enctype="multipart/form-data">

                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                              <!-- Box Comment -->
                              <div class="card card-widget">
                                <div class="card-header">
                                    <span class="username">Date création de compte</span>
                                    <span class="float-right text-muted">{{ date('Y-m-d H:i', strtotime($adminElement->created_at)) }}</span>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">   
                                  <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Nom et prénom</label>
                                        <h6>{{ $adminElement->name }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Rôle</label>
                                        <h6>{{ $adminElement->role }}</h6>
                                    </div>
                                </div><br><br>
                                <div class="row">
                                  <div class="col-md-6">
                                      <label for="">Email</label>
                                      <h6>{{ $adminElement->email }}</h6>
                                  </div>
                                  <div class="col-md-6">
                                      <label for="">Statut compte</label>
                                      @if (($adminElement->lockout_time=='0'))
                                      <td><h6>Désactivé</h6></td>
                                      @endif
                                      @if (($adminElement->lockout_time=='1'))
                                      <td><h6>Activé</span></h6>
                                      @endif
                                  </div>
                                </div>
                              
                                </div>
                              </div>
                              <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-2"></div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                                
                                <br><br>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success float-right">Modifier</button>
                            </div>
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    
@endsection