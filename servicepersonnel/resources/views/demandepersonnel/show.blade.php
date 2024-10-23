<link rel="stylesheet" href="{{ URL::asset('css/invoice.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="css/invoice.css">
<script src="api/pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<style>
body{
    font-family: 'Times New Roman', Times, serif !important;
}
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

.new1{
    border: 1px solid black;
    width: 80% !important;
    margin-bottom: 3px;
}

.tagIssat{
    width: 50px;
    position: absolute;
    float: right;
    margin-left: 4%;
}
</style>
<div id="printme" class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card" id="invoicepdf" style="margin-left: -3% !important;">
                <!-- partial:index.partial.html -->
               
                @foreach ($demandepersonnels as $demand)

                {{-- @if ($demand->type == 'شهادة عمل' || $demand->type == 'حجز الاداء على الدخل' || $demand->type == 'توطين حساب جاري' || $demand->type == 'بطاقة خلاص' || $demand->type == 'شهادة في الاجر' || $demand->type == 'حصول على قائمة في الخدمات' || $demand->type == 'تحيين الحالة العائلية' || $demand->type == 'ترخيص للقيام بتدريس حصص إضافية' || $demand->type == 'تغيير حساب جاري') --}}
                @if ($demand->type=='شهادة عمل' && $demand->langue=='fr')
                <div class="container invoice">
                    <div class="invoice-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <table width="100%">
                                    <tr  align="center" style="margin-right:10%;">
                                        <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                        <td width="10%"></td>
                                        <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="60px" alt="isam"><br></td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <SPAN class="headerText">RÉPUBLIQUE TUNISIENNE</SPAN><BR>
                                            <SPAN class="headerText">MINISTERE DE L'ENSEIGNEMENT SUPERIEUR</SPAN><BR>
                                            <SPAN class="headerText">ET DE LA RECHERCHE SCIENTIFIQUE</SPAN>
                                        </td>
                                        <td></td>
                                        <td>
                                            <SPAN class="headerText">UNIVERSITE DE GAFSA</SPAN><BR>
                                            <SPAN class="headerText">INSTITUT SUPERIEUR D'ARTS ET MÉTIERS</SPAN><BR>
                                            <SPAN class="headerText">DE GAFSA</SPAN>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-xs-12">
                                <br><center class="titreDemande"><h3><b>ATTESTATION DE TRAVAIL</b></h3></center>
                            </div>
                            <div class="col-xs-12">

                            </div>
                            <div class="col-xs-12">                        
                                <div class="panel-body">
                                    <div class="row">
                                        {{-- <div class="col-xs-1">
                                        </div> --}}
                                        <div class="col-xs-12">
                                            @if ($signature == 'Directeur')
                                            <span>Le Directeur de l’Institut Supérieur des Sciences Appliquées et de Technologie de Gafsa atteste que</span><br><br>
                                            @else
                                                <span>Le secrétaire général de l’Institut Supérieur des Sciences Appliquées et de Technologie de Gafsa atteste que</span><br><br>
                                            @endif                                            <span>Mr (me) : </span> <label>{{ $demand->personnel->nom.' '.$demand->personnel->prenom  }}</label><br>
                                            <span>Né(e) le : </span> <label>{{ $demand->personnel->ddn }}</label> à <label>{{ $demand->personnel->gov }}</label><br>
                                            @if ($demand->personnel->nationnalite == 'تونسية' || $demand->personnel->nationnalite == 'Tunisienne')
                                                <span>Nationalité : </span> <label>Tunisienne</label><br>
                                            @else
                                                <span>Nationalité : </span> <label>Autre nationnalité que tunisienne</label><br>
                                            @endif                                            <span>Identifiant unique : </span> <label>{{ $demand->personnel->matricule }}</label><br>
                                            <span>Carte d'Identité Nationale : </span> <label>{{ $demand->personnel->cin }}</label><br>
                                            <span>Exerce à l’Institut Supérieur d'arts et métiers de Gafsa en qualité de :</span>
                                            <center>
                                                <h4>{{ explode("/", $demand->personnel->poste)[0] }}</h4>
                                            </center>
                                            <span>Cette attestation est délivrée à l’intéressé(e) sur sa demande, pour servir et valoir ce que de droit.</span><br>

                                            <div class="signature">
                                                <center>
                                                    <br>
                                                    <span>Gafsa le {{date('Y-m-d', strtotime($demand->created_at))}}</span><br>
                                                    @if ($signature == 'Directeur')
                                                        <span>Le Directeur</span><br>
                                                        <span>{{ $variables[0]->directeur_fr }}</span><br><br><br><br><br><br>
                                                    @else
                                                        <span>Secrétaire général</span><br>
                                                        <span>{{ $variables[0]->secretaire_fr }}</span><br><br><br><br><br><br>
                                                    @endif
                                                    
                                                </center>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="invoice-footer">
                            <center>
                                <hr class="new1">
                                <span>Adresse : Institut Supérieur d'arts et métiers de Gafsa</span><br>
                                <span>Route de Tozeur, Sidi Ahmed Zarroug Gafsa - Tunisie</span><br>
                                <span>Tél. : 76 211 107 / Fax : 76 211 108</span>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            @endif
                    

            @if ($demand->type=='شهادة عمل' && $demand->langue=='ar')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="60px" alt="isam"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                        <SPAN class="headerTextAr">المعهد العالي للفنون</SPAN><BR>
                                        <SPAN class="headerTextAr"> والحرف بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemandeTravail"><h3><b>{{ $demand->type }}</b> </h3></center><br>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">

                                        @if ($signature == 'Directeur')
                                            <h4>يشهد (*) : مدير المعهد العالي للفنون والحرف بقفصة أن</h4><br>
                                        @else
                                            <h4>يشهد (*) : الكاتب العام المعهد العالي للفنون والحرف بقفصة أن</h4><br>
                                        @endif

                                        <img src="{{ asset('upload/tag-demande-attestationTravail.png') }}" class="tagIssat" alt="issat">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td width="36%"><span>السيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar.' '.$demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>صاحب المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>رقم ب ت و</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->cin }}</label></td>
                                            </tr>
                                            <tr>
                                                <td><span> تاريخ الولادة ومكانها</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->ddn.' '.$demand->personnel->gov_ar }}</label></td>
                                            </tr>
                                            {{--  <tr>
                                                <td><span>مكان الولادة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->gov }}</label></td>
                                            </tr> --}}
                                            <tr>
                                                <td><span>رتبته أو صنفه</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ explode("/", $demand->personnel->grade)[1] }}</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>خطته الوظيفية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->personnel->poste)
                                                    <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td>
                                                @else
                                                    <td>--</label></td>
                                                @endif
                                            </tr>
                                        </table>
                                        <br>
                                        <span>يعمل حاليا ب : المعهد العالي للفنون والحرف بقفصة</span><br>
                                        <span>   .سلمت هذه الشهادة بطلب منه (ا) للإدلاء بها لدى من يهمه الأمر</span><br>
                                        
                                        <div class="signatureAr">
                                            <center>
                                                <span> حرر بقفصة في : {{date('Y-m-d', strtotime($demand->created_at))}}</span><br>

                                                @if ($signature == 'Directeur')
                                                    <span>المدير(ة)</span><br>
                                                    <span>{{ $variables[0]->directeur_ar }}</span><br><br><br><br><br><br>
                                                @else
                                                    <span>الكاتب العام</span><br>
                                                    <span>{{ $variables[0]->secretaire_ar }}</span><br><br><br><br><br><br>
                                                @endif

                                            </center>
                                        </div>
                                        
                                    </div>
                                </div>
                                <span style="border-top: 2px solid black; float: right;">(*) أذكر الصفة</span>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice-footer">
                            <hr class="new1">
                            <span>العنوان : المعهد العالي للفنون والحرف بقفصة</span><br/>
                            <span>طريق توزر سيدي أحمد زروق 2112 قفصة</span><br/>
                            <span>76211108 : </span> <span>الهاتف</span> <span>: 76211107 </span> <span> الفاكس</span> 
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($demand->type == 'تغيير حساب جاري')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="60px" alt="isam"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                        <SPAN class="headerTextAr">المعهد العالي للفنون</SPAN><BR>
                                        <SPAN class="headerTextAr"> والحرف بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemandeOneLine"><h3><b>الى السيّد رئيس جامعة قفصة</b> </h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td width="36%"><span style="border-bottom: 2px solid black;">الموضوع</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>طلب تغيير حساب جاري (*)</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>صاحب المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>الإسم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>اللقب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            {{-- <tr>
                                                <td><span>رتبته أو صنفه</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->grade }}</label></td>
                                            </tr> --}}
                                            <tr>
                                                <td><span>خطته الوظيفية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->personnel->poste)
                                                    <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td>
                                                @else
                                                    <td>--</label></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>المؤسسة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>المعهد العالي للفنون والحرف بقفصة</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>رقم الحساب القديم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->ancien_compte }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>رقم الحساب الجديد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->nouveau_compte }}</label></td>
                                            </tr>
                                        </table>
                                        <br> <br>
                                        <div class="signatureAdr">
                                                <span style="float:left; padding-left: 20% !important;"> الإمضاء</span><br><br> <br> <br><br><br>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="documents">
                                    <div class="col-xs-11">
                                        <table style="float: right; border-top: 1px solid black; text-align: right;">
                                            <tr>
                                                <td><h5>معرف الهوية البنكية -</h5></td>
                                                <td><h4>: الوثائق المصاحبة <b>*</b></h4></td>
                                            </tr>
                                            <tr>
                                                <td><h5>شهادة رفع ياد -</h5></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-xs-1"></div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice-footer">
                            <hr class="new1">
                            <span>العنوان : المعهد العالي للفنون والحرف بقفصة</span><br/>
                            <span>طريق توزر سيدي أحمد زروق 2112 قفصة</span><br/>
                            <span>76211108 : </span> <span>الهاتف</span> <span>: 76211107 </span> <span> الفاكس</span> 
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($demand->type == 'توطين حساب جاري')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="60px" alt="isam"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                        <SPAN class="headerTextAr">المعهد العالي للفنون</SPAN><BR>
                                        <SPAN class="headerTextAr"> والحرف بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemandeOneLine"><h3><b>الى السيّد رئيس جامعة قفصة</b> </h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td width="36%"><span style="border-bottom: 2px solid black;">الموضوع</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>طلب توطين حساب جاري (*)</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>صاحب المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>الإسم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>اللقب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            {{-- <tr>
                                                <td><span>رتبته أو صنفه</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->grade }}</label></td>
                                            </tr> --}}
                                            <tr>
                                                <td><span>خطته الوظيفية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->personnel->poste)
                                                    <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td>
                                                @else
                                                    <td>--</label></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>المؤسسة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>المعهد العالي للفنون والحرف بقفصة</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>رقم الحساب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->ancien_compte }}</label></td>
                                            </tr>
                                        </table>
                                        <br> <br>
                                        <div class="signatureAdr">
                                                <span style="float:left; padding-left: 20% !important;"> الإمضاء</span><br><br><br><br> <br> <br><br><br>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="documents">
                                    <div class="col-xs-11">
                                        <table style="float: right; border-top: 1px solid black; text-align: right;">
                                            <tr>
                                                <td>
                                                    <h5>معرف الهوية البنكية -</h5>
                                                    <h5>شهادة رفع ياد -</h5>
                                                    <h5>  مطلب توطين أجر -</h5>
                                                </td>
                                                <td colspan="3"><h4>: الوثائق المصاحبة <b>*</b></h4></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-xs-1"></div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="invoice-footer">
                            <br>
                            <hr class="new1">
                            <span>العنوان : المعهد العالي للفنون والحرف بقفصة</span><br/>
                            <span>طريق توزر سيدي أحمد زروق 2112 قفصة</span><br/>
                            <span>76211108 : </span> <span>الهاتف</span> <span>: 76211107 </span> <span> الفاكس</span> 
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($demand->type == 'حجز الاداء على الدخل')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="60px" alt="isam"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                        <SPAN class="headerTextAr">المعهد العالي للفنون</SPAN><BR>
                                        <SPAN class="headerTextAr"> والحرف بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemandeOneLine"><h3><b>الى السيّد رئيس جامعة قفصة</b> </h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td width="36%"><span style="border-bottom: 2px solid black;">الموضوع</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>طلب شهادة حجز الأداء على الدخل.</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>صاحب المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>الإسم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>اللقب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            {{-- <tr>
                                                <td><span>رتبته أو صنفه</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->grade }}</label></td>
                                            </tr> --}}
                                            <tr>
                                                <td><span>خطته الوظيفية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->personnel->poste)
                                                    <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td>
                                                @else
                                                    <td>--</label></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>المؤسسة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>المعهد العالي للفنون والحرف بقفصة</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>السنة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->years }}</label></td>
                                            </tr>
                                        </table>
                                        <br> <br>
                                        <div class="signatureAdr">
                                                <span style="float:left; padding-left: 20% !important;"> الإمضاء</span><br><br><br><br><br><br><br><br><br> <br> <br><br><br>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="invoice-footer">
                            <br>
                            <hr class="new1">
                            <span>العنوان : المعهد العالي للفنون والحرف بقفصة</span><br/>
                            <span>طريق توزر سيدي أحمد زروق 2112 قفصة</span><br/>
                            <span>76211108 : </span> <span>الهاتف</span> <span>: 76211107 </span> <span> الفاكس</span> 
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($demand->type == 'بطاقة خلاص')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="60px" alt="isam"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                        <SPAN class="headerTextAr">المعهد العالي للفنون</SPAN><BR>
                                        <SPAN class="headerTextAr"> والحرف بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemandeOneLine"><h3><b>الى السيّد رئيس جامعة قفصة</b> </h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td width="36%"><span style="border-bottom: 2px solid black;">الموضوع</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>طلب بطاقة خلاص.</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>صاحب المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>الإسم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>اللقب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            {{-- <tr>
                                                <td><span>رتبته أو صنفه</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->grade }}</label></td>
                                            </tr> --}}
                                            <tr>
                                                <td><span>خطته الوظيفية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->personnel->poste)
                                                    <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td>
                                                @else
                                                    <td>--</label></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>المؤسسة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>المعهد العالي للفنون والحرف بقفصة</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>بطاقة خلاص باللغة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->langue == 'ar')
                                                    <td width="64%">
                                                        <input type="checkbox" checked> <label>العربية</label> <br>
                                                        <input type="checkbox"> <label>الفرنسية</label> 
                                                    </td>
                                                @else
                                                    <td width="64%">
                                                        <input type="checkbox"> <label>العربية</label> <br>
                                                        <input type="checkbox" checked> <label>الفرنسية</label> 
                                                    </td>

                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>عدد الأشهر</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->nombre_mois }}</label></td>
                                            </tr>
                                        </table>
                                        <br> <br>
                                        <div class="signatureAdr">
                                                <span style="float:left; padding-left: 20% !important;"> الإمضاء</span><br><br><br><br> <br> <br><br><br>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="invoice-footer">
                            <br>
                            <hr class="new1">
                            <span>العنوان : المعهد العالي للفنون والحرف بقفصة</span><br/>
                            <span>طريق توزر سيدي أحمد زروق 2112 قفصة</span><br/>
                            <span>76211108 : </span> <span>الهاتف</span> <span>: 76211107 </span> <span> الفاكس</span> 
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($demand->type == 'شهادة في الاجر')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="60px" alt="isam"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                        <SPAN class="headerTextAr">المعهد العالي للفنون</SPAN><BR>
                                        <SPAN class="headerTextAr"> والحرف بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemandeOneLine"><h3><b>الى السيّد رئيس جامعة قفصة</b> </h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td width="36%"><span style="border-bottom: 2px solid black;">الموضوع</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>طلب شهادة في الاجر.</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>صاحب المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>الإسم واللقب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar.' '.$demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            {{-- <tr>
                                                <td><span>رتبته أو صنفه</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->grade }}</label></td>
                                            </tr> --}}
                                            <tr>
                                                <td><span>خطته الوظيفية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->personnel->poste)
                                                    <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td>
                                                @else
                                                    <td>--</label></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>المؤسسة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>المعهد العالي للفنون والحرف بقفصة</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>شهادة في الاجر باللغة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->langue == 'ar')
                                                    <td width="64%">
                                                        <input type="checkbox" checked> <label>العربية</label> <br>
                                                        <input type="checkbox"> <label>الفرنسية</label> 
                                                    </td>
                                                @else
                                                    <td width="64%">
                                                        <input type="checkbox"> <label>العربية</label> <br>
                                                        <input type="checkbox" checked> <label>الفرنسية</label> 
                                                    </td>

                                                @endif
                                            </tr>
                                        </table>
                                        <br> <br>
                                        <div class="signatureAdr">
                                                <span style="float:left; padding-left: 20% !important;"> الإمضاء</span><br><br><br><br><br><br><br><br><br> <br> <br><br><br>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="invoice-footer">
                            <br>
                            <hr class="new1">
                            <span>العنوان : المعهد العالي للفنون والحرف بقفصة</span><br/>
                            <span>طريق توزر سيدي أحمد زروق 2112 قفصة</span><br/>
                            <span>76211108 : </span> <span>الهاتف</span> <span>: 76211107 </span> <span> الفاكس</span> 
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{------------------------------ مطلب للحصول على قائمة في الخدمات -----------------------------------}}
            @if ($demand->type == 'حصول على قائمة في الخدمات')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-isam.png') }}" width="60px" alt="isam"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar"> المعهد العالي</SPAN><BR>
                                        <SPAN class="headerTextAr"> للعلوم التطبيقية </SPAN><BR>
                                        <SPAN class="headerTextAr"> و التكنولوجيا بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemande"><h3><b>مطلب للحصول على قائمة في الخدمات (*)</b> </h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td><span>صاحب المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>الإسم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>اللقب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>تاريخ و مكان الولادة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->ddn.'-'.$demand->personnel->gov }}</label></td>
                                            </tr>
                                            {{-- <tr>
                                                <td><span>رتبته أو صنفه</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->grade }}</label></td>
                                            </tr> --}}
                                            <tr>
                                                <td width="36%"><span>المؤسسة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>المعهد العالي للفنون والحرف بقفصة</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>خطته الوظيفية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->personnel->poste)
                                                    <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td>
                                                @else
                                                    <td>--</label></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>تاريخ الإنتداب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%">
                                                    @if ($demand->personnel->date_recrutement)
                                                        <label>{{ $demand->personnel->date_recrutement }}</label>
                                                    @else
                                                        <label>..........................</label>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>تاريخ الترسيم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%">
                                                    <label>..........................</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>أخر شهادة علمية <br> متحصل عليها (**)</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->grade }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>السبب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->raison }}</label></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <div class="signatureAdr">
                                            <span style="float:left; padding-left: 20% !important;"> قفصة في : {{date('Y-m-d', strtotime($demand->created_at))}} <br>
                                            <span style="padding-right: 30% !important;"> الإمضاء</span><br><br> <br> <br><br>                                            </span><br>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="invoice-footer" style="text-align: right !important;">
                            <br>
                            <table style="border-top: 2px solid black; direction: rtl; float: right;">
                                <tr>
                                    <td>
                                        <span>(*) يوجه مطلب الحصول على قائمة في الخدمات الى مصالح جامعة قفصة عن طريق التسلسل الإداري.</span><br/>
                                        <span>(**) يرفق المطلب بنسخة مطابقة للأصل من اخر شهادة علمية متحصل عليها (في صورة الحصول على شهادة علمية بعد الشهادة المنتدب بها) .</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($demand->type=='إعــــلام بإستئناف عمل')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-issat.png') }}" width="60px" alt="issat"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                        <SPAN class="headerTextAr">المعهد العالي للفنون</SPAN><BR>
                                        <SPAN class="headerTextAr"> والحرف بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemande"><h3><b>{{ $demand->type }}</b> </h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">
                                        <h4>: إني الممضي أسفله</h4><br>
                                        <img src="{{ asset('upload/tag-demande-attestationTravail.png') }}" class="tagIssat" alt="issat">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td width="36%"><span>السيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar.' '.$demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>الإسم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>اللقب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td><span> الرتبة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                @if ($demand->personnel->poste)
                                                    <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td>
                                                @else
                                                    <td>--</label></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>مركز العمل</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>المعهد العالي للفنون والحرف بقفصة</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>إستئنفت العمل يوم</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ date('Y-m-d', strtotime($demand->dateRepriseTravail)) }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>بعد إنتهاء العطلة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->VacanceType }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>التي منحت لي من</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ date('Y-m-d', strtotime($demand->date_debut_vacance)).' إلى '.date('d-m-Y', strtotime($demand->date_fin_vacance)) }}</label></td>
                                            </tr>
                                        </table>
                                        <br><br>
                                        
                                        <table style="width: 100%;">
                                            <tr>
                                                <td width="30%">
                                                    <span> قفصة في : {{date('Y-m-d', strtotime($demand->created_at))}}</span><br>
                                                    <span>إمضاء الرئيس المباشر</span><br><br><br><br><br>
                                                </td>
                                                <td  width="40%"></td>
                                                <td  width="30%">
                                                    <br>
                                                    <span>إمضاء العون</span>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice-footer">
                            <hr class="new1">
                            <span>العنوان : المعهد العالي للفنون والحرف بقفصة</span><br/>
                            <span>طريق توزر سيدي أحمد زروق 2112 قفصة</span><br/>
                            <span>76211108 : </span> <span>الهاتف</span> <span>: 76211107 </span> <span> الفاكس</span> 
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($demand->type == 'طلب تكوين')
            <div class="container invoice">
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <table width="100%">
                                <tr  align="center" style="margin-right:10%;">
                                    <td width="45%"><img src="{{ asset('upload/logo-issat.png') }}" width="60px" alt="issat"><br></td>
                                    <td width="10%"></td>
                                    <td width="45%"><img src="{{ asset('upload/republiqueTunisienne.png') }}" width="50px" alt="republiqueTunisienne"><br></td>
                                </tr>
                                <tr align="center">
                                    <td>
                                        <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                        <SPAN class="headerTextAr">المعهد العالي للفنون</SPAN><BR>
                                        <SPAN class="headerTextAr"> والحرف بقفصة</SPAN><BR>
                                    </td>
                                    <td></td>
                                    <td>
                                        <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                        <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                        <SPAN class="headerTextAr">و البحث العلمي</SPAN><BR>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <center class="titreDemande"><h3><b>{{ $demand->type }}</b> </h3></center>
                        </div>
                        <div class="col-xs-12">
    
                        </div>
                        <div class="col-xs-12">                        
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-11 labelAr" style="text-align:right !important;">
                                        <h4>: إني الممضي أسفله</h4><br>
                                        <img src="{{ asset('upload/tag-demande-attestationTravail.png') }}" class="tagIssat" alt="issat">
                                        <table style="width: 100%; direction: rtl">
                                            <tr>
                                                <td width="36%"><span>السيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->personnel->prenom_ar.' '.$demand->personnel->nom_ar }}</label></td>
                                            </tr>
                                            <tr>
                                                <td><span>المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>عنوان الدورة التكوينية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->nom_formation }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>المكان</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->lieu_formation }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>الثمن</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->prix_formation }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>هيكل التكوين</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ $demand->structure_formation }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>فترة التكوين من</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ date('Y-m-d', strtotime($demand->date_debut_formation)) }}</label></td>
                                            </tr>
                                            <tr>
                                                <td width="36%"><span>إلى</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                                <td width="64%"><label>{{ date('Y-m-d', strtotime($demand->date_fin_formation)) }}</label></td>
                                            </tr>
                                        </table>
                                        <br><br>
                                        
                                        <table style="width: 100%;">
                                            <tr>
                                                <td width="30%">
                                                    <span> قفصة في : {{date('Y-m-d', strtotime($demand->created_at))}}</span><br>
                                                    <span>إمضاء الرئيس المباشر</span><br><br><br><br><br>
                                                </td>
                                                <td  width="40%"></td>
                                                <td  width="30%">
                                                    <br>
                                                    <span>إمضاء العون</span>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-1">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="invoice-footer">
                            <hr class="new1">
                            <span>العنوان : المعهد العالي للفنون والحرف بقفصة</span><br/>
                            <span>طريق توزر سيدي أحمد زروق 2112 قفصة</span><br/>
                            <span>76211108 : </span> <span>الهاتف</span> <span>: 76211107 </span> <span> الفاكس</span> 
                        </div>
                    </div>
                </div>
            </div>
            @endif

                    @php
                        $fileName= $demand->personnel->nom.$demand->personnel->prenom.$demand->type ;
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
    {{-- <div class="col-md-6 text-right mb-3">
        <button id="printPageButton2" class="btn btn-primary"> 
            Télécharger pdf
        </button>
    </div> --}}
    <br>
    <center>
        <button id="printPageButton" class="btn btn-primary" style="background-color: #21a594;" onClick="window.print();" class="noPrint">
            Imprimer
        </button>
    </center>
    <br>
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