
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Inscription Universitaire')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
  </div><!-- /.container-fluid -->
</div>

<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css'><link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="{{ URL::asset('css/myStyle.css') }}" />
<style>
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
</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <center>
                        <h4>Fiche de renseignements pour l'inscription</h4>
                        <h4>بطاقة إرشادات خاصة بالترسيم الجامعي</h4>
                        <h5>Année Universitaire 2022/2023</h5>
                    </center>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <!-- partial:index.partial.html -->
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="page-ath-wrap">
                                    <div class="page-ath-content register-form-content">
                                        <div class="page-ath-form">
                                            <div class="form-align-box">
                                                <div class="wizard">
                                                <div class="progress" Astyle="height: 30px;">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 20%;">
                                                        Etape 1 de 19
                                                        </div>
                                                    </div>
                                                    <form action="{{ url('inscription') }}" id="regForm" method="POST" onsubmit="return confirm('Confirmation!')" class="register-wizard-box" enctype="multipart/form-data">
                                                        @csrf
                                                        {{-- @method('PUT') --}}
                                                        <div class="tab-content" id="main_form">
                                                            <div class="tab-pane active" role="tabpanel" id="step1">
                                                                <div class="form-input-steps tab">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Prénom (en français)</label>
                                                                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom étudiant" required>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="labelright">الإسم(بالعربية)</label>
                                                                                <input type="text" class="form-control" id="prenom_ar" name="prenom_ar" placeholder="الإسم الشخصي للطالب" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" id="btnSubmit" onClick="validation(event)" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step2">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Nom (en français)</label>
                                                                                <input type="text" class="form-control" id="nom" onkeyup="checkNom(this)" name="nom" placeholder="Nom étudiant" required>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="labelright">اللقب(بالعربية)</label>
                                                                                <input type="text" class="form-control" id="nom_ar" name="nom_ar" placeholder="اللقب الشخصي للطالب" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- <input type="text" class="form-control" name="full_name" value="Ahmed Salhi" style="display: none"  required> --}}

                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" onClick="validatename(event)" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step3">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Lieu de naissance / مكان الولادة</label>
                                                                                <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" placeholder="" required>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="labelright">Date de naissance / تاريخ الولادة</label>
                                                                                <input type="date" class="form-control" id="ddn" name="ddn" placeholder="" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step4">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Etat civil / الحالة المدنية</label>
                                                                                <select class="form-control" id="etat_civil" name="etat_civil" required>
                                                                                    <option selected>Choisir...</option>
                                                                                    <option value="Celibataire">Celibataire / أعزب / عزباء</option>
                                                                                    <option value="Marié(e)">Marié(e) / (ة) متزوج</option>
                                                                                    <option value="Divorcé(e)">Divorcé(e) / (ة) مطلق</option>
                                                                                    <option value="Veuf(ve)">Veuf(ve) / (ة) أرمل</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="labelright">Genre / الجنس</label>
                                                                                <select id="genre" class="form-control" name="genre" required>
                                                                                    <option selected>Choisir...</option>
                                                                                    <option value="homme">Homme/ذكر</option>
                                                                                    <option value="femme">Femme/أنثى</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step5">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label class="labelright">Carte d'Identité Nationale / رقم بطاقة التعريف الوطنية</label>
                                                                                <input type="number" id="cin" class="form-control" name="cin" placeholder="" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step6">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label class="labelright">Nom et Prénom du père /  إسم الأب و لقبه</label>
                                                                                <input type="text" id="prenom_pere" class="form-control" name="prenom_pere" placeholder="" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step7">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label class="labelright">Nom et Prénom du mère /  إسم الأم و لقبها</label>
                                                                                <input type="text" id="prenom_mere" class="form-control" name="prenom_mere" placeholder="" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step8">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label class="labelright">Profession de père / مهنة الأب</label>
                                                                                <input type="text" id="profession_pere" class="form-control" name="profession_pere" placeholder="" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step9">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label class="labelright">Gouvernorat / الولاية</label>
                                                                                <select id="gov" class="form-control" name="gov" required>
                                                                                    <option selected>Choisir...</option>
                                                                                    <option value="Ariana">Ariana</option>
                                                                                    <option value="Béja">Béja</option>
                                                                                    <option value="Ben Arous">Ben Arous</option>
                                                                                    <option value="Bizerte">Bizerte</option>
                                                                                    <option value="Gabès">Gabès</option>
                                                                                    <option value="Gafsa">Gafsa</option>
                                                                                    <option value="Jendouba">Jendouba</option>
                                                                                    <option value="Kairouan">Kairouan</option>
                                                                                    <option value="Kasserine">Kasserine</option>
                                                                                    <option value="Kébili">Kébili</option>
                                                                                    <option value="Le Kef">Le Kef</option>
                                                                                    <option value="Mahdia">Mahdia</option>
                                                                                    <option value="La Manouba">La Manouba</option>
                                                                                    <option value="Médenine">Médenine</option>
                                                                                    <option value="Monastir">Monastir</option>
                                                                                    <option value="Nabeul">Nabeul</option>
                                                                                    <option value="Sfax">Sfax</option>
                                                                                    <option value="Sidi Bouzid">Sidi Bouzid</option>
                                                                                    <option value="Siliana">Siliana</option>
                                                                                    <option value="Sousse">Sousse</option>
                                                                                    <option value="Tataouine">Tataouine</option>
                                                                                    <option value="Tozeur">Tozeur</option>
                                                                                    <option value="Tunis">Tunis</option>
                                                                                    <option value="Zaghouan">Zaghouan</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step10">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Code postale / الترقيم البريدي</label>
                                                                                <input type="number" id="codepostal_etudiant" class="form-control" name="codepostal_etudiant" placeholder="" required>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="labelright">Adresse / العنوان</label>
                                                                                <input type="text" id="rue_etudiant" class="form-control" name="rue_etudiant" placeholder="Adresse (N et Rue)" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step11">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Téléphone 2 / رقم الهاتف 2</label>
                                                                                <input type="number" id="tel2" class="form-control" value="" name="tel2_etudiant" placeholder="8 chiffres">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="labelright">Téléphone 1 / رقم الهاتف 1</label>
                                                                                <input type="number" id="tel1" class="form-control" name="tel1_etudiant" placeholder="8 chiffres" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step12">
                                                                <div class="form-input-steps">
                                                                    <h4>Information Personnel</h4>
                                                                    <h3>معلومات شخصية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <label class="labelright">Adresse éléctronique / البريد الإلكتروني</label>
                                                                                <input type="email" id="email" class="form-control" name="email" placeholder="Exp. ali-selmi@gmail.com" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step13">
                                                                <div class="form-input-steps">
                                                                    <h4>Baccalauréat ou diplome équivalent</h4>
                                                                    <h3> البكالوريا أو مايعادلها</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Session / الدورة</label>
                                                                                <select id="session_bac" class="form-control" name="session_bac" required>
                                                                                    <option selected>Choisir...</option>
                                                                                    <option value="Principale">Principale/الرئيسية</option>
                                                                                    <option value="Controle">Controle/التدارك</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="labelright"> Section / الشعبة</label>
                                                                                <select id="section_bac" class="form-control" name="section_bac" required>
                                                                                    <option selected>Choisir...</option>
                                                                                    <option value="Lettres">Lettres / آداب</option>
                                                                                    <option value="Mathématiques">Mathématiques / رياضيات</option>
                                                                                    <option value="Sciences exprimentales">Sciences exprimentales / علوم تجريبية</option>
                                                                                    <option value="Economie et Gestion">Economie et Gestion / إقتصاد وتصرف</option>
                                                                                    <option value="Technique">Technique / تقنية</option>
                                                                                    <option value="Sciences informatique">Sciences informatique / علوم إعلامية</option>
                                                                                    <option value="Autres">Autres / أخرى</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step14">
                                                                <div class="form-input-steps">
                                                                    <h4>Baccalauréat ou diplome équivalent</h4>
                                                                    <h3> البكالوريا أو مايعادلها</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>Année / السنة</label>
                                                                                <input type="number" id="annee_bac" class="form-control" name="annee_bac" min="1950" max="2050" step="1" value="2022" required/>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label class="labelright">Moyenne / المعدل</label>
                                                                                <input type="text" id="moyenne_bac" class="form-control" name="moyenne_bac" placeholder="Exp. 16.53" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step15">
                                                                <div class="form-input-steps">
                                                                    <h4>Institut Supérieur des Arts et Métiers de Gafsa</h4>
                                                                    <h3> المعهد العالي للفنون والحرف بقفصة</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6" style="display: none;">
                                                                                <label>Diplome / الشهادة</label>
                                                                                <select id="inputState" class="form-control" name="diplome" >
                                                                                    <option value="Filière par défaut" selected>Filière par défaut</option>
                                                                                    <option value="Filière 2">Filière 2</option>
                                                                                    <option value="Filière 3">Filière 3</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group col-md-12">
                                                                                <label class="labelright">Filière / الشعبة</label>
                                                                                <select id="filiere" class="form-control" name="filiere" required>
                                                                                    <option selected>Choisir...</option>
                                                                                    <option value="اجازة في تصميم منتوج">اجازة في تصميم منتوج</option>
                                                                                    <option value="تصميم صورة">تصميم صورة</option>
                                                                                    <option value="تصميم فضاء">تصميم فضاء</option>
                                                                                    <option value="تصميم اثاث">تصميم اثاث</option>
                                                                                    <option value="ابتكار حرفي">ابتكار حرفي</option>
                                                                                    <option value="موسيقى وعلوم موسيقية">موسيقى وعلوم موسيقية</option>
                                                                                    <option value="ماجستير مهني ابتكار حرفي">ماجستير مهني ابتكار حرفي</option>
                                                                                    <option value="ماجستير بحث موسيقى وعلوم موسيقية">ماجستير بحث موسيقى وعلوم موسيقية</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step16">
                                                                <div class="form-input-steps">
                                                                    <h4>Documents naicessaires <span style="color: brown;">format image (jpg, png)</span></h4>
                                                                    <h3>الوثائق المطلوبة</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <div class="image-div">
                                                                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                                                    <img class="hidden_img" src="image/import-photo.png" width="280" height="330" />
                                                                                </div>
                                                                                <label>Photo de profil / الصورة الشخصية</label>
                                                                                <input type="file" id="profile_image" class="form-control" name="profile_image" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step17">
                                                                <div class="form-input-steps">
                                                                    <h4>Documents naicessaires <span style="color: brown;">format image (jpg, png)</span></h4>
                                                                    <h3>الوثائق المطلوبة</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <div class="image-div">
                                                                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                                                    <img class="hidden_img" src="image/import-cin.png" width="280" height="330" />
                                                                                </div>
                                                                                <label>CIN /  بطاقة التعريف الوطنية</label>
                                                                                <input type="file" id="cin_file" class="form-control" name="cin_file" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step18">
                                                                <div class="form-input-steps">
                                                                    <h4>Documents naicessaires <span style="color: brown;">format image (jpg, png)</span></h4>
                                                                    <h3>الوثائق المطلوبة</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <div class="image-div">
                                                                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                                                    <img class="hidden_img" src="image/import-inscription.png" width="280" height="330" />
                                                                                </div>
                                                                                <label>Fiche de Paiement (inscription.tn) / وصل التسجيل عن بعد</label>
                                                                                <input type="file" id="paiement_file" class="form-control" name="paiement_file" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" class="step-btn next-step"><span>Suivant</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" role="tabpanel" id="step19">
                                                                <div class="form-input-steps">
                                                                    <h4>Dérnier étape</h4>
                                                                    <h3>مرحلة التسجيل النهائية</h3>
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                                                <label class="custom-control-label" for="customCheck1">Vous acceptez tous le <a href="javascript:void(0)">termes de l'inscription</a></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="list-inline text-right">
                                                                    <li>
                                                                        <button type="button" class="step-btn prev-step"><i class="fa fa-chevron-left"></i><span>Précédent</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="submit" class="step-btn next-step"><span>Envoyer</span><i class="fa fa-chevron-right"></i></button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </form>
                                                    <div class="wizard-inner">
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li role="presentation">
                                                                <a href="#step1" class="active" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true" data-step="1">
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step2" class="disabled" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false" data-step="2">
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step3" class="disabled" data-toggle="tab" aria-controls="step3" role="tab" data-step="3">
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step4" class="disabled" data-toggle="tab" aria-controls="step4" role="tab" data-step="4"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step5" class="disabled" data-toggle="tab" aria-controls="step5" role="tab" data-step="5"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step6" class="disabled" data-toggle="tab" aria-controls="step6" role="tab" data-step="6"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step7" class="disabled" data-toggle="tab" aria-controls="step7" role="tab" data-step="7"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step8" class="disabled" data-toggle="tab" aria-controls="step8" role="tab" data-step="8"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step9" class="disabled" data-toggle="tab" aria-controls="step9" role="tab" data-step="9"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step10" class="disabled" data-toggle="tab" aria-controls="step10" role="tab" data-step="10"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step11" class="disabled" data-toggle="tab" aria-controls="step11" role="tab" data-step="11"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step12" class="disabled" data-toggle="tab" aria-controls="step12" role="tab" data-step="12"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step13" class="disabled" data-toggle="tab" aria-controls="step13" role="tab" data-step="13"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step14" class="disabled" data-toggle="tab" aria-controls="step14" role="tab" data-step="14"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step15" class="disabled" data-toggle="tab" aria-controls="step15" role="tab" data-step="15"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step16" class="disabled" data-toggle="tab" aria-controls="step16" role="tab" data-step="16"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step17" class="disabled" data-toggle="tab" aria-controls="step17" role="tab" data-step="17"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step18" class="disabled" data-toggle="tab" aria-controls="step18" role="tab" data-step="18"> 
                                                                </a>
                                                            </li>
                                                            <li role="presentation">
                                                                <a href="#step19" class="disabled" data-toggle="tab" aria-controls="step19" role="tab" data-step="19"> 
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- partial -->

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

<script>
    function checkNom(input) {
        var check = input.value.length >= 5;
        input.style.borderColor = check ? 'black' : 'red';
        return check;
    }
</script>

    <script>
        function validatenamex(e) {
            var nom = document.getElementById("nom").value; // Typo here ID should be Id.
            if (nom == "") {
                e.preventDefault();
                alert("Enter First Name");
            }
        }
    </script>

    <script>
        cin.oninput = function () {
            if (this.value.length > 8) {
                this.value = this.value.slice(0,8); 
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


<script>
    // ------------register-steps--------------
$(document).ready(function () {
    $('.nav-tabs > li a[title]').tooltip();
    //Wizard
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var $target = $(e.target);
        if ($target.hasClass('disabled')) {
            return false;
        }
      
        // handle with prgressbar 
        var step = $(e.target).data('step');
        var percent = (parseInt(step) / 19) * 100;
        $('.progress-bar').css({ width: percent + '%' });
        $('.progress-bar').text('Etape ' + step + ' de 19');
      
    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
        $target.parent().addClass('active');
        
        // Required prenom francais
        var prenom = document.getElementById("prenom").value; 
        if (prenom == "") {
            e.preventDefault();
            alert("Saisir prénom en francais");
        }
        // Required prenom arabe
        var prenom_ar = document.getElementById("prenom_ar").value; 
        if (prenom_ar == "") {
            e.preventDefault();
            alert("Saisir prénom en arabe");
        }

    });

    $('a[data-toggle="tab"]').on('hide.bs.tab', function (e) {
        var $target = $(e.target);
        $target.parent().removeClass('active');
    });


    $(".next-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li a.active');
        $active.parent().next().children().removeClass('disabled');
        $active.parent().addClass('done');
        nextTab($active);
    });

    $(".prev-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li a.active');
        prevTab($active);
    });
});

function nextTab(elem) {
    $(elem).parent().next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).parent().prev().find('a[data-toggle="tab"]').click();
}
</script>
@endsection