@extends('adminlayoutenseignant.layout')
@section('title', 'Détails PFE')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Détails PFE</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('pfe') }}">Liste des PFE</a></li>
          <li class="breadcrumb-item active">Détails PFE</li>
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
                                <div class="col-md-4" style="border-left: 1px solid rgb(255, 255, 255)">
                                    
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
                                <div class="col-md-4" style="border-left: 1px solid rgb(255, 255, 255)">
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
                                            <label>&nbsp;&nbsp;&nbsp;Binome  </label>
                                        </div>
                                        <div class="col-md-7">
                                            <p>{{ $demand->binome_pfe }}</p>
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
                                <div class="col-md-2" style="margin-top:2%;">
                                    <div class="text-center">
                                        @if ($demand->sous_type == 'اقتراح مشروع تخرج بالمؤسسة')
                                            <a download="pfe_didactique_issat_Gafsa.docx" href="{{ url('upload/pfe_didactique_issat_Gafsa.docx') }}" title="اقتراح مشروع تخرج بشركة" class="downloadTitre">
                                                <center><img alt="اقتراح مشروع تخرج بشركة" src={{ url('upload/logo_word.png') }} class="downloadImage" id="imgLabel">
                                                <label class="labelFileDownload" for="imgLabel">تحميل الإقتراح</label></center>
                                            </a>
                                        @else
                                            <a download="pfe_industriel_issat_Gafsa.docx" href="{{ url('upload/pfe_industriel_issat_Gafsa.docx') }}" title="اقتراح مشروع تخرج بالمؤسسة" class="downloadTitre">
                                                <center><img alt="اقتراح مشروع تخرج بالمؤسسة" src={{ url('upload/logo_word.png') }} class="downloadImage" id="imgLabel">
                                                <label class="labelFileDownload" for="imgLabel">تحميل الإقتراح</label></center>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        <br><br><br>
                    
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
                                    <td colspan="4"><label for="nom_pfe">Sujet PFE :</label>
                                      <p>{{ $demand->nom_pfe }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="33%"><label>Date début :  </label><span>{{ date('Y-m-d', strtotime($demand->datedebut_pfe)) }}</span></td>
                                    <td width="33%"><label>Date fin :  </label><span>{{ date('Y-m-d', strtotime($demand->datefin_pfe)) }}</span></td>
                                    <td width="33%"><label>Durée PFE (mois):  </label><span>{{ $demand->duree_pfe }}</span></td>
                                </tr>
                                @if ($demand->sous_type == 'اقتراح مشروع تخرج بشركة')
                                    <tr>
                                        <td colspan="2"><label for="nom_societe_pfe">Nom société :  </label> <span>{{ $demand->nom_societe_pfe }}</span></td>
                                        <td ><label for="encadrant_industriel_pfe">Encadrant Industriel :  </label><span>{{ $demand->encadrant_industriel_pfe }}</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><label for="info_societe_pfe">Information société :</label>
                                          <p>{{ $demand->info_societe_pfe }}</p>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="4"><label for="problematique_pfe">Problématique :</label>
                                    <p>{{ $demand->problematique_pfe }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="bibliographie_pfe">Bibliographie :</label>
                                    <p>{{ $demand->bibliographie_pfe }}</p>
                                </tr>
                                <tr>
                                    <td colspan="4"><label for="desicion_pfe">Décision PFE :</label>
                                    <p>{{ $demand->desicion_pfe }}</p>
                                </tr>
                                </table>
                                <center>
                                  <button id="print" class="btn btn-secondary" onclick="printContent('id name of your div');" >Imprimer</button>
                                </center>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
<script>
  function printContent(el){
  var restorepage = $('printPage').html();
  var printcontent = $('#' + el).clone();
  $('printPage').empty().html(printcontent);
  window.print();
  $('printPage').html(restorepage);
  }
</script>
@endsection