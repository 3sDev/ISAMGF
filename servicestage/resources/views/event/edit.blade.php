@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier événement')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier un événement</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('events') }}">Liste des événements</a></li>
                <li class="breadcrumb-item active">Modifier un événement</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
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
.profileTeacher{
    color: royalblue;
    font-weight: bold;
}
input[type=text] {
    float: left !important;
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
                    <h4>
                        <a href="{{ url('events') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                @foreach ($events as $eventElement)
                <form action="{{ url('update-event/'.$eventElement->id) }}" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')">

                @csrf
                {{-- @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Titre</label>
                            <input type="text" name="titre" value="{{ $eventElement->titre }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" cols="30" rows="5" class="form-control">
                            {{ $eventElement->description }}
                            </textarea>
                        </div>
                    </div>
                    <br><hr><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Date</label>
                            <input type="date" name="date" value="{{ $eventElement->date }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Adresse</label>
                            <input type="text" name="adresse" value="{{ $eventElement->adresse }}" class="form-control">
                        </div>
                    </div>
                    <br><hr><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Views</label>
                            <input type="text" name="views" value="{{ $eventElement->views }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Rating</label>
                            <input type="text" name="rating" value="{{ $eventElement->rating }}" class="form-control" readonly>
                        </div>
                    </div>
                    <br><br>
                    <center>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </center>
                </form>

                <br><hr><br>

                <form action="{{ url('update-photoEvent/'.$eventElement->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                    @csrf
                    @method('PUT')
                    <div class="form-input-steps" style="text-align: right;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <img src={{ asset($upload.'/events/'.$eventElement->image) }} style="width:350px !important; height: 260px;" class="profile-user-img img-fluid imgPhoto" >
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">Photo d'événement</label>
                                <input type="file" value="{{ $eventElement->image }}" class="form-control" name="image" required><br>
                                <button type="submit" class="btn btn-warning float-right">Modifier Photo</button>
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