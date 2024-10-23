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

.content span{
    font-size: 17px !important;
}

.content b{
    font-size: 17px !important;
}
</style>
<div id="printme" class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card" id="invoicepdf" style="margin-left: -3% !important; margin-top: -5%;">
                <!-- partial:index.partial.html -->
                <div class="container invoice">
                <div class="invoice-body">
                    @foreach ($demandes as $demand)
                    <div class="row">
                    <div class="col-xs-12">
                        <table width="100%">
                            <tr  align="center" style="margin-right:10%;">
                                <td width="40%">
                                    <span class="headerText1">République Tunisienne</span><br>
                                    <span class="headerText1">Ministère de L’Enseignement </span><br>
                                    <span class="headerText1">Supérieur et de la Recherche</span><br>
                                    <span class="headerText1">Scientifique</span><br>
                                    <span class="headerText1">Université de Gafsa</span>
                                </td>
                                <td width="20%">
                                    <br>
                                    <img src="{{ asset('upload/republiqueTunisienneLogo.jpg') }}" width="50px" alt="republiqueTunisienne"></td>
                                </td>
                                <td width="40%">
                                    <img src="{{ asset('upload/logo-isam.png') }}" width="50px" alt="issat"><br>
                                    <span class="headerText1">Institut Supérieur d'arts et métiers</span><br>
                                    <span class="headerText1">De Gafsa</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xs-12" style="margin-top: -1%">
                        <br>
                        @if ($demand->sous_type == 'اقتراح مشروع تخرج في شركة')
                            <center class="titreDemande"><h3>A Monsieur le Directeur de : <b>{{ $demand->nom_societe_pfe }}</b></h3></center>
                        @else
                            @if ($demand->classe->category == 'Licence')
                                <center class="titreDemande"><h4>Stage PFE Didactique</h4></center>
                            @else
                                <center class="titreDemande"><h4>Stage mémoire de mastère</h4></center>
                            @endif
                        @endif
                    </div>
                    <div class="col-xs-12">                        
                        <div class="panel-body">
                            <div class="row">
                            
                                <div class="col-xs-12 content">
                                    <b><U>Objet :</U></b><span> Affectation de Stagiaire </span><br>
                                    <span>Monsieur,</span> <br>
                                    <span>Je vous remercie d’avoir bien voulu accepter d’accueillir des stagiaires de l’ISSAT-Gafsa, et j’ai le plaisir de vous informer que :</span><br>
                                        
                                        @foreach ($binome as $element)
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>L’étudiant(e) :</span> <b>{{ $element->nom }} {{ $element->prenom }}</b><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>CIN :</span> <b>{{ $element->cin }}</b><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Inscrit(e) en :</span> <b></b><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Spécialité :</span> <b>{{ $element->abbreviation }}</b><br>
                                        @endforeach
                                        <span>est désigné(e) pour effectuer un stage : 
                                        @if ($demand->classe->category == 'Licence')
                                            <b>PFE</b>
                                        @else
                                            <b>Mémoire de mastère</b>
                                        @endif
                                        dans votre établissement du</span>
                                        <center><b>{{ $demand->datedebut_pfe }}</b> <span>au</span> <b>{{ $demand->datefin_pfe }}</b></center><br>
                                    
                                    <span>Ce stage est délivré par une attestation de stage à l’intéressé.</span><br>
                                    <span>En vous remerciant de votre bienveillante collaboration, veuillez agréer, Monsieur le Directeur, l’expression de mes meilleures salutations.</span><br><br>
                                    
                                    <div style="text-align: center; margin-left: 50%">
                                        <span>Gafsa le</span> <?php $mydate = new \DateTime(); echo '<span>'.$mydate->format('d-m-Y').'</span>'; ?><br>
                                        <span>La Directrice</span><br>
                                        <span>LAHOUEL Nesrine</span><br><br><br><br>
                                        {{-- <img src="{{ asset('upload/signatureDirecteur123456231222222.png') }}" width="63px" alt=""><br> --}}
                                    </div>
                                    <br>
                                  

                                </div>
                            </div>
                        </div>
                    </div>
                    <table width="100%" border="0">
                        <tr>
                            <td><b>Remarque:</b></td>
                            <td>
                                - L'étudiant est tenue de respecter les dates fixées pour le déroulement de son stage. <br>
                                - Les stages demandés sont obligatoires.
                            </td>
                        </tr>
                    </table>
                    
                    
                <span class="footer2"><b>N.B. :</b>Les stagiaires sont couverts par une assurance contractée par l'ISAM Gafsa </span><br>
                <div class="invoice-footer">
                    {{-- <center>
                        <img src="{{ asset('upload/footerAffectation.png') }}" width="100%" alt=""><br>
                    </center> --}}
                    <center>
                        <hr class="new1">
                        <div class="footer3">
                            <span>Adresse : Institut Supérieur d'arts et métiers de Gafsa</span><br>
                            <span>Route de Tozeur, Sidi Ahmed Zarroug Gafsa - Tunisie</span><br>
                            <span>Tél. : 76 211 107 / Fax : 76 211 108</span>
                        </div>
                    </center>
                </div>
            
                    @php
                        $mydate = date('d/m/Y');
                        $fileName= $demand->student->nom.$demand->student->prenom.'AffectationStage_' ;
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
        {{-- <button id="printPageButton2" class="btn btn-primary"> 
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
                
