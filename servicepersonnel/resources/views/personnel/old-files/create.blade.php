@extends('adminlayoutenseignant.layout')
@section('title', 'Ajouter enseignant')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Ajouter enseignant</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('teachers') }}">Liste des enseignants</a></li>
                <li class="breadcrumb-item active">Ajouter enseignant</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<link rel="stylesheet" href="{{ URL::asset('css/ajaxSelect.css') }}" />

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
                    <h5>Nouveau enseignant
                        <a href="{{ url('teachers') }}" class="btn btn-danger float-right">Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('teachers') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Cin</label>
                                <input type="text" name="cin" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Nom</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Prénom</label>
                                <input type="text" name="prenom" class="form-control" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Nom complet (nom et prénom)</label>
                                <input type="text" name="full_name" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Nom (Arabe)</label>
                                <input type="text" name="nom_ar" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Prénom (Arabe)</label>
                                <input type="text" name="prenom_ar" class="form-control" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Mot de passe</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                        </div>
                        <br><br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-right">ajouter</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    
</script>

    <script>
        // when section dropdown changes
        $('#levels').change(function() {

            var levelID = $(this).val();

            if (levelID) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getClasse') }}?level_id=" + levelID,
                    success: function(res) {

                        if (res) {

                            $("#classe").empty();
                            $("#classe").append('<option selected disabled>Selectionner La classe</option>');
                            $.each(res, function(key, value) {
                                $("#classe").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {

                            $("#classe").empty();
                        }
                    }
                });
            } else {

                $("#classe").empty();
            }
        });

    </script>
@endsection