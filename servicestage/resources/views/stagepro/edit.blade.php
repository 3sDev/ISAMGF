@extends('adminlayoutenseignant.layout')
@section('title', 'Modifier stage professionnel')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Modifier Stage Pro</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('professionnel') }}">Liste des stages pro</a></li>
          <li class="breadcrumb-item active">Modifier Stage Pro</li>
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
                
                <form action="{{ url('update-proDirection/'.$demand->id) }}" method="POST"  onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
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
                                {{-- <div class="col-md-2" style="margin-top:2%;">
                                    <div class="text-center">
                                        <a href="{{ url('show-demandePro/'.$demand->id) }}" target="_blank" title="Stage Pro" class="downloadTitre">
                                            <center><img alt="Stage Pro" src={{ url('upload/logo_word.png') }} class="downloadImage" id="imgLabel">
                                        </a>
                                    </div>
                                </div> --}}
                            </div>
                      
                            
<hr>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-3">
        <div class="text-center">
            @if ($demand->sous_type == 'اجراء تربص مهني تقني')
                <a href="{{ url('show-proTechnicien/'.$demand->id) }}" target="_blank" title="اجراء تربص مهني تقني" class="downloadTitre">
                    <center>
                        <img src="{{ asset('/upload/pfe1.png')}}" alt="" style="width:80px !important; height: 80px;" id="imgLabel" alt="اجراء تربص مهني تقني"><br>
                        <span>Proposition Stage Technicien</span>
                    </center>
                </a>
            @else
                <a href="{{ url('show-proOuvrier/'.$demand->id) }}" target="_blank" title="اجراء تربص مهني عامل" class="downloadTitre">
                    <center>
                        <img src="{{ asset('/upload/pfe1.png')}}" alt="" style="width:80px !important; height: 80px;" id="imgLabel" alt="اجراء تربص مهني عامل"><br>
                        <span>Proposition Stage Ouvrier</span>
                    </center>
                </a>
            @endif
            
        </div>
    </div>
    <div class="col-md-3">
        <div class="text-center">
            @if ($demand->sous_type == 'اجراء تربص مهني تقني')
                <a href="{{ url('show-AffectTechnicien/'.$demand->id) }}" target="_blank" title="Affectation_Stagiaire_Technicien" class="downloadTitre">
                    <center>
                        <img src="{{ asset('/upload/pfe2.png')}}" alt="" style="width:80px !important; height: 80px;" id="imgLabel" alt="Affectation_Stagiaire_Technicien"><br>
                        <span>Affectation_Stagiaire Technicien</span>
                    </center>
                </a>
            @else
                <a href="{{ url('show-AffectOuvrier/'.$demand->id) }}" target="_blank" title="Affectation_Stagiaire Ouvrier" class="downloadTitre">
                    <center>
                        <img src="{{ asset('/upload/pfe2.png')}}" alt="" style="width:80px !important; height: 80px;" id="imgLabel" alt="Affectation_Stagiaire_Ouvrier"><br>
                        <span>Affectation_Stagiaire Ouvrier</span>
                    </center>
                </a>
            @endif
        </div>
    </div>
    {{-- <div class="col-md-3">
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
    </div> --}}
