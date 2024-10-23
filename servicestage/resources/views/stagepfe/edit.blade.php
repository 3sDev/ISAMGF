@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier PFE')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Projet fin d'étude</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('pfe') }}">Liste des PFE + Mémoire</a></li>
          <li class="breadcrumb-item active">Modifier projet</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.titreDemande{
    background-color: rgb(235, 235, 235);
    padding: 10px 6px;
    border-radius: 12px;
    color: orangered;
    text-align: left;
    font-size: 16px;
}
label {
    /* Other styling... */
    text-align: right;
    clear: both;
    float:left;
    margin-right:15px;
}
.downloadImage{
    width: 90px;
    
}
.labelFileDownload{
    margin-left: 25%;
}
.infoCompany{
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    color: white;
}
.bgCompany{
    background-color: rgb(255, 111, 59);
}
.infoPfe{
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    color: white;
}
.bgPfe{
    background-color: rgb(53, 106, 162);
}
.infoPieces{
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    color: white;
}
.bgPieces{
    background-color: rgb(60, 162, 53);
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

        <div class="card" id="printPage">
          @foreach ($demandes as $demand)
            <div class="card-header">
                <h4 class="text-center">{{ $demand->type }}</h4>
                <h5 class="text-center">- {{ $demand->sous_type }} -</h5>
            </div>
            <div class="card-body">
                
                <form action="{{ url('update-pfeDirection/'.$demand->id) }}" method="POST"  onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                @csrf
                @method('PUT')
                <div class="row">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <h5 class="titreDemande">Information Etudiant(e) </h5>
                                </div>
                            </div>
                            <div class="row" style="">
                                <div class="col-md-2" style="margin-top:-2%;">
                                    <div class="text-center">
                                        <img src={{ asset($upload.'/students/'.$demand->student->profile_image) }} style="width:150px !important; height: 160px;" class="profile-user-img img-fluid img-circle imgPhoto">
                                    </div>
                                </div>
                                <div class="col-md-5" style="border-left: 1px solid rgb(255, 255, 255)">
                                    
                                    <div class="profile-head">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>&nbsp;&nbsp;&nbsp;Etudiant(e) </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->student->prenom.' '.$demand->student->nom }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>&nbsp;&nbsp;&nbsp;Classe</label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->classe->abbreviation }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-5">
                                            <label>&nbsp;&nbsp;&nbsp;Filière </label>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $demand->student->filiere }}</p>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>&nbsp;&nbsp;&nbsp;Numéro Tél </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->student->tel1_etudiant }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5" style="border-left: 1px solid rgb(255, 255, 255)">
                                    <div class="profile-head">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>&nbsp;&nbsp;&nbsp;Email </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->student->email }}</p>
                                            </div>
                                        </div>

                                        @if ($demand->classe->category == 'Licence')
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>&nbsp;&nbsp;&nbsp;Binome  </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{{ $demand->binome_pfe }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>&nbsp;&nbsp;&nbsp;Date demande </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ date('Y-m-d', strtotime($demand->created_at)) }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>&nbsp;&nbsp;&nbsp;Type demande </label>
                                            </div>
                                            <div class="col-md-7">
                                                <p>{{ $demand->sous_type }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                {{--<div class="col-md-2" style="margin-top:2%;">
                                    <div class="text-center">
                                        @if ($demand->sous_type == 'اقتراح مشروع تخرج تعليمي')
                                            <a download="pfe_didactique_issat_Gafsa.docx" href="{{ url('upload/pfe_didactique_issat_Gafsa.docx') }}" title="اقتراح مشروع تخرج في شركة" class="downloadTitre">
                                                <center><img alt="اقتراح مشروع تخرج في شركة" src={{ url('upload/logo_word.png') }} class="downloadImage" id="imgLabel">
                                                <label class="labelFileDownload" for="imgLabel">تحميل الإقتراح</label></center>
                                            </a>
                                        @else
                                            <a download="pfe_industriel_issat_Gafsa.docx" href="{{ url('upload/pfe_industriel_issat_Gafsa.docx') }}" title="اقتراح مشروع تخرج تعليمي" class="downloadTitre">
                                                <center><img alt="اقتراح مشروع تخرج تعليمي" src={{ url('upload/logo_word.png') }} class="downloadImage" id="imgLabel">
                                                <label class="labelFileDownload" for="imgLabel">تحميل الإقتراح</label></center>
                                            </a>
                                        @endif
                                    </div> 
                                </div>--}}
                            </div>
                            <hr>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-3">
        <div class="text-center">
            <a href="{{ url('show-demandePFE/'.$demand->id) }}" target="_blank" title="اقتراح مشروع تخرج" class="downloadTitre">
                <center>
                    <img src="{{ asset('/upload/pfe1.png')}}" alt="" style="width:80px !important; height: 80px;" id="imgLabel" alt="اقتراح مشروع تخرج"><br>
                                            
                    @if ($demand->classe->category == 'Licence')
                        <span>Proposition PFE</span>
                    @else
                        <span>Proposition Mémoire</span>
                    @endif
                </center>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="text-center">
            <a href="{{ url('show-affectationPFE/'.$demand->id) }}" target="_blank" title="" class="downloadTitre">
                <center>
                    <img src="{{ asset('/upload/pfe2.png')}}" alt="" style="width:80px !important; height: 80px;" id="imgLabel" alt=""><br>
                    <span>Affectation_Stage Etudiant</span>
                </center>
            </a>
        </div>
    </div>
    <div class="col-md-3">
        @if ($demand->binome_pfe)
            <div class="text-center">
                <a href="{{ url('show-affectationBinome/'.$demand->id.'/'.$demand->binome_id) }}" target="_blank" title="" class="downloadTitre">
                    <center>
                        <img src="{{ asset('/upload/pfe3.png')}}" alt="" style="width:80px !important; height: 80px;" id="imgLabel" alt=""><br>
                        <span>Affectation_Stage Binome</span>
                    </center>
                </a>
            </div>
        @endif
    </div>
</div>








                        <hr><br>
                    
                        <?php
                        $ts1 = strtotime($demand->datedebut_pfe);
                        $ts2 = strtotime($demand->datefin_pfe);

                        $year1 = date('Y', $ts1);
                        $year2 = date('Y', $ts2);

                        $month1 = date('m', $ts1);
                        $month2 = date('m', $ts2);

                        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                        ?>
                        <div class="row" style="">
                        <div class="col-md-2" style="margin-top:2%;"></div>
                        <div class="col-md-10" style="border-left: 1px solid rgb(255, 255, 255)">
                            <div class="profile-head">
                            <table class="table table-bordered table-striped">
                                @if ($demand->sous_type == 'اقتراح مشروع تخرج في شركة')
                                    <tr>
                                        <td colspan="4" class="bgCompany"><span class="infoCompany">Info Société</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><label for="nom_societe_pfe">Nom société :  </label> <input type="text" name="nom_societe_pfe" id="nom_societe_pfe" style="width: 100% !important;" value="{{ $demand->nom_societe_pfe }}" class="form-control" ></td>
                                        <td ><label for="encadrant_industriel_pfe">Encadrant Industriel :  </label><input type="text" name="encadrant_industriel_pfe" id="encadrant_industriel_pfe" style="width: 100% !important;" value="{{ $demand->encadrant_industriel_pfe }}" class="form-control" ></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><label for="info_societe_pfe">Information société :</label>
                                            <textarea name="info_societe_pfe" id="info_societe_pfe" style="width: 100% !important;" cols="30" rows="2" class="form-control" value="{{ $demand->info_societe_pfe }}">{{ $demand->info_societe_pfe }}</textarea>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="4" class="bgPfe"><span class="infoPfe">Info projet fin d'étude</span></td>
                                </tr>
                                <tr>
                                    {{-- <td width="32%"><label>Date début :  </label> <input type="date" name="datedebut_pfe" id="" value="{{ date('d-m-Y', strtotime($demand->datedebut_pfe)) }}" class="form-control" ></td> --}}
                                    <td width="32%"><label>Date début :  </label> <input type="date" name="datedebut_pfe" id="" value="{{ $demand->datedebut_pfe }}" class="form-control" ></td>
                                    <td width="32%"><label>Date fin :  </label><input type="date" name="datefin_pfe" id="" value="{{ $demand->datefin_pfe }}" class="form-control" ></td>
                                    <td width="36%"><label>Date Soutenance:  </label><input type="date" name="soutenance_pfe" id="" value="{{ $demand->soutenance_pfe }}" class="form-control" ></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="nom_pfe">Sujet PFE :</label>
                                        <textarea name="nom_pfe" id="nom_pfe" style="width: 100% !important;" cols="30" rows="2" class="form-control" value="{{ $demand->nom_pfe }}">{{ $demand->nom_pfe }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label for="encadrant_pfe">Encadrant PFE:</label>
                                        <select name="encadrant_pfe" id="" class="form-control" >
                                            <option value="{{ $demand->encadrant_pfe }}">{{ $demand->encadrant_pfe }}</option>
                                            <option value="" disabled>-----------------------------------</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->full_name }}">{{ $teacher->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td colspan="2"><label for="statut">Validation PFE:</label>
                                        <select name="statut" id="" class="form-control" >
                                            <option value="{{ $demand->statut }}">{{ $demand->statut }}</option>
                                            <option value="" disabled>-----------------------------------</option>                                            
                                            <option value="Traitée">Validé</option>
                                            <option value="En cours">Non Validé</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="problematique_pfe">Description :</label>
                                    <textarea name="problematique_pfe" id="problematique_pfe" style="width: 100% !important;" cols="30" rows="5" class="form-control" value="{{ $demand->problematique_pfe }}">{{ $demand->problematique_pfe }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="bibliographie_pfe">Bibliographie :</label>
                                    <textarea name="bibliographie_pfe" id="bibliographie_pfe" style="width: 100% !important;" cols="30" rows="5" class="form-control" value="{{ $demand->bibliographie_pfe }}">{{ $demand->bibliographie_pfe }}</textarea>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="desicion_pfe">Décision PFE :</label>
                                    <textarea name="desicion_pfe" id="desicion_pfe" style="width: 100% !important;" cols="30" rows="5" class="form-control" value="{{ $demand->desicion_pfe }}">{{ $demand->desicion_pfe }}</textarea>
                                </tr>
                                </table>
                                <center>
                                <button type="submit" class="btn btn-info">Modifier</button>
                            </center>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            <hr>
            
                    <!-- /.card-header -->
                    <div class="row" style="">
                        <div class="col-md-2" style="margin-top:2%;"></div>
                        <div class="col-md-10" style="border-left: 1px solid rgb(255, 255, 255)">
                            <div class="profile-head">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td colspan="4" class="bgPieces"><span class="infoPieces">Les pièces jointes PFE</span></td>
                                </tr>
                                <tr>
                                    <td width="33%"><h6>Proposition pfe signé  </h6> 

                                        <form action="{{ url('update-proposition/'.$demand->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-input-steps" style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            @if ($demand->proposition_pfe)
                                                                <iframe
                                                                src={{ asset($upload.'/demandesStudents/pfe/propositions/'.$demand->proposition_pfe)}}
                                                                width="100%"
                                                                height="400">
                                                                </iframe> 
                                                                <a href="{{ asset($upload.'/demandesStudents/pfe/propositions/'.$demand->proposition_pfe)}}" target="_blank">Ouvrir le fichier</a>
                                                            @else
                                                            <img src="{{ asset('/upload/notfound.png')}}" alt="" style="width:180px !important; height: 180px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input type="file" id="" style="width: 100% !important;" class="form-control" name="proposition_pfe" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <center>
                                            <div class="mb-3" class="text-left">
                                                    <button type="submit" class="btn btn-warning">Modifier Fichier</button>
                                            </div>
                                            </center>
                                        </form>
                                        
                                    </td>
                                    <td width="33%"><h6>Attestation de stage </h6> 

                                        <form action="{{ url('update-attestation/'.$demand->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-input-steps" style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            @if ($demand->attestation_stage_pfe)
                                                                <iframe
                                                                src={{ asset($upload.'/demandesStudents/pfe/attestations/'.$demand->attestation_stage_pfe)}}
                                                                width="100%"
                                                                height="400">
                                                                </iframe> 
                                                                <a href="{{ asset($upload.'/demandesStudents/pfe/attestations/'.$demand->attestation_stage_pfe)}}" target="_blank">Ouvrir le fichier</a>
                                                            @else
                                                            <img src="{{ asset('/upload/notfound.png')}}" alt="" style="width:180px !important; height: 180px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input type="file" id="" style="width: 100% !important;" class="form-control" name="attestation_stage_pfe" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <center>
                                            <div class="mb-3" class="text-left">
                                                    <button type="submit" class="btn btn-warning">Modifier Fichier</button>
                                            </div>
                                            </center>
                                        </form>
                                        
                                    </td>
                                    <td width="34%"><h6>Rapport et livrable</h6> 

                                        <form action="{{ url('update-rapport/'.$demand->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-input-steps" style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            @if ($demand->rapport_livrable_pfe)
                                                                <iframe
                                                                src={{ asset($upload.'/demandesStudents/pfe/rapports/'.$demand->rapport_livrable_pfe)}}
                                                                width="100%"
                                                                height="400">
                                                                </iframe> 
                                                                <a href="{{ asset($upload.'/demandesStudents/pfe/rapports/'.$demand->rapport_livrable_pfe)}}" target="_blank">Ouvrir le fichier</a>
                                                            @else
                                                            <img src="{{ asset('/upload/notfound.png')}}" alt="" style="width:180px !important; height: 180px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input type="file" id="" style="width: 100% !important;" class="form-control" name="rapport_livrable_pfe" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <center>
                                            <div class="mb-3" class="text-left">
                                                    <button type="submit" class="btn btn-warning">Modifier Fichier</button>
                                            </div>
                                            </center>
                                        </form>
                                        
                                    </td>
                                </tr>
                                </table>
                            </div>
                        </div>
                    </div>
            
            @endforeach
        </div>
    </div>
</div>
@endsection