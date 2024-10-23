@extends('adminlayoutenseignant.layout')
@section('title', 'Liste des étudiants du club')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('clubStudents') }}">Liste des clubs</a></li>
            <li class="breadcrumb-item active">Liste des étudiants du club</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

<style>
.cardStudent{
    border: 1px solid rgb(203, 203, 203);
    padding: 5px 1px;
    background: #ececec;
    display: flex;
    border-radius: 12px;
    justify-content: space-around;
    align-items: center;
    width: 90%;
    margin-bottom: 1.5%;
}
.containerStudent {
    display: grid; 
    grid-template-columns: 0.6fr 1.4fr; 
    grid-template-rows: 1fr 1fr; 
    gap: 0px 0px; 
    grid-template-areas: 
        "icon text"
        "icon sub-text"; 
}
.icon { grid-area: icon; }
.text { 
    grid-area: text;
    padding: 15px 0px 0px 5px;
    text-align: left; 
}
.sub-text { 
    grid-area: sub-text;
    text-align: left;
    padding-left: 8px; 
}
hr {
    margin: 5px 0px;
}
</style>
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
                    <div class="row">

                        <div class="col-md-6" style="border-right: 1px solid #ccc">
                            <div class="text-center">
                                <h4>Club</h4><br>
                                <img src={{ asset($upload.'/clubs/'.$element->logo) }} style="width:350px !important; height: 260px;" class="profile-user-img img-fluid imgPhoto" >
                            </div>
                            <center>
                                <span>{{ $element->nom_fr }} / {{ $element->nom_ar }}</span>
                            </center>
                            <hr>
                            <b>Chef du club : </b><span>{{ $element->chef }}</span><br>
                            <b>Membre 1 : </b><span>{{ $element->membre_1 }}</span><br>
                            <b>Membre 2 : </b><span>{{ $element->membre_2 }}</span><br>
                            <b>Membre 3 : </b><span>{{ $element->membre_3 }}</span><br>
                            <b>Membre 4 : </b><span>{{ $element->membre_4 }}</span><br>
                            <b>Membre 5 : </b><span>{{ $element->membre_5 }}</span><br>
                            <hr>
                            <span for="">Etat du club </span> <b>{{ $element->statut }}</b>
                            <hr>
                            <label for="">Description</label>
                        <textarea name="description" readonly cols="30" rows="3" class="form-control" value="{{ $element->description }}">{{ $element->description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <h4>Etudiants affectés au Club</h4><br>

                                @foreach($students as $student)
                                <center>
                                    <div class="cardStudent">
                                        <div class="containerStudent">
                                            <div class="icon">
                                                <img src={{ asset($upload.'/students/'.$student->photoStudent) }} style="width:110px !important;" class="profile-user-img img-fluid img-circle imgPhoto">
                                            </div>
                                            <div class="text">
                                                <span>{{ $student->prenomStudent.' '.$student->nomStudent }}</span>
                                            </div>
                                            <div class="sub-text">
                                                <b>{{ $student->nomClasse }}</b>
                                            </div>
                                        </div>
                                        <div class="dateAffect">
                                            <span>{{ date('Y-m-d | H:i', strtotime($student->dateAffectation)) }}</span>
                                        </div>
                                        <div class="btnSupp">
                                            <form action="{{ url('delete-affectStudentClub/'.$student->idClubStudent.'/'.$student->idDemande) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                                <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" style="color:white;" aria-hidden="true"></i></button>
                                            </form>
<hr>
                                            <form action="{{ url('update-club-activer/'.$student->idDemande) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                                                @csrf
                                                @method('PUT') 
                                                <input type="text" style="display: none;" name="activer" value="{{ $student->etatActive }}">
            
                                                @if (($student->etatActive == '0'))
                                                <button type="submit" class="btn btn-link btn-warning btn-just-icon edit btn-sm" style="color: white">Inactive</button>
                                                @endif
                                                @if (($student->etatActive == '1'))
                                                <button type="submit" class="btn btn-link btn-info btn-just-icon edit btn-sm" style="color: white">Active</button>
                                                @endif                                
                                            </form>
                                        </div>
                                    </div>
                                </center>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection