@extends('adminlayoutscolarite.layout')
@section('title', 'Ajouter étudiant')
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Ajouter étudiant</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('students') }}">Liste des étudiants</a></li>
                <li class="breadcrumb-item active">Ajouter étudiant</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<style>
.labelright {
    display: inline-block;
    text-align: right;
    float: right !important;
}

input[type=text], select, input[type=number]{
    text-align: right !important;
}
</style>
{{-- <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" /> --}}
<link rel="stylesheet" href="{{ URL::asset('css/ajaxSelect.css') }}" />

    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Ajouter un nouveau étudiant
                        <a href="{{ url('students') }}" class="btn btn-danger float-right">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('students') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <table width="100%">
                            <tr>
                                <td width="100%">
                                    <label for="">Classes</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="select">
                                        <select id="levels" class="form-control" name="level_id" data-style="btn btn-primary" required>
                                            <option value="" selected disabled>Selectionner Classe</option>
                                            @foreach ($classes as $key => $classe)
                                                <option value="{{ $key }}"> {{ $classe->classeName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="labelright">رقم بطاقة التعريف الوطنية</label>
                                <input type="number" id="mycin" class="form-control" name="cin" placeholder="" required>
                            </div>
                            <div class="col-md-4">
                                <label class="labelright">اللقب(بالفرنسية)</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="labelright">الإسم(بالفرنسية)</label>
                                <input type="text" name="prenom" class="form-control" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="labelright"> رقم التسجيل</label>
                                <input type="text" name="matricule" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="labelright">اللقب(بالعربية)</label>
                                <input type="text" name="nom_ar" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="labelright">الإسم(بالعربية)</label>
                                <input type="text" name="prenom_ar" class="form-control" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labelright">تاريخ الولادة</label>
                                <input type="date" class="form-control" name="ddn" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labelright">مكان الولادة</label>
                                <input type="text" class="form-control" name="lieu_naissance" placeholder="" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labelright">الحالة المدنية</label>
                                <select id="inputState" class="form-control" name="etat_civil" required>
                                    <option value="">إختر ...</option>
                                    <option value="أعزب / عزباء">Celibataire / أعزب / عزباء</option>
                                    <option value="(ة) متزوج">Marié(e) / (ة) متزوج</option>
                                    <option value="(ة) مطلق">Divorcé(e) / (ة) مطلق</option>
                                    <option value="(ة) أرمل">Veuf(ve) / (ة) أرمل</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labelright">الجنس</label>
                                <select id="inputState" class="form-control" name="genre" required>
                                    <option value="">إختر ...</option>
                                    <option value="ذكر">Homme/ذكر</option>
                                    <option value="أنثى">Femme/أنثى</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="labelright">إسم الأب و لقبه</label>
                                <input type="text" id="" class="form-control" name="prenom_pere" placeholder="" required>
                            </div>
                            <div class="col-md-4">
                                <label class="labelright">مهنة الأب</label>
                                <input type="text" id="" class="form-control" name="profession_pere" placeholder="" required>
                            </div>
                            <div class="col-md-4">
                                <label class="labelright">إسم الأم و لقبها</label>
                                <input type="text" id="" class="form-control" name="prenom_mere" placeholder="" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="labelright">الولاية</label>
                                <select id="inputState" class="form-control" name="gov" required>
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
                            </div>
                            <div class="col-md-4">
                                <label class="labelright">العنوان</label>
                                <input type="text" class="form-control" name="rue_etudiant" placeholder="Adresse (N et Rue)" required>
                            </div>
                            <div class="col-md-4">
                                <label class="labelright">الترقيم البريدي</label>
                                <input type="number" id="codepostal" class="form-control" name="codepostal_etudiant" placeholder="" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labelright">رقم الهاتف </label>
                                <input type="number" id="mynum" class="form-control" name="tel1_etudiant" placeholder="8 chiffres" required>
                            </div>
                            <div class="col-md-6">
                                <label class="labelright">البريد الإلكتروني</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labelright">الدورة</label>
                                <select id="inputState" class="form-control" name="session_bac" required>
                                    <option selected value="">إختر ...</option>
                                    <option value="الرئيسية">Principale/الرئيسية</option>
                                    <option value="التدارك">Controle/التدارك</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labelright"> الشعبة</label>
                                <select id="inputState" class="form-control" name="section_bac" required>
                                    <option value="" selected>إختر ...</option>
                                    <option value="آداب">Lettres / آداب</option>
                                    <option value="رياضيات">Mathématiques / رياضيات</option>
                                    <option value="علوم تجريبية">Sciences exprimentales / علوم تجريبية</option>
                                    <option value="إقتصاد وتصرف">Economie et Gestion / إقتصاد وتصرف</option>
                                    <option value="تقنية">Technique / تقنية</option>
                                    <option value="علوم إعلامية">Sciences informatique / علوم إعلامية</option>
                                    <option value="أخرى">Autres / أخرى</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labelright">السنة</label>
                                <input type="number" class="form-control" name="annee_bac" min="1950" max="2050" step="1" value="2022" required/>
                            </div>
                            <div class="col-md-6">
                                <label class="labelright">المعدل</label>
                                <input type="text" class="form-control" name="moyenne_bac" placeholder="Exp. 16.53" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="labelright">الشعبة</label>
                                <select id="inputState" class="form-control" name="filiere" required>
                                    <option value="" selected>إختر ...</option>
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
                        <br><br>
                        <div class="row">
                            <div class="col-md-5">
                                <label class="labelright">CIN (Face 2) /  بطاقة التعريف الوطنية الوجه الثاني</label>
                                <input type="file" id="" class="form-control" name="cin_file_2" required>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <label class="labelright">CIN (Face 1) /  بطاقة التعريف الوطنية الوجه الأول</label>
                                <input type="file" id="" class="form-control" name="cin_file" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-5">
                                <label class="labelright">Fiche de Paiement (inscription.tn) / وصل التسجيل عن بعد</label>
                                <input type="file" id="" class="form-control" name="paiement_file" required>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <label class="labelright">Photo de profil / الصورة الشخصية</label>
                                <input type="file" id="" class="form-control" name="profile_image" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-right">ajouter</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        mycin.oninput = function () {
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
        codepostal.oninput = function () {
            if (this.value.length > 4) {
                this.value = this.value.slice(0,4); 
            }
        }
    </script>

    <script>
        // when section dropdown changes
        $('#levels').change(function() {

            var levelID = $(this).val();

            if (levelID) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('getClasse') }}?level_id=" + levelID,
                    success: function(res) {

                        if (res) {

                            $("#classe").empty();
                            $("#classe").append('<option selected disabled>Selectionner La classe</option>');
                            $.each(res, function(key, value) {
                                $("#classe").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {

                            $("#classe").empty();
                        }
                    }
                });
            } else {

                $("#classe").empty();
            }
        });

    </script>
@endsection