</div>
<hr>


                    
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
                                <tr>
                                    <td colspan="4" class="bgCompany"><span class="infoCompany">Info Société</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label for="stage_company">Nom société :  </label> <input type="text" name="stage_company" id="stage_company" style="width: 100% !important;" value="{{ $demand->stage_company }}" class="form-control" ></td>
                                    <td ><label for="stage_encadreur_campany">Encadrant Industriel :  </label><input type="text" name="stage_encadreur_campany" id="stage_encadreur_campany" style="width: 100% !important;" value="{{ $demand->stage_encadreur_campany }}" class="form-control" ></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="stage_info_company">Information société :</label>
                                        <textarea name="stage_info_company" id="stage_info_company" style="width: 100% !important;" cols="30" rows="2" class="form-control" value="{{ $demand->stage_info_company }}">{{ $demand->stage_info_company }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="bgPfe"><span class="infoPfe">Informations de stage</span></td>
                                </tr>
                                <tr>
                                    {{-- <td width="32%"><label>Date début :  </label> <input type="date" name="datedebut_pfe" id="" value="{{ date('d-m-Y', strtotime($demand->datedebut_pfe)) }}" class="form-control" ></td> --}}
                                    <td width="32%"><label>Date début :  </label> <input type="date" name="stage_debut" id="" value="{{ $demand->stage_debut }}" class="form-control" ></td>
                                    <td width="32%"><label>Date fin :  </label><input type="date" name="stage_fin" id="" value="{{ $demand->stage_fin }}" class="form-control" ></td>
                                    <td width="36%"><label>Date Soutenance:  </label><input type="date" name="stage_soutenance" id="" value="{{ $demand->stage_soutenance }}" class="form-control" ></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="stage_sujet">Sujet stage :</label>
                                        <textarea name="stage_sujet" id="stage_sujet" style="width: 100% !important;" cols="30" rows="2" class="form-control" value="{{ $demand->stage_sujet }}">{{ $demand->stage_sujet }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="statut">Validation Stage:</label>
                                        <select name="statut" id="" class="form-control" >
                                            <option value="{{ $demand->statut }}">{{ $demand->statut }}</option>
                                            <option value="" disabled>-----------------------------------</option>                                            
                                            <option value="Traitée">Validé</option>
                                            <option value="En cours">Non Validé</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="stage_description">Description :</label>
                                    <textarea name="stage_description" id="stage_description" style="width: 100% !important;" cols="30" rows="5" class="form-control" value="{{ $demand->stage_description }}">{{ $demand->stage_description }}</textarea>
                                    </td>
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
                                    <td colspan="4" class="bgPieces"><span class="infoPieces">Les pièces jointes de stage</span></td>
                                </tr>
                                <tr>
                                    <td width="33%"><h6>Proposition stage signé  </h6> 

                                        <form action="{{ url('update-propositionStagePro/'.$demand->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-input-steps" style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            @if ($demand->stage_proposition_file)
                                                                <iframe
                                                                src={{ asset($upload.'/demandesStudents/stagePro/propositions/'.$demand->stage_proposition_file)}}
                                                                width="100%"
                                                                height="400">
                                                                </iframe> 
                                                                <a href="{{ asset($upload.'/demandesStudents/stagePro/propositions/'.$demand->stage_proposition_file)}}" target="_blank">Ouvrir le fichier</a>
                                                            @else
                                                            <img src="{{ asset('/upload/notfound.png')}}" alt="" style="width:180px !important; height: 180px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input type="file" id="" style="width: 100% !important;" class="form-control" name="stage_proposition_file" required>
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

                                        <form action="{{ url('update-attestationStagePro/'.$demand->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-input-steps" style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            @if ($demand->stage_attestation_file)
                                                                <iframe
                                                                src={{ asset($upload.'/demandesStudents/stagePro/attestations/'.$demand->stage_attestation_file)}}
                                                                width="100%"
                                                                height="400">
                                                                </iframe> 
                                                                <a href="{{ asset($upload.'/demandesStudents/stagePro/attestations/'.$demand->stage_attestation_file)}}" target="_blank">Ouvrir le fichier</a>
                                                            @else
                                                            <img src="{{ asset('/upload/notfound.png')}}" alt="" style="width:180px !important; height: 180px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input type="file" id="" style="width: 100% !important;" class="form-control" name="stage_attestation_file" required>
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

                                        <form action="{{ url('update-rapportStagePro/'.$demand->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de modifier ces données?')" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-input-steps" style="text-align: left;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            @if ($demand->stage_rapport_file)
                                                                <iframe
                                                                src={{ asset($upload.'/demandesStudents/stagePro/rapports/'.$demand->stage_rapport_file)}}
                                                                width="100%"
                                                                height="400">
                                                                </iframe> 
                                                                <a href="{{ asset($upload.'/demandesStudents/stagePro/rapports/'.$demand->stage_rapport_file)}}" target="_blank">Ouvrir le fichier</a>
                                                            @else
                                                            <img src="{{ asset('/upload/notfound.png')}}" alt="" style="width:180px !important; height: 180px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input type="file" id="" style="width: 100% !important;" class="form-control" name="stage_rapport_file" required>
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