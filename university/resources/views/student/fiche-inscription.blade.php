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

                    {{-- @foreach ($inscritStudents as $inscrit) --}}

                    <div class="row">
                        <div class="col-xs-12">
                            <img src="{{ URL::asset('image/demandeStudent/header_ar.jpg') }}" width="100%" alt="">
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemande"><h3>شهادة تسجيل</h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11" style="text-align:right !important;">
                                        <span></span> <label> : الإسم</label><br>
                                        <span></span> <label> : اللقب</label><br>
                                        <span>20/09/1999</span> <label> : تاريخ الولادة</label><br>
                                        <span>تونسية</span> <label> : الجنسية</label><br>
                                        <br>
                                        <span>41099231</span> <label> : رقم التسجيل</label><br>
                                        <span>15/10/2021</span> <label> : تاريخ التسجيل</label><br>
                                        <span>الكهروميكانيكية</span> <label> : الشعبة</label><br>
                                        <br>
                                        <p>تم تسجيله في السنة التحضيرية إختصاص هندسة ميكانيكية لعام 2021/2022.</p>
                                        <span>قفصة في {{date('Y/m-d')}}</span><br>
                                        <div class="direction">
                                            <span>الإدارة</span>
                                        </div>
                                        
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


                   {{-- @php
                       $fileName= $demand->student->nom.$demand->student->prenom.$demand->type ;
                   @endphp 

                @endforeach --}}

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

    var myVar =  <?php echo(json_encode('Inscription'.date('Y-m-d'))); ?>;
    //var myVar =  <?php echo(json_encode($fileName.date('Y-m-d'))); ?>;
   
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