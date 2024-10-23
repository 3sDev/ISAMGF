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
hr.myHR {
    border: 1px solid rgb(0, 0, 0);
}
.content span{
    font-size: 15px !important;
}

.content b{
    font-size: 15px !important;
}

.titreDemandeProposition{
    font-size: 22px !important;
    font-weight: bold !important;
    color: black !important;
}
</style>
<div id="printme" class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card" id="invoicepdf" style="margin-left: -3% !important; margin-top: -3% !important;">
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
                                    <span class="headerText1">Institut Supérieur d'arts et métiers de Gafsa</span><br>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-xs-12">
                        <center>
                            <h2 class="titreDemandeProposition">Proposition de stage Ouvrier</h2>
                        </center>
                    </div>
                    <div class="col-xs-12">                        
                        <div class="panel-body">
                            <div class="row">
                            
                                <div class="col-xs-12 content">
                                    <b><U>Informations de l’étudiant(e):</U></b><br>

                                    <span>Nom et prénom :</span> <b>{{ $demand->student->nom }} {{ $demand->student->prenom }}</b><br>
                                    <span>Classe :</span> <b>{{$demand->classe->abbreviation }}</b><br>
                                    <span>CIN (ou passeport) :</span> <b>{{ $demand->student->cin }}</b><br>
                                    <span>Adresse personnelle :</span> <b>{{ $demand->student->rue_etudiant }}</b><br>
                                    <span>Numéro de téléphone :</span> <b>{{ $demand->student->tel1_etudiant }}</b><br>

                                    <span>Type de stage (stage obligatoire d'été d'une durée de 30 jours entre les mois de juillet et août) : Stage Ouvrier<br>
                                    <span><b>N.B. :</b> Les stagiaires sont couverts par une assurance contractée par l’ISAM – Gafsa</span>
                                    <hr class="myHR">
                                    <b><U>Informations sur l’organisme d’accueil :</U></b><br>

                                    <span>Nom de l’organisme :</span> ..........................................................................................................<br>
                                    <span>Domaines d'activités :</span> .........................................................................................................<br>
                                    <span>Adresse du siège social :</span> .....................................................................................................<br>
                                        <table width="100%">
                                            <tr>
                                                <td width="50%"><span>Téléphone :</span>..................................................</td>
                                                <td width="50%"><span>Fax :</span>............................................................</td>
                                            </tr>
                                        </table>
                                    <span>Lieu et adresse du stage  :</span> ....................................................................................................<br><br>
                                    <span>Le nom de la personne responsable du stage et sa poste :</span> ..................................................<br>
                                    <table width="100%">
                                        <tr>
                                            <td width="50%"><span>Téléphone :</span>..................................................</td>
                                            <td width="50%"><span>Fax :</span>............................................................</td>
                                        </tr>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td width="50%"><span>Période de stage de  :</span>....................................</td>
                                            <td width="50%"><span>à :</span>................................................................</td>
                                        </tr>
                                    </table>
                                    <br>
                                    <div style="text-align: center; margin-left: 50%">
                                        <span>Gafsa le</span> ........................<br>
                                        <span>Signature et cachet de l’entreprise</span><br><br><br><br>
                                    </div>
                                    <br>
                                    <hr class="myHR">
                                    <center>
                                        <span>Adresse : Institut Supérieur d'arts et métiers de Gafsa</span><br>
                                        <span>Route de Tozeur, Sidi Ahmed Zarroug Gafsa - Tunisie</span><br>
                                        <span>Tél. : 76 211 107 / Fax : 76 211 108</span>
                                    </center>

                                </div>
                            </div>
                        </div>
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
                
