@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier compte admin')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier compte admin</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admins') }}">Liste des administrateurs</a></li>
                <li class="breadcrumb-item active">Modifier compte admin</li>
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
                        <div class="col-md-6">
                            <label for="">Nom et prénom</label>
                            <input type="text" name="name" value="{{ $adminElement->name }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Rôle</label>
                            <select name="role" data-style="btn btn-primary btn-round" class="form-control" required>
                                <option value="{{ $adminElement->role }}">{{ $adminElement->role }}</option>
                                <option value="Service scolarité">Service scolarité</option>
                                <option value="Service enseignants">Service enseignants</option>
                                <option value="Service Personnels">Service Personnels</option>
                                <option value="Service stages">Service stages</option>
                                <option value="Service examens">Service examens</option>
                                <option value="Chef de département">Chef de département</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ $adminElement->email }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Mot de passe</label>
                            <input type="password" id="myInput" name="password" value="{{ $adminElement->password }}" class="form-control" required>
                            <br>
                            <input type="checkbox" onclick="myFunction()">Afficher mot de passe
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Photo de profil</label>
                            <input type="file" name="profile_photo_path" value="{{ $adminElement->profile_photo_path }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Statut de compte</label>
                            <select name="lockout_time" data-style="btn btn-primary btn-round" class="form-control" required>

                                @if (($adminElement->lockout_time=='0'))
                                <option value="0">Désactivé</option>
                                @endif
                                @if (($adminElement->lockout_time=='1'))
                                <option value="1">Activé</option>
                                @endif

                            </select>
                        </div>
                    </div>
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
    <script>
        function myFunction() {
          var x = document.getElementById("myInput");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>
@endsection