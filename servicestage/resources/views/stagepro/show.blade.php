<link rel="stylesheet" href="{{ URL::asset('css/invoice.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="css/invoice.css">
<script src="api/pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<style>
@media print {
    @page { margin: 0; }
    body { margin: 1.6cm; }

    #printPageButton {
    display: none;
    }
    #printPageButton2 {
    display: none;
    }
    #printPageButton3 {
    display: none;
    }
}
    
.blockStyle{
    padding-bottom: 15px !important;
    text-align: right;
}

.profile_image{
    width: 110px;
    height: 130px;
}
.headerText1{
    font-size: 12px !important;
    font-weight: 100;
}
</style>
<div id="printme" class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card" id="invoicepdf" style="margin-left: -3% !important;">
                <!-- partial:index.partial.html -->
                <div class="container invoice">
                <div class="invoice-body">
                    @foreach ($demandes as $demand)
                    <div class="row">
                    <div class="col-xs-12">
                        <table width="100%">
                            <tr  align="center" style="margin-right:10%;">
                                <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                <td width="10%"></td>
                                <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="50px" alt="isam"><br></td>
                            </tr>
                            <tr align="center">
                                <td>
                                    <span class="headerText1">Ministère de l’Enseignement Supérieur</span><br>
                                    <span class="headerText1">et de la Recherche Scientifique</span>
                                </td>
                                <td></td>
                                <td>
                                    <span class="headerText1">Université de Gafsa</span><br>
                                    <span class="headerText1">Institut Supérieur des Sciences Appliquées</span><br>
                                    <span class="headerText1">et de Technologie de Gafsa</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xs-12">
                        <center class="titreDemande"><h3>PROPOSITION D'UN PROJET DE FIN D'ETUDES</h3></center>
                    </div>
                    <div class="col-xs-12">                        
                        <div class="panel-body">
                            <div class="row">
                            
                                <div class="col-xs-12">
                                    <h5>Enseignant encadreur : ......................................................................................................................................................</h5>
                                    <span>Type du sujet : </span> 
                                    @if ($demand->sous_type=='اقتراح مشروع تخرج في شركة')
                                        <label>Industriel</label><br>
                                        <span>Entreprise : ...........................................................................................................................................................</span> <br>
                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adresse : .........................................................................................................................................................<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tél : ................................................................................................................................................................<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax : ...............................................................................................................................................................<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Encadreur industriel : ....................................................................................................................................<br>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-mail : ..........................................................................................................................................................</span><br>
                                    @else
                                        <label>Didactique</label><br>
                                    @endif
                                    
                                    <span>Nombre d'étudiants : </span>
                                    @if ($demand->binome_pfe)
                                        <label>2</label><br>
                                        <span>Nom et Prénom étudiant(e) : </span> <label>{{ $demand->student->nom }} {{ $demand->student->prenom }}</label><br>
                                        <span>Nom et Prénom binôme : </span> <label>{{ $demand->binome_pfe }}</label><br>
                                    @else
                                        <label>1</label><br>
                                        <span>Nom et Prénom étudiant(e) : </span> <label>{{ $demand->student->nom }} {{ $demand->student->prenom }}</label><br>
                                    @endif
                                    
                                    
                                    <span>Compétences demandées : .................................................................................................................................... </span><br>
                                    <span>Titre du P.F.E : </span>
                                        <label style="font-weight: 200 !important;">...................................................................................................................................................... </label><br>
                                        <span>............................................................................................................................................................................... </span><br>
                                    <span>Cahier des Charges :</span><br>
                                    <hr class="new1"><hr class="new1"><hr class="new1"><hr class="new1"><hr class="new1">
                                    <span>Estimation du coût de réalisation : .......................................................................................................................</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="invoice-footer">
                        <center>
                            <img src="{{asset('upload/footerDemandePFE.png') }}" width="90%" alt="issatGafsa">
                        </center>
                    </div>
            
                    @php
                        $fileName= $demand->student->nom.$demand->student->prenom.$demand->sous_type ;
                    @endphp 

                @endforeach

                </div>
                </div>
                <!-- partial -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 text-right mb-3">
      {{--   <button id="printPageButton2" class="btn btn-primary"> 
            Télécharger pdf
        </button> --}}
    </div>

        <button id="printPageButton" class="btn btn-primary" style="background-color: #21a594;" onClick="window.print();" class="noPrint">
            Imprimer
        </button>
    <br><br><br>
</div>
            
<script type='text/javascript'>
    window.onload = function() {

    var myVar =  <?php echo(json_encode($fileName.date('Y-m-d'))); ?>;
    
    document.getElementById("printPageButton2")
        .addEventListener("click", () => {
            const invoicepdf = this.document.getElementById("invoicepdf");
            console.log(invoicepdf);
            console.log(window);
            var opt = {
                margin: 0,
                filename: myVar,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(invoicepdf).set(opt).save();
        })
    }
</script>
                
