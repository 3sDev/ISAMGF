@extends('includes.layout')
@section('title', 'My title')

@section('navbarBrand')          
  <a class="navbar-brand" href="{{ url('dashboard') }}">Dashboard</a>
  <a class="navbar-brand active" href="#" >My Title</a>
@endsection

@section('content')

    <div class="py-4">
        <div class="container">
            <div class="row">

                @if (session('message'))
                    <h5>{{ session('message') }}</h5>
                @endif

                <div class="col-md-12">
                  <div class="titleList">
                    <h4><i class="material-icons">brightness_auto</i>My Title
                        <a href="#" class="btn btn-primary float-right">Button</a>
                    </h4><br><br> 
                    <div class="container">
     
                        <br><br> 

                </div>
                  </div>
                      
                </div>
            </div>
        </div>
    </div>
@endsection