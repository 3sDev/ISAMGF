<link rel="stylesheet" href="{{ URL::asset('css/invoice.css') }}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="css/invoice.css">
<script src="api/pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<style>

@media print {
  #printPageButton {
    display: none;
  }
  #printPageButton2 {
    display: none;
  }
}
</style>
<div id="printme" class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
        
        <div class="col-md-12">
            <div class="card">

                <!-- partial:index.partial.html -->
                <div class="container invoice">
                <div class="invoice-header">
                   
                </div>
                <div class="invoice-body">

                    @foreach ($demandestudents as $demand)

                    @if ($demand->type=='شهادة ترسيم' && $demand->langue=='fr')

                    <div class="row">
                    <div class="col-xs-12">
                        <img src="{{ URL::asset('image/demandeStudent/header-isam.jpg') }}" width="100%" alt="">
                    </div>
                    <div class="col-xs-12">
                        <center class="titreDemande"><h3>ATTESTATION D'INSCRIPTION <br><b class="anneeUniversitaire">2022 - 2023</b></h3></center>
                    </div>
                    <div class="col-xs-12">

                    </div>
                    <div class="col-xs-12">                        
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-1">
                                </div>
                                <div class="col-xs-11">
                                    <h4>Le secrétaire général de l'<b>Institut Supérieur des Arts et Métiers de Gafsa</b> soussigné, atteste que l'étudiant(e) :</h4>
                                    <span>Nom : </span> <label>{{ $demand->student->nom }}</label><br>
                                    <span>Prénom : </span> <label>{{ $demand->student->prenom }}</label><br>
                                    <span>Né(e) le : </span> <label>20/09/1999</label><br>
                                    <span>Titulaire de la Carte d'Identité Nationale N°: </span> <label>{{ $demand->student->cin }}</label><br>
                                    <span>est inscrit en </span><label>première année</label>, groupe <label>LGM1G3</label><br>
                                    <span>Diplome : </span> <label>Licence en économie et gestion</label><br>
                                    <span>Spécialité : </span> <label>Economie (ISAM Gafsa)</label><br>
                                    <br>
                                    <span>Sous le numéro:</span> <label>LGM12210</label> <span>pour l'année universitaire en cours.</p>
                                    
                                    <div class="direction" style="float: right">
                                        <span>Fait à Gafsa, le {{date('Y-m-d')}}</span><br>
                                        <span>La secrétaire général</span>
                                    </div>
                                    
                                    <img class="imgSymbole" src="{{ URL::asset('image/demandeStudent/symbole.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="invoice-footer">
                        <hr>
                        <strong>Adresse :</strong> Campus Universitaire Sidi Ahmed Zarrouk - 2112 Gafsa
                            <br/> <strong>T.:</strong> 76 21 11 07 &nbsp;&nbsp;&nbsp;  <strong>F.:</strong> 76 21 11 08<br/>
                            <strong>Email:</strong> contact@isamgf.rnu.tn
                        </div>
                    </div>

                    @endif

                    @if ($demand->type=='شهادة ترسيم' && $demand->langue=='ar')

                    <div class="row">
                        <div class="col-xs-12">
                            <img src="{{ URL::asset('image/demandeStudent/header_ar-isam.jpg') }}" width="100%" alt="">
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemande"><h3>{{ $demand->type }} <br><b class="anneeUniversitaire">2022 - 2023</b></h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11" style="text-align:right !important;">
                                        <span class="spacingSpan">{{ $demand->student->nom_ar }}</span> <label> : الإسم</label><br>
                                        <span class="spacingSpan">{{ $demand->student->prenom_ar }}</span> <label> : اللقب</label><br>
                                        <span class="spacingSpan">20/09/1999</span> <label> : تاريخ الولادة</label><br>
                                        <span class="spacingSpan">{{ $demand->student->cin }}</span> <label> : صاحب(ة) بطاقة التعريف الوطنية رقم</label><br>
                                        <span class="spacingSpan">LGM1G3</span> <label>فوج </label> <span>،الثانية</span> <label> :  مرسم(ة) بالسنة</label><br>
                                        <span class="spacingSpan">الإجازة التطبيقية في الإقتصاد والتصرف</span> <label> : الشهادة</label><br>
                                        <span class="spacingSpan">الإقتصاد الرقمي</span> <label> : الإختصاص</label><br>
                                        <span class="spacingSpan"> LGM12210</span> <label> : تحت رقم</label><br>
                                        <p>تم تسجيله في السنة التحضيرية إختصاص هندسة ميكانيكية لعام وذلك بالنسبة إلى السنة الجامعية الحالية</p>
                                        
                                        <div class="direction">
                                            <span>قفصة في {{date('Y/m-d')}}</span><br>
                                            <span>الكاتب العام</span>
                                        </div>
                                        <img class="imgSymboleAr" src="{{ URL::asset('image/demandeStudent/symbole.png') }}" alt="">

                                    </div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="invoice-footer">
                            <hr>
                            <strong> العنوان : </strong> الفضاء الجامعي سيدي أحمد زروق - قفصة 2112 <br/>
                                الهاتف : 515 211 76  &nbsp;/&nbsp;    الفاكس : 985 211 76 <br/>
                              
                                issatgf.website@gmail.com <strong> : البريد الإلكتروني</strong> 
                            </div>
                        </div>

                    @endif

                   @php
                       $fileName= $demand->student->nom.$demand->student->prenom.$demand->type ;
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
        <button id="printPageButton2" class="btn btn-primary" id="download"> Télécharger pdf</button>
    </div>

    <button id="printPageButton" class="btn btn-primary" style="background-color: #21a594;" onClick="window.print();" class="noPrint">
    Imprimer
    </button>
    <br><br><br>
</div>

<script type='text/javascript'>
    window.onload = function() {

    var myVar =  <?php echo(json_encode($fileName.date('Y-m-d'))); ?>;
   
    document.getElementById("download")
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