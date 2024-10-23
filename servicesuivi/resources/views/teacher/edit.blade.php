@extends('adminlayoutenseignant.layout')
@section('title', 'Détails enseignant')
@section('contentPage')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Gestion Enseignant</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('teachers') }}">Gestion des enseignants</a></li>
            <li class="breadcrumb-item active">Détails Enseignant</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
<style>
.hrInscrit {
    border: 1px solid rgb(108, 108, 108);
    width: 100%
}
.labelright {
    display: inline-block;
    text-align: right;
    float: right !important;
}
.sousTitre{
    text-align: center;
    background-color: rgb(90, 90, 90);
    color: aliceblue;
    top: -19%;
    padding: 20px 40px;
    font-size: 17px;
    font-weight: 700;
    position: relative;
}
.profileTeacher{
color: royalblue;
font-weight: bold;
}
input[type=text] {
float: left !important;
}
.TitleOne {
    text-align: right !important;
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

            @foreach ($profiles as $profile)

           
            <div class="card">
                <div class="card-header">
                    <h4>Modifier le profile d'enseignant <span class="profileTeacher">{{ $profile->prenom.' '.$profile->nom }}</span>
                        <a href="{{ url('teachers') }}" class="btn btn-danger float-right">Retour</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('update-teacher/'.$profile->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">

                        @csrf
                        @method('PUT')

                        <h5 class="TitleOne">Application Smart Institute</h5>
                        <h4 class="TitleOne">تطبيق الجامعة الذكية</h4>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Type Enseignant</label>
                                <select id="type_enseignant" name="type_enseignant" class="form-control" required>
                                    <option value="{{ $profile->type_enseignant }}">{{ $profile->type_enseignant }}</option>
                                    <option value="" disabled>-----------------------------</option>
                                    <option value="Permanant">Permanant</option>
                                    <option value="Contractuel">Contractuel</option>
                                    <option value="Expert">Expert</option>
                                    <option value="Vacation">Vacation</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labelright">(ة)حالة الأستاذ </label>
                                <select id="active" name="active" class="form-control" required>

                                    @if (($profile->active=='0'))
                                    <option value="0">Désactivé</option>
                                    @endif
                                    @if (($profile->active=='1'))
                                    <option value="1">Activé</option>
                                    @endif
                                    @if (($profile->active=='2'))
                                    <option value="2">Fin Vacation</option>
                                    @endif
                                    @if (($profile->active=='3'))
                                    <option value="3">Fin Contractuel</option>
                                    @endif
                                    @if (($profile->active=='4'))
                                    <option value="4">Fin Expert</option>
                                    @endif
                                    @if (($profile->active=='5'))
                                    <option value="5">Mutation</option>
                                    @endif
                                    @if (($profile->active=='6'))
                                    <option value="6">Retraite</option>
                                    @endif
                                    @if (($profile->active=='7'))
                                    <option value="7">Coopération</option>
                                    @endif

                                    <option value="" disabled>------------------------------------</option>
                                    <option value="0">Désactivé</option>
                                    <option value="1">Activé</option>
                                    <option value="2">Fin Vacation</option>
                                    <option value="3">Fin Contractuel</option>
                                    <option value="4">Fin Expert</option>
                                    <option value="5">Mutation</option>
                                    <option value="6">Retraite</option>
                                    <option value="7">Coopération</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success float-right">Modifier</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright"> رقم بطاقة التعريف الوطنية</label>
                                <input type="number" value="{{ $profile->cin }}" id="mycin" class="form-control" name="cin" placeholder="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">المعرف الوحيد</label>
                                <input type="number" value="{{ $profile->mat_cnrps }}" name="mat_cnrps" id="mat_cnrps" class="form-control" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright">الإسم بالفرنسية</label>
                                <input type="text" value="{{ $profile->prenom }}" class="form-control" id="prenom"  name="prenom" placeholder="Prénom Enseignant" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">الإسم(بالعربية)</label>
                                <input type="text" value="{{ $profile->prenom_ar }}" class="form-control" id="prenom_ar" name="prenom_ar" placeholder="الإسم الشخصي للأستاذ" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright">اللقب بالفرنسية</label>
                                <input type="text" value="{{ $profile->nom }}" class="form-control" name="nom" placeholder="Nom Enseignant" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">اللقب(بالعربية)</label>
                                <input type="text" value="{{ $profile->nom_ar }}" class="form-control" name="nom_ar" placeholder="اللقب الشخصي للأستاذ" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright"> الولاية</label>
                                <select id="inputState" class="form-control" name="gov">
                                    <option value="{{ $profile->gov }}" selected>{{ $profile->gov }}</option>
                                    <option value="" disabled>-------------------------------------</option>
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
                            <div class="form-group col-md-6">
                                <label class="labelright">تاريخ الولادة</label>
                                <input type="date" value="{{ $profile->ddn }}" class="form-control" name="ddn" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright">الحالة المدنية</label>
                                <select id="inputState" class="form-control" name="etat_civil">
                                    <option value="{{ $profile->etat_civil }}" selected>{{ $profile->etat_civil }}</option>
                                    <option value="" disabled>-------------------------------------</option>
                                    <option value="Celibataire">Celibataire / أعزب / عزباء</option>
                                    <option value="Marié(e)">Marié(e) / (ة) متزوج</option>
                                    <option value="Divorcé(e)">Divorcé(e) / (ة) مطلق</option>
                                    <option value="Veuf(ve)">Veuf(ve) / (ة) أرمل</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">الجنس</label>
                                <select id="inputState" class="form-control" name="genre" required>
                                    <option value="{{ $profile->genre }}" selected>{{ $profile->genre }}</option>
                                    <option value="" disabled>-------------------------------------</option>
                                    <option value="homme">Homme/ذكر</option>
                                    <option value="femme">Femme/أنثى</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright">الجنسية</label>
                                <select id="inputState" class="form-control" name="nationnalite">
                                    <option value="{{ $profile->nationnalite }}" selected>{{ $profile->nationnalite }}</option>
                                    <option value="" disabled>-------------------------------------</option>
                                    <option value="Tunisienne">تونسية</option>
                                    <option value="Autre">أخرى</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">المستوى التعليمي</label>
                                <select id="niveau_educat" class="form-control" name="niveau_educat">
                                    <option value="{{ $profile->niveau_educat }}" selected>{{ $profile->niveau_educat }}</option>
                                    <option value="" disabled>-------------------------------------</option>
                                    <option value="Maitrise">Maitrise</option>
                                    <option value="Licence">Licence</option>
                                    <option value="Mastère Professionel">Mastère Professionel</option>
                                    <option value="Mastère Recherche">Mastère Recherche</option>
                                    <option value="Doctorat">Doctorat</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="form-input-steps" style="text-align: right !important">
                            <h3>الشهادات العلمية</h3>
                            <h4>(1) الشهادات العلمية </h4><br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label class="labelright">المؤسسة</label>
                                        <input type="text" value="{{ $profile->diplome_etab1 }}" class="form-control" name="diplome_etab1" placeholder="Etablissement de diplome">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="labelright">سنة الشهادة</label>
                                        <input type="number" value="{{ $profile->diplome_annee1 }}" id="codepostal" class="form-control" name="diplome_annee1" placeholder="Année Diplome">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="labelright">الشهادة</label>
                                        <input type="text" value="{{ $profile->diplome1 }}" class="form-control" name="diplome1" placeholder="Nom de diplome">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="tab-pane" role="tabpanel" id="step8" style="text-align: right !important">
                            <div class="form-input-steps">
                                <h4>(2) الشهادات العلمية </h4><br>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label class="labelright">(2) المؤسسة</label>
                                            <input type="text" value="{{ $profile->diplome_etab2 }}" class="form-control" name="diplome_etab2" placeholder="Etablissement de diplome">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="labelright">(2) سنة الشهادة</label>
                                            <input type="number" value="{{ $profile->diplome_annee2 }}" id="codepostal" class="form-control" name="diplome_annee2" placeholder="Année Diplome">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label class="labelright">(2) الشهادة</label>
                                            <input type="text" value="{{ $profile->diplome2 }}" class="form-control" name="diplome2" placeholder="Nom de diplome">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br>
                        <div class="tab-pane" role="tabpanel" id="step9" style="text-align: right !important">
                            <div class="form-input-steps">
                                <h4>(3) الشهادات العلمية </h4><br>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label class="labelright">(3) المؤسسة</label>
                                            <input type="text" value="{{ $profile->diplome_etab3 }}" class="form-control" name="diplome_etab3" placeholder="Etablissement de diplome">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="labelright">(3) سنة الشهادة</label>
                                            <input type="number" value="{{ $profile->diplome_annee3 }}" id="codepostal" class="form-control" name="diplome_annee3" placeholder="Année Diplome">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label class="labelright">(3) الشهادة</label>
                                            <input type="text" value="{{ $profile->diplome3 }}" class="form-control" name="diplome3" placeholder="Nom de diplome">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright">تاريخ الإنتداب</label>
                                <input type="date" value="{{ $profile->date_recrutement }}" class="form-control" name="date_recrutement" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">الخطة الوظيفية</label>
                                <select id="poste" name="poste" class="form-control">
                                    <option value="{{ $profile->poste }}">{{ $profile->poste }}</option>
                                    <option value="" disabled>-----------------------------</option>
                                    <option value="PES">PES</option>
                                    <option value="Assistant">Assistant</option>
                                    <option value="Maitre-Assistant">Maitre-Assistant</option>
                                    <option value="Professeur">Professeur</option>
                                    <option value="Maitre de conférences">Maitre de conférences</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright">تاريخ التسمية في الرتبة أو الصنف </label>
                                <input type="date" value="{{ $profile->grade_date }}" id="grade_date" class="form-control" name="grade_date" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">الرتبة</label>
                                <select id="grade" name="grade" class="form-control">
                                    <option value="{{ $profile->grade }}">{{ $profile->grade }}</option>
                                    <option value="" disabled>-----------------------------</option>
                                    <option value="Maitrise">Maitrise</option>
                                    <option value="Licence">Licence</option>
                                    <option value="Mastère pro">Mastère pro</option>
                                    <option value="Mastère recherche">Mastère recherche</option>
                                    <option value="Ingénieur">Ingénieur</option>
                                    <option value="Doctorat">Doctorat</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright">الترقيم البريدي</label>
                                <input type="number" value="{{ $profile->codepostal_teacher }}" id="codepostal" class="form-control" name="codepostal_teacher" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">العنوان</label>
                                <input type="text" value="{{ $profile->rue_teacher }}" class="form-control" name="rue_teacher" placeholder="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="labelright">الهاتف الجوال </label>
                                <input type="number" value="{{ $profile->tel1_teacher }}" class="form-control" name="tel1_teacher" placeholder="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="labelright">العنوان الإلكتروني </label>
                                <input type="email" value="{{ $profile->email }}" class="form-control" name="email"/>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label class="labelright">عدد الأبناء</label>
                                <input type="number" value="{{ $profile->nbr_enfant }}" class="form-control" name="nbr_enfant" placeholder="">
                            </div>
                            <div class="form-group col-md-5">
                                <label class="labelright">مهنة القرين ومكانها</label>
                                <input type="text" value="{{ $profile->profession_garant }}" class="form-control" name="profession_garant" placeholder="">
                            </div>
                            <div class="form-group col-md-5">
                                <label class="labelright">إسم القرين ولقبه</label>
                                <input type="text" value="{{ $profile->nom_garant }}" class="form-control" name="nom_garant" placeholder="">
                            </div>
                        </div>
                        <br>
                      
                        <br><br>
                        <div class="row">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success float-right">Modifier</button>
                            </div>
                        </div>
                        <br>
                    </form>
                    <br><hr><br>

                    <form action="{{ url('update-photo/'.$profile->id) }}" method="POST"enctype="multipart/form-data" onsubmit="return confirm('Êtes-vous sûr de modifier cette donnée?')">
                        @csrf
                        @method('PUT')
                        <div class="form-input-steps" style="text-align: right;">
                            <h4>Documents naicessaires</h4>
                            <h3> الصورة الشخصية</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <img src={{ asset($upload.'/teachers/'.$profile->profile_image) }} style="width:150px !important; height: 160px;" class="profile-user-img img-fluid img-circle imgPhoto"" >
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="labelright">Photo de profil / الصورة الشخصية</label>
                                        <input type="file" value="{{ $profile->profile_image }}" id="" class="form-control" name="profile_image">
                                    </div>
                                </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-warning float-right">Modifier Photo</button>
                        </div>
                    </form>

                </div>
            </div>
            @endforeach



        </div>
    </div>
    
@endsection