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
                  <form action="{{ url('update-admins/'.$adminElement->id) }}" onsubmit="return confirm('Êtes-vous sûr de modifier cet element?')" enctype="multipart/form-data">
                    
                  @csrf
                  {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Nom et prénom</label>
                            <input type="text" name="name" value="{{ $adminElement->name }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Rôle</label>
                            <select name="role" data-style="btn btn-primary btn-round" class="form-control" required>
                                <option value="{{ $adminElement->role }}">{{ $adminElement->role }}</option>
                                <option value="" disabled>------------------------------</option>
                                <option value="Service scolarité">Service scolarité</option>
                                <option value="Service enseignants">Service enseignants</option>
                                <option value="Service Personnels">Service Personnels</option>
                                <option value="Service stages">Service stages</option>
                                <option value="Service examens">Service examens</option>
                                <option value="Chef de département">Chef de département</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Statut de compte</label>
                            <select name="lockout_time" data-style="btn btn-primary btn-round" class="form-control" required>

                                @if (($adminElement->lockout_time=='0'))
                                <option value="0">Désactivé</option>
                                <option value="1">Activé</option>

                                @endif
                                @if (($adminElement->lockout_time=='1'))
                                <option value="1">Activé</option>
                                <option value="0">Désactivé</option>
                                @endif

                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">

                        <div class="col-md-6">
                            <label for="">Département</label>
                            <select id="departement_id" name="departement_id" class="form-control">
                                <option value="{{ $adminElement->departement->id }}" selected>{{ $adminElement->departement->departmentLabel }}</option>
                                <option value="" disabled>-------------------------------------</option>
                                @foreach ($departements as $dep)
                                <option value="{{ $dep->id }}">{{ $dep->departmentLabel }}</option>
                                @endforeach
                            </select>                        
                        </div>
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ $adminElement->email }}" class="form-control" required>
                        </div>
                    </div>
                    <br><br>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success float-right">Modifier</button>
                    </div>
                    </form>

                    <br><hr><br>
                    <center>
                        <h5 class="TitleOne">Changer le mot de passe (App Etudiant)
                    </center>
                    <br><br>
                    <form action="{{ url('update-passwordAdmin/'.$adminElement->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier le mot de passe ?')">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <input type="hidden" id="current_password" name="current_password" value="{{ $adminElement->password }}" class="form-control" required>
                                <label>Nouveau mot de passe</label>
                                <input type="text" id="new_password" name="new_password" value="" class="form-control" required><br>
                                <label>Confirmer le nouveau mot de passe</label>
                                <input type="text" id="confirm_password" name="confirm_password" value="" class="form-control" required><br>
                                <center><button type="submit" class="btn btn-warning">Modifier</button></center>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
{{-- <div class="col-md-6">
    <label for="">Mot de passe</label>
    <input type="password" id="myInput" name="password" value="{{ $adminElement->password }}" class="form-control" required>
    <br>
    <input type="checkbox" onclick="myFunction()">Afficher mot de passe
</div> --}}
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
<script>
    $(document).ready(function() {
        var degrees = 0;
    
    });
</script>
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
<script>
    $('#new_password, #confirm_password').on('keyup', function () {
    if ($('#new_password').val() == $('#confirm_password').val()) {
        $('#message').html('Valid').css('color', 'green');
    } else 
        $('#message').html('Not Valid').css('color', 'red');
    });
</script>
@endsection