@extends('adminlayoutenseignant.layout')
@section('title', 'Ajouter une classe')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Ajouter une classe</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('all-classes') }}">Liste des classes</a></li>
                <li class="breadcrumb-item active">Ajouter une classe</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<link rel="stylesheet" href="{{ URL::asset('css/ajaxSelect.css') }}" />
<style>
    .hrInscrit {
        border: 1px solid rgb(108, 108, 108);
        width: 100%
    }
    .labelright {
        display: inline-block;
        text-align: right;
        float: right !important;
    }
    .sousTitre{
        text-align: center;
        background-color: rgb(90, 90, 90);
        color: aliceblue;
        top: -19%;
        padding: 20px 40px;
        font-size: 17px;
        font-weight: 700;
        position: relative;
    }
</style>    
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
                    <h5>
                        <a href="{{ url('all-classes') }}" class="btn btn-danger float-right">Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('classes') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ajouter cette classe?')">

                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nom du classe</label>
                                <input type="text" class="form-control" name="abbreviation" placeholder="Exemple : 1 Image G1" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Groupe</label>
                                <select name="classeName" class="form-control">
                                    <option value="فوج أول">فوج أول</option>
                                    <option value="فوج ثاني">فوج ثاني</option>
                                    <option value="فوج ثالث">فوج ثالث</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Département classe</label>
                                <select name="departement_class" class="form-control" required>
                                    <option value="">Choisir département</option>
                                    @foreach ($departements as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->departmentLabel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Niveau classe</label>
                                <select name="level_id" class="form-control" required>
                                    <option value="">Choisir Niveau</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Section classe</label>
                                <select name="section_id" class="form-control" required>
                                    <option value="">Choisir Section</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->abbreviation }}</option>
                                    @endforeach
                                </select>                            
                            </div>
                        </div>                        
                        <br><br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        mycin.oninput = function () {
            if (this.value.length > 8) {
                this.value = this.value.slice(0,8); 
            }
        }
    </script>
        <script>
        mynum.oninput = function () {
            if (this.value.length > 8) {
                this.value = this.value.slice(0,8); 
            }
        }
    </script>
    <script>
        codepostal.oninput = function () {
            if (this.value.length > 4) {
                this.value = this.value.slice(0,4); 
            }
        }
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