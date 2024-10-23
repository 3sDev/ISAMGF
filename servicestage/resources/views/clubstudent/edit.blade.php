@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier club')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Modifier club</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('clubStudents') }}">Liste des clubs</a></li>
            <li class="breadcrumb-item active">Modifier club</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
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
                        <a href="{{ url('clubStudents') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                    @foreach ($clubs as $element)
                    <form action="{{ url('update-clubStudent/'.$element->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">

                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Nom Club en français</label>
                            <input type="text" name="nom_fr" value="{{ $element->nom_fr }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Nom Club en arabe</label>
                            <input type="text" name="nom_ar" value="{{ $element->nom_ar }}" class="form-control" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" cols="30" rows="3" class="form-control" value="{{ $element->description }}">{{ $element->description }}</textarea>
                        </div>
                    </div>
                    <br><hr><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Chef du club</label>
                            <input type="text" name="chef" value="{{ $element->chef }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Membre 1</label>
                            <input type="text" name="membre_1" value="{{ $element->membre_1 }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Membre 2</label>
                            <input type="text" name="membre_2" value="{{ $element->membre_2 }}" class="form-control">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Membre 3</label>
                            <input type="text" name="membre_3" value="{{ $element->membre_3 }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Membre 4</label>
                            <input type="text" name="membre_4" value="{{ $element->membre_4 }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Membre 5</label>
                            <input type="text" name="membre_5" value="{{ $element->membre_5 }}" class="form-control">
                        </div>
                    </div>
                    <br><hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Etat du club</label>
                            <select name="statut" class="form-control" id="">
                                <option value="{{ $element->statut }}">{{ $element->statut }}</option>
                                <option value="" disabled>----------------------</option>
                                <option value="Activé">Activé</option>
                                <option value="Désactivé">Désactivé</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <br><br>
                    <center>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </center>
                </form>

                <br><hr><br>

                <form action="{{ url('update-logoClubStudent/'.$element->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                    @csrf
                    @method('PUT')
                    <div class="form-input-steps" style="text-align: right;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <img src={{ asset($upload.'/clubs/'.$element->logo) }} style="width:350px !important; height: 260px;" class="profile-user-img img-fluid imgPhoto" >
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">Logo du club</label>
                                <input type="file" value="{{ $element->logo }}" class="form-control" name="logo" required><br>
                                <button type="submit" class="btn btn-warning float-right">Modifier Logo</button>
                            </div>
                        </div>
                    </div>
                </form>

                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection