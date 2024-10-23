
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Inscription Universitaire')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
  </div><!-- /.container-fluid -->
</div>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css'>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="{{ URL::asset('css/myStyle.css') }}" /> 
<style>
#regForm {
  background-color: #ffffff;
  margin: 20px auto;
  padding: 40px;
  width: 80%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 15px;
  width: 100%;
  font-size: 15px;
  border: 1px solid #cfcfcf;
  border-radius: 12px;
}

select {
  padding: 15px;
  width: 100%;
  font-size: 15px;
  border: 1px solid #cfcfcf;
  border-radius: 12px;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
  padding: 15px;
  width: 100%;
  font-size: 15px;
  border: 1px solid #c73a3a;
  border-radius: 12px;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}

.labelright {
    display: inline-block;
    text-align: right;
    float: right !important;
}
/*        Hover icon image      */
.image-div {
    position: relative;
    float:left;
    margin:5px;}

.image-div:hover .hidden_img
  {
  display: block;
  }

.image-div .hidden_img {
    position:absolute;
    top:0;
    left:0;
    display:none;
}

.fa-question-circle {
    color:brown;
    width: 20px;
    top: -5px !important;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    margin-top: 0.3em;
    margin-left: 1em; 
    position: relative;
}
.titleToLogin{
    text-decoration:none;
    color: #000;
}

.fontfamilyinput{
    font-family: 'poppins', sans-serif !important;
}
.checkboxStyle{
    padding-top: 5px;
    padding-bottom: 5px;
}
table tr {
    border-bottom: 1px solid #ccc;
}
.custom-control {
    margin-bottom: 25px !important;
    margin-top: 25px !important;
}
</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <center>
                        <a class="titleToLogin" href="{{ url('#') }}" class="btn btn-primary text-center"> 
                            <h5>Fiche de renseignements pour l'inscription</h5>
                            <h5>بطاقة إرشادات خاصة بالترسيم الجامعي</h5>
                            <h6>Année Universitaire 2022/2023</h6>
                        </a>
                    </center>
                    <a href="{{ url('login') }}" class="btn btn-secondary text-left"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form action="{{ url('inscription-new') }}" id="regForm" method="POST" onsubmit="return confirm('Confirmation!')" class="register-wizard-box" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PUT') --}}

                       

<!-- Etape 55 -->
<div class="tab">
    <h5>Type d'inscription</h5>
    <h4> نوعية الترسيم</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-2">

                    </div>
                </div>    

                <table width="100%">
                    <tr style="text-align: right">
                        <td> 
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input radio" id="checkboxLicence" name="type_inscription" value="إجازة ثانية">
                            <label class="custom-control-label" for="checkboxLicence">إجازة ثانية</label>
                          </div>
                        </td> 
                        <td> 
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input radio" id="checkboxInscritExcep" name="type_inscription" value="ترسيم إستثنائي">
                              <label class="custom-control-label" for="checkboxInscritExcep">ترسيم إستثنائي</label>
                            </div>
                        </td>  
                        <td> 
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input radio" id="checkboxReintegration" name="type_inscription" value="true">
                              <label class="custom-control-label" for="checkboxReintegration">إعادة إدماج</label>
                            </div>
                          </td>                        
                    </tr>
                    
                      <tr style="text-align: right">
                        <td> 
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input radio" id="checkboxReorientation" name="type_inscription" value="إعادة توجيه">
                            <label class="custom-control-label" for="checkboxReorientation">إعادة توجيه</label>
                          </div>
                        </td>   
                        <td> 
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input radio" id="checkboxMutation" name="type_inscription" value="نقلة">
                              <label class="custom-control-label" for="checkboxMutation">نقلة</label>
                            </div>
                        </td> 
                        <td> 
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input radio" id="checkboxRedoublant" name="type_inscription" value="راسب">
                              <label class="custom-control-label" for="checkboxRedoublant">راسب</label>
                            </div>
                          </td>                        
                      </tr>
                      <tr style="text-align: right">
                        <td colspan="3"> 
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input radio" id="checkboxnew" name="type_inscription" value="جديد">
                            <label class="custom-control-label" for="checkboxnew">جديد</label>
                          </div>
                        </td>                           
                      </tr>
                </table>

                <div class="col-lg-12">
                    <div class="row">
                        {{-- <div class="col-md-2">
                                <input type="checkbox" id="checkboxLicence" class="radio" name="type_inscription[1][]" value="إجازة ثانية">
                            <b class="labelright">إجازة ثانية</b>
                        </div> --}}
                        {{-- <div class="col-md-2">
                            <input type="checkbox" id="checkboxInscritExcep" class="radio" name="type_inscription[1][]" value="ترسيم إستثنائي">
                            <b class="labelright">ترسيم إستثنائي</b>
                        </div> --}}
                        {{-- <div class="col-md-2">
                            <input type="checkbox" id="checkboxReintegration" class="radio" name="type_inscription[1][]" value="true">
                            <b class="labelright">إعادة إدماج</b>
                        </div> --}}
                        {{-- <div class="col-md-2">
                            <input type="checkbox" id="checkboxReorientation" class="radio" name="type_inscription[1][]" value="إعادة توجيه">
                            <b class="labelright">إعادة توجيه</b>
                        </div> --}}
                        {{-- <div class="col-md-2">
                            <input type="checkbox" id="checkboxMutation" class="radio" name="type_inscription[1][]" value="نقلة">
                            <b class="labelright">نقلة</b>
                        </div> --}}
                        {{-- <div class="col-md-2">
                            <input type="checkbox" id="checkboxRedoublant" class="radio" name="type_inscription[1][]" value="راسب">
                            <b class="labelright">راسب</b>
                        </div> --}}
                        {{-- <div class="col-md-2">
                            <input type="checkbox" id="checkboxnew" name="type_inscription[1][]" class="radio" value="جديد">
                            <b class="labelright">جديد</b>
                        </div> --}}
                    </div>
                </div>


                    <div class="col-lg-12" style="text-align:left !important;">      
                        <div id="FormLicence" style="display:none; margin-top:4%">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h6 class="labelright">الوثائق المطلوبة</h6><br><br>
                                    <div class="row" style="">
                                        <div class="form-group col-md-6">
                                            <label class="labelright">بطاقة أعداد السنة الفارطة</label>
                                            <p>
                                                <input type="file" id="derniere_relevee_file" class="form-control" name="derniere_relevee_file">
                                            </p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="labelright">بطاقة تعيين</label>
                                            <p>
                                                <input type="file" id="mutation_file" class="form-control" name="mutation_file" >
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12" style="text-align:left !important;">
                        <div id="FormInscritExcep" style="display:none; margin-top:4%">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h6 class="labelright">الوثائق المطلوبة</h6><br><br>
                                    <div class="row" style="">
                                        <div class="form-group col-md-4">
                                            <label class="labelright">وصل خلاص التسجيل كاملاً</label>
                                            <p>
                                                <input type="file" id="recu_paiement_file" class="form-control" name="recu_paiement_file">
                                            </p>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="labelright">مطلب كتابي</label>
                                            <p>
                                                <input type="file" id="demande_ecrit__file" class="form-control" name="demande_ecrit__file">
                                            </p>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="labelright">بطاقة أعداد السنة الفارطة</label>
                                            <p>
                                                <input type="file" id="derniere_relevee_file" class="form-control" name="derniere_relevee_file">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div id="FormReintegration" style="display:none; margin-top:4%">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h6 class="labelright">الوثائق المطلوبة</h6><br><br>
                                    <div class="row" style="">
                                        <div class="form-group col-md-6"></div>
                                        <div class="form-group col-md-6">
                                            <label class="labelright">وثيقة إعادة ادماج</label>
                                            <p>
                                                <input type="file" id="reintegration_file" class="form-control" name="reintegration_file">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12" style="text-align:left !important;">      
                        <div id="FormReorientation" style="display:none; margin-top:4%">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h6 class="labelright">الوثائق المطلوبة</h6><br><br>
                                    <div class="row" style="">
                                        <div class="form-group col-md-6">
                                            <label class="labelright">بطاقة أعداد السنة الفارطة</label>
                                            <p>
                                                <input type="file" id="derniere_relevee_file" class="form-control" name="derniere_relevee_file">
                                            </p>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="labelright">وثيقة إعادة توجيه</label>
                                            <p>
                                                <input type="file" id="reorientation_file" class="form-control" name="reorientation_file">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12" style="text-align:left !important;">
                        <div id="FormMutation" style="display:none; margin-top:4%">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h6 class="labelright">الوثائق المطلوبة</h6><br><br>
                                    <div class="row" style="">
                                        <div class="form-group col-md-4">
                                            <label class="labelright">شهادة مغادرة</label>
                                            <p>
                                                <input type="file" id="sortie_file" class="form-control" name="sortie_file">
                                            </p>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="labelright">بطاقة تعيين</label>
                                            <p>
                                                <input type="file" id="mutation_file" class="form-control" name="mutation_file">
                                            </p>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="labelright">بطاقة أعداد السنة الفارطة</label>
                                            <p>
                                                <input type="file" id="derniere_relevee_file" class="form-control" name="derniere_relevee_file">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div id="FormRedoublant" style="display:none; margin-top:4%">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h6 class="labelright">الوثائق المطلوبة</h6><br><br>
                                    <div class="row" style="">
                                        <div class="form-group col-md-6"></div>
                                        <div class="form-group col-md-6">
                                            <label class="labelright">بطاقة أعداد السنة الفارطة</label>
                                            <p>
                                                <input type="file" id="derniere_relevee_file" class="form-control" name="derniere_relevee_file">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






            </div>
        </div>
    </div>
</div>
<!-- Etape 5 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-4">
                <div id="">
                    <label class="labelright">*(يخص الطالب الأجنبي) رقم جواز السفر</label>
                    <input id="passport" class="form-control" name="passport" placeholder="" oninput="this.className = 'other'">
                </div>
            </div>
            <div class="form-group col-md-4">
                <div id="">
                    <label class="labelright">رقم بطاقة التعريف الوطنية</label>
                    <input type="number" id="cin" class="form-control" name="cin" placeholder="" oninput="this.className = ''">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="labelright">Nationalité / جنسية الطالب</label>
                <p>
                    <select class="form-control" id="nationalite" name="nationalite" oninput="this.className = ''" required>
                        <option value="">إختر ...</option>
                        <option value="تونسية"> تونسي (ة)</option>
                        <option value="أجنببية"> Étranger(e)</option>
                    </select>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 1 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Prénom (en français)</label>
                <p><input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom étudiant" oninput="this.className = ''"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">الإسم(بالعربية)</label>
                <p><input type="text" class="form-control" id="prenom_ar" name="prenom_ar" placeholder="الإسم الشخصي للطالب"  oninput="this.className = ''" ></p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 2 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Nom (en français)</label>
                <p><input type="text" class="form-control" id="nom" name="nom" placeholder="Prénom étudiant" oninput="this.className = ''"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">اللقب(بالعربية)</label>
                <p><input type="text" class="form-control" id="nom_ar" name="nom_ar" placeholder="الإسم الشخصي للطالب"  oninput="this.className = ''" ></p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 3 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright">مكان الولادة</label>
                <p><input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" placeholder="" oninput="this.className = ''"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">تاريخ الولادة</label>
                <p><input type="date" class="form-control" id="ddn" name="ddn" placeholder="" oninput="this.className = ''" ></p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 4 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright">الحالة المدنية</label>
                <select class="form-control" id="etat_civil" name="etat_civil" oninput="this.className = ''" required>
                    <option value="">إختر ...</option>
                    <option value="أعزب / عزباء">Celibataire / أعزب / عزباء</option>
                    <option value="(ة) متزوج">Marié(e) / (ة) متزوج</option>
                    <option value="(ة) مطلق">Divorcé(e) / (ة) مطلق</option>
                    <option value="(ة) أرمل">Veuf(ve) / (ة) أرمل</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">الجنس</label>
                <select id="genre" class="form-control" name="genre" oninput="this.className = ''" required>
                    <option value="">إختر ...</option>
                    <option value="ذكر">Homme/ذكر</option>
                    <option value="أنثى">Femme/أنثى</option>
                </select>
            </div>
        </div>
    </div>
</div>
<!-- Etape 6 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright">مهنة الأب</label>
                <p><input type="text" id="profession_pere" class="form-control" name="profession_pere" placeholder="" oninput="this.className = ''"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">إسم الأب و لقبه</label>
                <p><input type="text" id="prenom_pere" class="form-control" name="prenom_pere" placeholder=""  oninput="this.className = ''" ></p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 7 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright">إسم الأم و لقبها</label>
                <p><input type="text" id="prenom_mere" class="form-control" name="prenom_mere" placeholder="" oninput="this.className = ''"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">رقم هاتف الولي</label>
                <p><input type="number" id="tel1" class="form-control" name="tel2_etudiant" placeholder="8 chiffres" placeholder=""  oninput="this.className = ''" ></p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 8 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright"> المعتمدية</label>
                <p>
                    <select id="municipality" class="form-control" name="municipality" oninput="this.className = ''">

                    </select>
                </p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">الولاية</label>
                <p>
                    <select id="gov" class="form-control" name="gov" oninput="this.className = ''">
                        <option value="" selected>إختر الولاية...</option>
                        <option value="أريانة">أريانة</option>
                        <option value="بن عروس">بن عروس</option>
                        <option value="باجة">باجة</option>
                        <option value="بنزرت">بنزرت</option>
                        <option value="قابس">قابس</option>
                        <option value="قفصة">قفصة</option>
                        <option value="جندوبة">جندوبة</option>
                        <option value="قبلي">قبلي</option>
                        <option value="الكاف">الكاف</option>
                        <option value="القيروان">القيروان</option>
                        <option value="مدنين">مدنين</option>
                        <option value="المهدية">المهدية</option>
                        <option value="المنستير">المنستير</option>
                        <option value="نابل">نابل</option>
                        <option value="صفاقس">صفاقس</option>
                        <option value="سليانة">سليانة</option>
                        <option value="سوسة">سوسة</option>
                        <option value="تطاوين">تطاوين</option>
                        <option value="توزر">توزر</option>
                        <option value="تونس">تونس</option>
                        <option value="زغوان">زغوان</option>
                        <option value="منوبة">منوبة</option>
                        <option value="القصرين">القصرين</option>
                        <option value="سيدي بوزيد">سيدي بوزيد</option>
                    </select>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 9 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-2">
                <label class="labelright">الترقيم البريدي</label>
                <p><input type="number" id="codepostal_etudiant" value="2100" class="form-control" name="codepostal_etudiant" placeholder="" oninput="this.className = ''"></p>
            </div>
            <div class="form-group col-md-5">
                <label class="labelright">العنوان باللغة الفرنسية</label>
                <p><input type="text" id="rue_etudiant" class="form-control" name="rue_etudiant" placeholder="Adresse (N et Rue)" placeholder=""  oninput="this.className = ''" ></p>
            </div>
            <div class="form-group col-md-5">
                <label class="labelright">العنوان</label>
                <p><input type="text" id="rue_etudiant_ar" class="form-control" name="rue_etudiant_ar" placeholder="الحي والشارع.." placeholder=""  oninput="this.className = ''" ></p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 10 -->
<div class="tab">
    <h5>Information Personnel</h5>
    <h4>معلومات شخصية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright">رقم هاتف الطالب</label>
                <p><input type="number" id="tel1" class="form-control" name="tel1_etudiant" placeholder="8 chiffres" placeholder=""  oninput="this.className = ''" ></p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">البريد الإلكتروني</label>
                <p><input type="email" id="email" class="form-control" name="email" placeholder="Exp. nometprenom@gmail.com" oninput="this.className = ''"></p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 11 -->
<div class="tab">
    <h5>Baccalauréat ou diplome équivalent</h5>
    <h4> البكالوريا أو مايعادلها</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright">الدورة</label>
                <p>
                    <select id="session_bac" class="form-control" name="session_bac" oninput="this.className = ''">
                        <option selected value="">إختر ...</option>
                        <option value="الرئيسية">Principale/الرئيسية</option>
                        <option value="التدارك">Controle/التدارك</option>
                    </select>
                </p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright"> الشعبة</label>
                <p>
                    <select id="section_bac" class="form-control" name="section_bac" oninput="this.className = ''">
                        <option value="" selected>إختر ...</option>
                        <option value="آداب">Lettres / آداب</option>
                        <option value="رياضيات">Mathématiques / رياضيات</option>
                        <option value="علوم تجريبية">Sciences exprimentales / علوم تجريبية</option>
                        <option value="إقتصاد وتصرف">Economie et Gestion / إقتصاد وتصرف</option>
                        <option value="تقنية">Technique / تقنية</option>
                        <option value="علوم إعلامية">Sciences informatique / علوم إعلامية</option>
                        <option value="أخرى">Autres / أخرى</option>
                    </select>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 12 -->
<div class="tab">
    <h5>Baccalauréat ou diplome équivalent</h5>
    <h4> البكالوريا أو مايعادلها</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright">السنة</label>
                <p><input type="number" id="annee_bac" class="form-control" name="annee_bac" min="1950" max="2050" step="1" value="2022" oninput="this.className = ''"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">المعدل</label>
                <p><input type="text" id="moyenne_bac" class="form-control" name="moyenne_bac" placeholder="Exp. 16.53" oninput="this.className = ''" ></p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 13 -->
<div class="tab">
    <h5>Institut Supérieur des Arts et Métiers de Gafsa</h5>
    <h4> المعهد العالي للفنون والحرف بقفصة</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="labelright">الشعبة</label>
                <select name="filiere" id="filiere" class="form-control" data-dependent="filiere" required>

                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="labelright">المستوى الدراسي</label>
                <select name="niveau" id="niveau" class="form-control" data-dependent="niveau" required>
                    <option value="" selected disabled>إختر المستوى</option>
                    <option value="سنة أولى إجازة">سنة أولى إجازة</option>
                    <option value="سنة ثانية إجازة">سنة ثانية إجازة</option>
                    <option value="سنة ثالثة إجازة">سنة ثالثة إجازة</option>
                    <option value="سنة أولى ماجستير">سنة أولى ماجستير</option>
                    <option value="سنة ثانية ماجستير">سنة ثانية ماجستير</option>
                  </select>
            </div>
        </div>
    </div>
</div>
<!-- Etape 14 -->
<div class="tab">
    <h5>Documents naicessaires <span style="color: brown;">format image (jpg, png)</span></h5>
    <h4>الوثائق المطلوبة</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-12">
                <div class="image-div">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <img class="hidden_img" src="image/import-photo.png" width="280" height="330" />
                </div>
                <label class="labelright">Photo de profil / الصورة الشخصية</label>
                <p>
                    <input type="file" id="profile_image" class="form-control obligatoirefichier" name="profile_image" oninput="this.className = ''">
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 15 -->
<div class="tab">
    <h5>Documents naicessaires <span style="color: brown;">format image (jpg, png)</span></h5>
    <h4>الوثائق المطلوبة</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-12">
                <div class="image-div">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <img class="hidden_img" src="image/import-cin.png" width="280" height="330" />
                </div>
                <label class="labelright">CIN (Face 1) /  بطاقة التعريف الوطنية الوجه الأول</label>
                <p>
                    <input type="file" id="cin_file" class="form-control obligatoirefichier" name="cin_file" oninput="this.className = ''">
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 16 -->
<div class="tab">
    <h5>Documents naicessaires <span style="color: brown;">format image (jpg, png)</span></h5>
    <h4>الوثائق المطلوبة</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-12">
                <div class="image-div">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <img class="hidden_img" src="image/import-cin-face2.png" width="280" height="330" />
                </div>
                <label class="labelright">CIN (Face 2) /  بطاقة التعريف الوطنية الوجه الثاني</label>
                <p>
                    <input type="file" id="cin_file_2" class="form-control obligatoirefichier" name="cin_file_2" oninput="this.className = ''">
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 17 -->
<div class="tab">
    <h5>Documents naicessaires <span style="color: brown;">format image (jpg, png)</span></h5>
    <h4>الوثائق المطلوبة</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-12">
                <div class="image-div">
                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                    <img class="hidden_img" src="image/import-cin-face2.png" width="280" height="330" />
                </div>
                <label class="labelright">Fiche de Paiement (inscription.tn) / وصل التسجيل عن بعد</label>
                <p>
                    <input type="file" id="paiement_file" class="form-control obligatoirefichier" name="paiement_file" oninput="this.className = ''">
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Etape 18 -->
<div class="tab">
    <h5>Dérnier étape</h5>
    <h4>مرحلة التسجيل النهائية</h4>
    <br><br>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group col-md-12">
                <p>
                    <label class="labelright">   <a href="#"  data-toggle="modal" data-target="#modal-default">شروط التسجيل </a>  في بطاقة إرشادات خاصة بالترسيم الجامعي     </label>
                </p>
            </div>
            {{-- <div class="form-group col-md-3">
                <p><input type="submit" class="btn btn-primary text-center" value="Finir"></p>
            </div> --}}
        </div>
    </div>
</div>


<div class="modal fade" id="modal-default" style="text-align: center">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title center">تأكيد المعطيات</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body center">
                <p>الرجاء التثبت من كل المعطيات لأنه سوف يتم ارسالها إلى قائمة البيانات مرة واحدة</p>
                <br><br>
                <label class="form-check-label" for="exampleCheck1">تأكيد <input type="checkbox" class="form-check-input" id="exampleCheck1"></label>
                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">رجوع</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


                            <div style="overflow:auto;">
                                <div style="float:right;">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Précédent</button>
                                <button type="button" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
                                </div>
                            </div>
                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center;margin-top:40px;">
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                            </div>

                            {{-- <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    {!! RecaptchaV3::field('inscription-new') !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}

                        </form> 
                                                

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

<script src="{{ URL::asset('js/municipality.js') }}"></script>
{{-- <script src="{{ URL::asset('js/type_inscrit.js') }}"></script> --}}
<script src="{{ URL::asset('js/script.js') }}"></script>
<script>
    $("input:checkbox").on('click', function() {
    var $box = $(this);
    if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }
    });
</script>

<script>
    //Nouveau
    var checkboxRedoublant = document.getElementById('checkboxRedoublant');
    //Redoublant
    var checkboxRedoublant = document.getElementById('checkboxRedoublant');
    var delivery_divRedoublant = document.getElementById('FormRedoublant');
    //Mutation
    var checkboxMutation = document.getElementById('checkboxMutation');
    var delivery_divMutation = document.getElementById('FormMutation');
    //Reorientation
    var checkboxReorientation = document.getElementById('checkboxReorientation');
    var delivery_divReorientation = document.getElementById('FormReorientation');
    //Reintegration
    var checkboxReintegration = document.getElementById('checkboxReintegration');
    var delivery_divReintegration = document.getElementById('FormReintegration');
    //InscritExcep
    var checkboxInscritExcep = document.getElementById('checkboxInscritExcep');
    var delivery_divInscritExcep = document.getElementById('FormInscritExcep');
    //Licence
    var checkboxLicence = document.getElementById('checkboxLicence');
    var delivery_divLicence = document.getElementById('FormLicence');

    checkboxRedoublant.onclick = function() {
        console.log(this);
       if(this.checked) {
        delivery_divRedoublant.style['display'] = 'block';
        delivery_divMutation.style['display'] = 'none';
        delivery_divReorientation.style['display'] = 'none';
        delivery_divReintegration.style['display'] = 'none';
        delivery_divInscritExcep.style['display'] = 'none';
        delivery_divLicence.style['display'] = 'none';
       } else {
        delivery_divRedoublant.style['display'] = 'none';
       }
    };

    checkboxMutation.onclick = function() {
        console.log(this);
       if(this.checked) {
        delivery_divMutation.style['display'] = 'block';
        delivery_divRedoublant.style['display'] = 'none';
        delivery_divReorientation.style['display'] = 'none';
        delivery_divReintegration.style['display'] = 'none';
        delivery_divInscritExcep.style['display'] = 'none';
        delivery_divLicence.style['display'] = 'none';
       } else {
        delivery_divMutation.style['display'] = 'none';
       }
    };

    checkboxReorientation.onclick = function() {
        console.log(this);
       if(this.checked) {
        delivery_divReorientation.style['display'] = 'block';
        delivery_divRedoublant.style['display'] = 'none';
        delivery_divMutation.style['display'] = 'none';
        delivery_divReintegration.style['display'] = 'none';
        delivery_divInscritExcep.style['display'] = 'none';
        delivery_divLicence.style['display'] = 'none';
       } else {
        delivery_divReorientation.style['display'] = 'none';
       }
    };


    checkboxReintegration.onclick = function() {
        console.log(this);
       if(this.checked) {
        delivery_divReintegration.style['display'] = 'block';
        delivery_divRedoublant.style['display'] = 'none';
        delivery_divMutation.style['display'] = 'none';
        delivery_divReorientation.style['display'] = 'none';
        delivery_divInscritExcep.style['display'] = 'none';
        delivery_divLicence.style['display'] = 'none';
       } else {
        delivery_divReintegration.style['display'] = 'none';
       }
    };

    checkboxInscritExcep.onclick = function() {
        console.log(this);
       if(this.checked) {
        delivery_divInscritExcep.style['display'] = 'block';
        delivery_divMutation.style['display'] = 'none';
        delivery_divReorientation.style['display'] = 'none';
        delivery_divReintegration.style['display'] = 'none';
        delivery_divRedoublant.style['display'] = 'none';
        delivery_divLicence.style['display'] = 'none';
       } else {
        delivery_divInscritExcep.style['display'] = 'none';
       }
    };

    checkboxLicence.onclick = function() {
        console.log(this);
       if(this.checked) {
        delivery_divLicence.style['display'] = 'block';
        delivery_divMutation.style['display'] = 'none';
        delivery_divReorientation.style['display'] = 'none';
        delivery_divReintegration.style['display'] = 'none';
        delivery_divRedoublant.style['display'] = 'none';
        delivery_divInscritExcep.style['display'] = 'none';
       } else {
        delivery_divLicence.style['display'] = 'none';
       }
    };
    checkboxnew.onclick = function() {
        console.log(this);
       if(this.checked) {
        delivery_divLicence.style['display'] = 'none';
        delivery_divMutation.style['display'] = 'none';
        delivery_divReorientation.style['display'] = 'none';
        delivery_divReintegration.style['display'] = 'none';
        delivery_divRedoublant.style['display'] = 'none';
        delivery_divInscritExcep.style['display'] = 'none';
       } 
    };

    

</script>

    <script>
        cin.oninput = function () {
            if (this.value.length > 8) {
                this.value = this.value.slice(7,8); 
            }
        }
    </script>
        <script>
        mynum.oninput = function () {
            if (this.value.length > 8) {
                this.value = this.value.slice(0,8); 
            }
        }
    </script>
    <script>
        codepostal_etudiant.oninput = function () {
            if (this.value.length > 4) {
                this.value = this.value.slice(0,4); 
            }
        }
    </script>
    <script>
        tel1.oninput = function () {
            if (this.value.length > 8) {
                this.value = this.value.slice(0,8); 
            }
        }
    </script>
    <script>
        tel2.oninput = function () {
            if (this.value.length > 8) {
                this.value = this.value.slice(0,8); 
            }
        }
    </script>
    <script>
        moyenne_bac.oninput = function () {
            if (this.value.length > 5) {
                this.value = this.value.slice(0,5); 
            }
        }
    </script>
    <script>
        annee_bac.oninput = function () {
            if (this.value.length > 4) {
                this.value = this.value.slice(0,4); 
            }
        }
    </script>
@endsection