@extends('includes.layout')
@section('title', 'Ajouter un lien')

@section('navbarBrand')          
  <a class="navbar-brand" href="{{ url('dashboard') }}">Dashboard</a>
  <a class="navbar-brand" href="{{ url('liens') }}">Liste des liens</a>
  <a class="navbar-brand active" href="#" >Ajouter un lien</a>
@endsection

@section('content')

    <div class="py-4">
        <div class="container">
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
                            <h4>Ajouter lien utile
                                <a href="{{ url('liens') }}" class="btn btn-danger float-right">Retour</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('liens') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Titre</label>
                                    <input type="text" name="titleLabel" class="form-control">
                                </div>
                            </div>
                            
                            <div class="row" style="margin-top: 3%">
                                <div class="col-md-12">
                                    <label for="">Description</label>
                                    <textarea name="descriptionLabel" id="" cols="30" rows="6" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 3%">
                                <div class="col-md-6">
                                    <label for="">URL</label>
                                    <input type="text" name="urlLabel" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Type</label>
                                    <input type="text" name="typeLabel" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection