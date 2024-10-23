@extends('adminlayoutenseignant.layout')
@section('title', 'Affecter matière')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Affecter matière avec Groupe</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('all-classes') }}">Liste des classes</a></li>
                <li class="breadcrumb-item active">Affecter matière</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<link rel="stylesheet" href="{{ URL::asset('css/ajaxSelect.css') }}" />

<style>
.flat-table {
  display: block;
  font-family: sans-serif;
  -webkit-font-smoothing: antialiased;
  font-size: 13px;
  overflow: auto;
  width: auto;
}
.flat-table th {
  background-color: #293f5c;
  color: white;
  font-weight: normal;
  text-align: left;
}
.flat-table td {
  background-color: #eeeeee;
  color: #6f6f6f;
  padding: 5px 10px;
}

.labelleMat {
    color:#6f6f6f;
    font-size: 10px;
}

.titreArticle {
    color:#be2323;
    font-size: 17px;
    font-weight: 900 !important;
}

.quantiteMat {
    color:#bb6718;
    font-size: 14px;
}

.semestreMat{
    color:#3a8f23;
    font-size: 14px;
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
                    @foreach ($classes as $classe)

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-4"></div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="card card-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-info"><br>
                                        <h3 class="widget-user-username">{{ $classe->classeName}}</h3>
                                        <h5 class="widget-user-desc">{{ $classe->abbreviation }}</h5>
                                    </div>
                                    </div>
                                    <!-- /.widget-user -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4"></div>
                            </div>
                            <br><hr><br>
                            <div class="row">
                                <div class="col-md-5">
                                <form action="{{ url('matiereregistreByClasse') }}" method="POST">
                                    @csrf
                                    <h5>Affecter des matières :</h5>
                                    <table class="table table-bordered table-responsive flat-table">
                                        <thead>
                                            <tr>
                                                <th style="display:none;">ID_teacher</th>
                                                <th width="65%">Matière</th>
                                                <th width="10%"><a href="javascript:void(0)" class="btn btn-success addRow">+</a></th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="display:none;"><input type="text" name="idClasse[]" value="{{ $classe->id }}" class="form-control"></td>
                                                    <td>
                                                        <input list="ID_Matiere" name="ID_Matiere[]" class="form-control" required>
                                                        <datalist class="SmallFormField" name="ID_Matiere[]" id="ID_Matiere" onChange="submitForm(this.form, true)" onkeypress="gblKeyPress()" onkeydown="gblKeyDown()" onfocus="gblOnFocus('ID_Matiere')" onblur="gblOnBlur()" onClick="gblOnClick('QuoteMgrSearchCriteria', this.form)">
    
                                                            @foreach ($matieres as $matiere)
                                                                <option value="{{ $matiere->id}}">{{ $matiere->subjectLabel }}-{{ $matiere->description }}/{{ $matiere->semestre }}</option>
                                                            @endforeach
    
                                                        </datalist>
    
                                                    </td>                                                
                                                    <td><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></td>
                                                </tr>
                                            </tbody>
    
                                    </table>
    
                                <input type="submit" class="btn btn-primary" value="Ajouter">
                              </form>
                            </div>
    
                            <div class="col-md-7">
    
                                <h5>Liste des matières liés avec Groupe : <span class="titreArticle">{{ $classe->abbreviation }}</span> </h5>
                                
                                @foreach ($matieresClasse as $matClass)
                                        @foreach ($matClass->matieres as $matea)
                                            <ol class="list-group list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    {{-- <div class="fw-bold">{{ $matea->volume }} <span class="labelleMat">Volume Matière</div> --}}
                                                    <b>{{ $matea->id }} - </b>    {{ $matea->subjectLabel }} /  <span class="quantiteMat">{{ $matea->description }}&nbsp;/  <span class="semestreMat">{{ $matea->semestre }}</span>
                                                </div>
                                                <span>
                                                    <form action="{{ url('deletematiereByClasse/'.$matea->pivot->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="width:1px;background:none; border:none"><i class="fa fa-times-circle"></i></button>
                                                    </form>
                                                </span>
                                                </li>
                                            </ol>
                                        @endforeach
                                    @endforeach
    
                              <br> 
    
                            </div>
    
                            </div>
                          </div>
                        </div>
                        <br><br>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        $('thead').on('click', '.addRow', function(){
            var tr ="<tr>" +
                    "<td style='display:none;'><input type='text' name='idClasse[]' value='{{ $classe->id }}' class='form-control'></td>"+
                    "<td>"+
                    "<input list='ID_Matiere' name='ID_Matiere[]' class='form-control' required>";
                    "<datalist class='SmallFormField' name='ID_Matiere[]' id='ID_Matiere' onChange='submitForm(this.form, true)' onkeypress='gblKeyPress()' onkeydown='gblKeyDown()' onfocus='gblOnFocus(`ID_Matiere`)' onblur='gblOnBlur()' onClick='gblOnClick(`QuoteMgrSearchCriteria`, this.form)'>";
                tr += "<option value='{{ $matiere->id }}'>{{ $matiere->subjectLabel }}-{{ $matiere->description }}</option>";
                tr += "</datalist>"+
                    "</td>"+
                    "<td><a href='javascript:void(0)' class='btn btn-danger deleteRow'>-</a></td>"+
                    "</tr>";
    
        $('tbody').append(tr);
    
        });
    
        $('tbody').on('click', '.deleteRow', function(){
            $(this).parent().parent().remove();
        });
    </script>

@endsection