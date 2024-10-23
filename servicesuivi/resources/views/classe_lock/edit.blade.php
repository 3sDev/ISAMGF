@extends('adminlayoutenseignant.layout')
@section('title', 'Détails enseignant')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Gestion Enseignant</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('teachers') }}">Gestion des enseignants</a></li>
            <li class="breadcrumb-item active">Détails Enseignant</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="row">
    <div class="col-md-12">

        @if ($errors->any())
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        @endif

        @foreach ($profiles as $profile)

        @if ($profile->profile_teacher == [])

        <div class="card">
            <div class="card-header">
                <h4>Ajouter le profile d'étudiant <span class="profileTeacher">{{ $profile->prenom.' '.$profile->nom }}</span>
                    <a href="{{ url('teachers') }}" class="btn btn-danger float-right">Retour</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('teachers/'.$profile->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">CIN</label>
                            <input type="text" name="cin" value="{{ $profile->cin }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nom</label>
                            <input type="text" name="nom" value="{{ $profile->nom }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Prénom</label>
                            <input type="text" name="prenom" value="{{ $profile->prenom }}" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-4">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ $profile->email }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nom (Arabe)</label>
                            <input type="text" name="nom_ar" value="{{ $profile->nom_ar }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Prénom (Arabe)</label>
                            <input type="text" name="prenom_ar" value="{{ $profile->prenom_ar }}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 3%">
                        <label for="">Ajouter Profil</label>
                        <a href="{{ url('teachers/'.$profile->id.'/profile') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-address-book" aria-hidden="true"></i></a>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-right">Update</button>
                    </div>

                </form>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-header">
                <h4>Modifier le profile d'enseignant <span class="profileTeacher">{{ $profile->prenom.' '.$profile->nom }}</span>
                    <a href="{{ url('teachers') }}" class="btn btn-danger float-right">Retour</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('teachers/'.$profile->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">CIN</label>
                            <input type="text" name="cin" value="{{ $profile->cin }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nom</label>
                            <input type="text" name="nom" value="{{ $profile->nom }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Prénom</label>
                            <input type="text" name="prenom" value="{{ $profile->prenom }}" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-4">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ $profile->email }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nom (Arabe)</label>
                            <input type="text" name="nom_ar" value="{{ $profile->nom_ar }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Prénom (Arabe)</label>
                            <input type="text" name="prenom_ar" value="{{ $profile->prenom_ar }}" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-6">
                            <label for="">Date de naissance</label>
                            <input type="date" name="ddn" value="{{ $profile->profile_teacher->ddn }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Genre</label><br>
                            <select name="genre" class="form-control" data-size="3" data-style="btn btn-primary btn-round">
                                
                                @if($profile->profile_teacher->genre =='Homme')         
                                    <option value="{{ $profile->profile_teacher->genre }}" selected>{{ $profile->profile_teacher->genre }}</option>
                                    <option value="Femme">Femme</option>
                                @else
                                    <option value="{{ $profile->profile_teacher->genre }}" selected>{{ $profile->profile_teacher->genre }}</option>
                                    <option value="Homme">Homme</option>        
                                @endif
                                
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ $profile->email }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Téléphone</label>
                            <input type="text" name="phone" value="{{ $profile->profile_teacher->phone }}" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-4">
                            <label for="">Gouvernaurat</label>
                            <input type="text" name="gov" value="{{ $profile->profile_teacher->gov }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Rue</label>
                            <input type="text" name="rue" value="{{ $profile->profile_teacher->rue }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Code postal</label>
                            <input type="text" name="codepostal" value="{{ $profile->profile_teacher->codepostal }}" class="form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{ $profile->email }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="">Mot de passe</label>
                            <input type="text" name="password" value="{{ $profile->password }}" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <br><br>
                        <div class="col-md-6 col-sm-6">
                            <h5 class="title">Photo enseignant</h5>
                                <img src="/upload/enseignants/{{ $profile->profile_teacher->profile_image }}" alt="...">
                                <input type="file" class="form-control" name="profile_image" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Modifier</button>
                    </div>

                </form>
            </div>
        </div>
        @endif
        @endforeach



    </div>
</div>
@endsection