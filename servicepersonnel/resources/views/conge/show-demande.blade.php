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
    width: 40px;
    position: absolute;
    float: right;
    margin-left: 4%;
}

.smallText{
  font-size: 11px !important;
}

/* Apply this to your `table` element. */
#page {
  border-collapse: collapse !important;
}

/* And this to your table's `td` elements. */
#page td {
  padding: 0 !important; 
  margin: 0 !important;
}
table { 
  border-spacing: 0 !important;
  border-collapse: collapse !important;
}
</style>
<div id="printme" class="container d-flex justify-content-center">

    @foreach ($conges as $demand)

    <div class="container invoice2">
        <div class="invoice-body">
            <div class="row">
                <div class="col-xs-12">
                    <table width="100%">
                        <tr  align="center" style="margin-right:10%;">
                            <td width="45%"><br></td>
                            <td width="10%"></td>
                            <td width="45%"></td>
                        </tr>
                        <tr align="center">
                            <td>
                                <SPAN class="headerText1Ar">جامعة قفصة</SPAN><BR>
                                <SPAN class="headerText1Ar">المعهد العالي للفنون  </SPAN><BR>
                                <SPAN class="headerTextAr">والحرف بقفصة</SPAN>
                            </td>
                            <td></td>
                            <td>
                                <SPAN class="headerText1Ar">الجمهورية التونسية</SPAN><BR>
                                <SPAN class="headerTextAr">وزارة التعليم العالي</SPAN><BR>
                                <SPAN class="headerTextAr">و البحث العلمي</SPAN>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-12">
                    <center class="titreDemande"><h3><b>مطلب عطلة <span class="smallText">(1)</span></b> </h3></center>
                </div>
                <div class="col-xs-12">

                </div>
                <div class="col-xs-12">                        
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-11 " style="text-align:right !important;">
                              <table style="width: 100%; direction: rtl">
                                <tr>
                                  @if ($demand->categorie->nom == 'عطلة سنوية')
                                    <td width="34%"><input type="checkbox" checked> <span>عطلة استراحة سنوية</span>  </td>
                                  @else
                                    <td width="34%"><input type="checkbox"> <span>عطلة استراحة سنوية</span>  </td>
                                  @endif
                                  <td width="66%"></td>
                                </tr>
                                <tr>
                                  @if ($demand->categorie->nom == 'عطلة استثنائية')
                                    <td><input type="checkbox" checked> <span>عطلة إستثنائية, موجبها :</span></td>
                                  @else
                                    <td><input type="checkbox"> <span>عطلة إستثنائية, موجبها :</span></td>
                                  @endif
                                  <td><label>...........................................................................</label></td>
                                </tr>
                                <tr>
                                  @if ($demand->categorie->nom == 'عطلة مرض')
                                    <td><input type="checkbox" checked> <span>عطلة لأسباب صحية <span class="smallText">(2)</span></span> </td>
                                  @else
                                    <td><input type="checkbox"> <span>عطلة لأسباب صحية <span class="smallText">(2)</span></span> </td>
                                  @endif
                                  <td>
                                    <table style="width: 100%; direction: rtl">
                                      <tr>
                                        <td><span>مرض</span> <input type="checkbox"></td>
                                        <td><span>ولادة</span> <input type="checkbox"></td>
                                        <td><span>أمومة</span> <input type="checkbox"></td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                <tr>
                                  @if ($demand->categorie->nom == 'عطلة تعويضية')
                                    <td><input type="checkbox" checked> <span>عطلة تعويضية</span> </td>
                                  @else
                                    <td><input type="checkbox"> <span>عطلة تعويضية</span> </td>
                                  @endif
                                  <td></td>
                                </tr>
                              </table>
                              <br>
                              <img src="{{ asset('upload/tag-demande-attestationTravail-vacance.png') }}" class="tagIssat" alt="issat">

                              @foreach ($personnels as $element)
                                <table id="page" style="width: 100%; direction: rtl">
                                    <tr>
                                        <td><span>صاحب المعرف الوحيد</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                        <td><label>{{ $demand->personnel->mat_cnrps }}</label></td>
                                    </tr>
                                    <tr>
                                        <td width="36%"><span>الإسم واللقب</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                        <td width="64%"><label>{{ $demand->personnel->prenom_ar.' '.$demand->personnel->nom_ar }}</label></td>
                                    </tr>
                                    <tr>
                                        <td><span>خطته الوظيفية</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                        {{-- <td><label>{{ explode("/", $demand->personnel->poste)[1] }}</label></td> --}}
                                        <td><label>{{ $demand->personnel->poste }}</label></td>
                                    </tr>
                                    <tr>
                                      <td><span>الهيكل الإداري</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                      <td><label>...........................................................................</label></td>
                                    </tr>
                                    <tr>
                                      <td><span>المصلحة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                      <td><label>...........................................................................</label></td>
                                    </tr>
                                    <tr>
                                        <td width="36%"><span>مركز العمل</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                        <td width="64%"><label>المعهد العالي للفنون والحرف بقفصة</label></td>
                                    </tr>
                                    <tr>
                                      <td><span>المدة المطلوبة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                      <td>
                                        @if ($demand->duree == '1')
                                          <label>{{ $demand->duree.'  يوم' }}</label>
                                        @else
                                          <label>{{ $demand->duree.'  أيام' }}</label>
                                        @endif
                                      </td>
                                    </tr>
                                    <tr>
                                      <td><span>عنوان مقر السكنى <br> طيلة العطلة<span class="smallText">(3)</span></span><span style="float: left; margin-left: 20%;">:</span> </td>
                                      <td><label>...........................................................................</label></td>
                                    </tr>
                                    <tr>
                                      <td><span>الترقيم البريدي</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                      <td><label>...........................................................................</label></td>
                                    </tr>
                                    <tr>
                                      <td><span>الوثائق المصاحبة</span><span style="float: left; margin-left: 20%;">:</span> </td>
                                      <td><label>...........................................................................</label></td>
                                    </tr>
                                </table>
                                @endforeach
                                <br><br>
                                <table style="width: 100%;">
                                  <tr>
                                    <td style="width: 50%; text-align: center;">
                                      <span> قفصة في : {{date('d-m-Y')}} <br>
                                      <span>إمضاء طالب العطلة</span>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                      <span>ملاحظة الرئيس المباشر</span><br>
                                      <span>........................</span><br>
                                      <span> قفصة في : {{date('d-m-Y')}} <br>
                                      <span>الإمضاء و الختم</span><br><br><br><br><br>
                                      <span>....................... المعوض(ة)</span> <span class="smallText">(4)</span>
                                    </td>
                                  </tr>
                                </table>
                                
                            </div>
                        </div>
                        <div class="col-xs-1">
                        </div>
                    </div>
                </div>
                
                <div class="invoice-footer">
                    <br>
                    <table style="width: 100%; border-top: 2px solid black; direction: rtl; float: right;">
                      <tr>
                        <td>
                          <span>(1)</span> <span> توضع علامة (x) الخانة المناسبة  </span><br/>
                          <span>(2)</span> <span> يرفق المطلب بالوثائق المدعمة</span><br/>
                          <span>(3)</span> <span> إحرص على ذكر عنوان مقر إقامتك و إلا اعتبر مطلبك ملغى </span><br/>
                          <span>(4)</span> <span> عند الموافقة ذكر المعوض</span>
                        </td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endforeach

      </div>
  </div>
  <!-- partial -->
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