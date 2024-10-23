@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier lien utile')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Modifier un lien utile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('liens') }}">Liste des liens utiles</a></li>
                <li class="breadcrumb-item active">Modifier un lien utile</li>
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
                        <a href="{{ url('liens') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>

                <div class="card-body">
                    @foreach ($liens as $lienElement)
                    <form action="{{ url('update-liens/'.$lienElement->id) }}" enctype="multipart/form-data">

                    @csrf
                    {{-- @method('PUT') --}}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Titre</label>
                                <input type="text" name="title" value="{{ $lienElement->title }}" class="form-control" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea name="description" cols="30" rows="5" class="form-control">
                                    {{ $lienElement->description }}
                                </textarea>
                            </div>
                        </div>
                        <br><hr><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">URL</label>
                                <input type="text" name="url" value="{{ $lienElement->url }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Type</label>
                                <input type="text" name="type" value="{{ $lienElement->type }}" class="form-control" >
                            </div>
                            <div class="col-md-4">
                                <label for="">Catégorie</label>
                                <select name="categorie" class="form-control" required>
                                    <option value="{{ $lienElement->categorie }}" selected>{{ $lienElement->categorie }}</option>
                                    <option value="" disabled>-----------------------</option>
                                    <option value="student">student</option>
                                    <option value="teacher">teacher</option>
                                    <option value="personnel">personnel</option>
                                    <option value="all">all</option>
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

@endsection