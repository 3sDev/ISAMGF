@extends('adminlayoutenseignant.layout')
@section('title', 'Gestion des soldes')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h2 class="m-0">Gestion des soldes</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('soldes') }}">Gestion des soldes</a></li>
            <li class="breadcrumb-item active">Ajouter solde personnel</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.inputStyle {
    background: none !important;
    border: none !important;
}
.textable {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1; /* number of lines to show */
    -webkit-box-orient: vertical;
}
.textPointage{
    font-size: 16px;
    font-weight: bold;
    color:olive;
}
h6{
    border-radius: 10px;
    background-color: rgb(252, 243, 231);
    padding: 30px 50px;
}
.totalValues{
    color: orangered;
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            
            <div class="card">
                @foreach ($personnel as $element)
                <div class="card-header">
                    <a href="{{ url('soldes') }}" class="btn btn-primary float-right">Retour</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <center>
                        <h6><b>Personnel : <span style="color: rgb(137, 137, 137)">{{ $element->nom.' '.$element->prenom }}</span></b>  
                        <b style="margin-left: 12%;">Poste:  <span style="color: rgb(137, 137, 137)">{{ $element->poste}}</span> </b>
                        </h6>
                    </center>
                    <form action="{{ url('save-solde-personnel') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de sauvegarder ces données?')">
                    @csrf
                    <br>
                        <center><button type="submit" class="btn btn-danger" onclick="return IsEmpty();"><b>Ajouter solde</b></button></center>
                        <br>  
                        <center>
                        <table BORDERCOLOR="#ccc" style="width:95%; padding-right:5px; table-layout:fixed;" class="table table-bordered table-striped text-right">
                            <thead>
                                <tr style="background-color: rgb(27, 57, 102); color:white;">
                                    <th>عطلة مرض</th>
                                    <th>عطلة تعويضية</th>
                                    <th>عطلة استثنائية</th>
                                    <th>عطلة سنوية</th>
                                    <th>السنة</th>
                                    <th width="23%">العون الإداري</th>

                                </tr>
                            </thead>
                            <tbody>
                            
                                
                            <tr>
                                <td><input type="text" name="conge_maladie" class="form-control"  style="width: 100% !important;"></td>                            
                                <td><input type="text" name="conge_compensatoire" class="form-control"  style="width: 100% !important;"></td>                            
                                <td><input type="text" name="conge_exceptionnel" class="form-control"  style="width: 100% !important;"></td>                            
                                <td><input type="text" name="conge_annual" class="form-control"  style="width: 100% !important;"></td>                            
                                <td>
                                    <select name="annee" id="annee" data-style="btn btn-primary" required class="form-control" style="width: 100% !important;">
                                        <option value="" selected disabled>Choisissez</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->annee }}"> {{ $year->annee }}</option>
                                        @endforeach
                                    </select>
                                </td>  
                                <td><input type="text" name="nomPersonnel" value="{{ $element->nom.' '.$element->prenom }}" class="form-control inputStyle" readonly style="width: 100% !important; float: right;"></td>                            
                            </tr>
                            
                            </tbody>
                        </table>
                        <input type="hidden" name="personnel_id"  value="{{ $element->id }}" >
                    </center>
                    </form>
                @endforeach
                <br><hr><br>
                <h4>Liste des soldes :</h4>
                <table id="example1" class="table table-bordered table-striped text-right">
                    <thead>
                        <tr>
                            <th>فسخ</th>
                            <th>عطلة مرض <span  class="totalValues">({{$allSoldeMaladie}})</span></th>
                            <th>عطلة تعويضية<span  class="totalValues">({{$allSoldeCompensatoire}})</span></th>
                            <th>عطلة استثنائية <span  class="totalValues">({{$allSoldeExceptionnel}})</span></th>
                            <th>عطلة سنوية <span class="totalValues">({{$allSoldeAnnual}})</span></th>
                            <th>السنة</th>
                            <th>العون الإداري</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($soldes as $element)
                        
                    <tr>
                        <td align="center">
                            <form action="{{ url('delete-elementSolde/'.$element->id.'/'.$element->personnel->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ces données?')">
                                {{-- <input type="hidden" name="element_date" value="{{ $Dateelement }}"> --}}
                                <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </form>
                        </td>
                        <td><span>{{ $element->conge_maladie }} </span></td> 
                        <td><span>{{ $element->conge_compensatoire }} </span></td> 
                        <td><span>{{ $element->conge_exceptionnel }} </span></td> 
                        <td><span>{{ $element->conge_annual }} </span></td> 
                        <td><span>{{ $element->annee  }}  </span></td> 
                        <td><span>{{ $element->personnel->nom.' '.$element->personnel->prenom }}</span></td>  
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection