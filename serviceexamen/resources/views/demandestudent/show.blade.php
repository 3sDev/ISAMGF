<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
<link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>

@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

<style>
*{
  font-family: 'Cairo';
  font-size: 17px;
}
.salima{
    margin-left: 20%;
    margin-top:10%;
}
.salima img{
    width:70%;
}
</style>

<div id="printme" class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- partial:index.partial.html -->
                <div class="invoice-body">
                    @foreach ($demandestudents as $demand)
                        @if ($demand->sous_type == 'التثبت من ورقة امتحان')
                          <!-- partial -->
                          <div class="container" style="margin-top: 5%; margin-left: 10%;">
                            <div class="row">
                              <div class="col-md-8" >
                                <div class="panel panel-info">
                                  <div class="panel-heading">
                                    <h3 class="text-center">{{ $demand->sous_type }}</h3>
                                  </div>
                                  <div class="panel-body">
                                    <div class="row">

                                      <div class=" col-md-9 col-lg-9 "> 
                                        <table class="table table-user-information text-right">
                                          <tbody>
                                            <tr>
                                              <td><b>{{ $demand->student->prenom_ar.' '.$demand->student->nom_ar  }}</b></td>
                                              <td>الإسم و اللقب</td>
                                            </tr>
                                            <tr>
                                              <td><b>{{ $demand->classe->abbreviation }}</b></td>
                                              <td>القسم</td>
                                            </tr>
                                            <tr>
                                              <td><b>{{ $demand->student->ddn }}</b></td>
                                              <td>تاريخ الولادة</td>
                                            </tr>
                                        
                                            <tr>
                                              <tr>
                                              <td><b>{{ $demand->student->rue_etudiant_ar }}</b></td>
                                              <td>العنوان</td>
                                            </tr>
                                              <tr>
                                              <td><b>{{ $demand->student->email }}</b></td>
                                              <td>البريد الإلكتروني</td>
                                            </tr>
                                            <tr>
                                              <td><b>{{ $demand->student->tel1_etudiant }}</b></td>
                                              <td>رقم الهاتف</td>
                                            </tr>
                                              <td><b>{{ $demand->student->cin }}</b></td>
                                              <td>رقم ب.ت.و</td>
                                            </tr>

                                            <tr>
                                              <tr>
                                              <td><b>{{ $demand->nom_examen }}</b></td>
                                              <td>إصلاح الخطأ في الوثيقة</td>
                                            </tr>
                                              <tr>
                                              <td><b>{{ date('Y-m-d | H:i', strtotime($demand->created_at)) }}</b></td>
                                              <td>تاريخ الإرسال</td>
                                            </tr>
                                            
                                          </tbody>
                                        </table>
                                        
                                      </div>

                                      <div class="col-md-3 col-lg-3 " align="center"> <img alt="Student Pic" src={{ asset($upload.'/students/'.$demand->student->profile_image) }} style="width:150px !important; height:150px !important" class="img-circle img-responsive"> </div>

                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4"></div>
                            </div>
                          </div>
                          <!-- partial -->
                        @endif

                        @if ($demand->sous_type == 'اعادة اصلاح ورقة امتحان')
                          <!-- partial -->
                          <div class="container" style="margin-top: 5%; margin-left: 10%;">
                            <div class="row">
                              <div class="col-md-8" >
                                <div class="panel panel-info">
                                  <div class="panel-heading">
                                    <h3 class="text-center">{{ $demand->sous_type }}</h3>
                                  </div>
                                  <div class="panel-body">
                                    <div class="row">

                                      <div class=" col-md-9 col-lg-9 "> 
                                        <table class="table table-user-information text-right">
                                          <tbody>
                                            <tr>
                                              <td><b>{{ $demand->student->prenom_ar.' '.$demand->student->nom_ar  }}</b></td>
                                              <td>الإسم و اللقب</td>
                                            </tr>
                                            <tr>
                                              <td><b>{{ $demand->classe->abbreviation }}</b></td>
                                              <td>القسم</td>
                                            </tr>
                                            <tr>
                                              <td><b>{{ $demand->student->ddn }}</b></td>
                                              <td>تاريخ الولادة</td>
                                            </tr>
                                        
                                            <tr>
                                              <tr>
                                              <td><b>{{ $demand->student->rue_etudiant_ar }}</b></td>
                                              <td>العنوان</td>
                                            </tr>
                                              <tr>
                                              <td><b>{{ $demand->student->email }}</b></td>
                                              <td>البريد الإلكتروني</td>
                                            </tr>
                                            <tr>
                                              <td><b>{{ $demand->student->tel1_etudiant }}</b></td>
                                              <td>رقم الهاتف</td>
                                            </tr>
                                              <td><b>{{ $demand->student->cin }}</b></td>
                                              <td>رقم ب.ت.و</td>
                                            </tr>

                                            <tr>
                                              <tr>
                                              <td><b>{{ $demand->nom_examen }}</b></td>
                                              <td>إصلاح الخطأ في الوثيقة</td>
                                            </tr>
                                              <tr>
                                              <td><b>{{ date('Y-m-d | H:i', strtotime($demand->created_at)) }}</b></td>
                                              <td>تاريخ الإرسال</td>
                                            </tr>
                                            
                                          </tbody>
                                        </table>
                                        
                                      </div>

                                      <div class="col-md-3 col-lg-3 " align="center"> <img alt="Student Pic" src={{ asset($upload.'/students/'.$demand->student->profile_image) }} style="width:150px !important; height:150px !important" class="img-circle img-responsive"> </div>

                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                              <div class="col-md-4"></div>
                            </div>
                          </div>
                          <!-- partial -->
                        @endif

                        @if ($demand->sous_type == 'تثمين وحدات')
                          <!-- partial -->
                          <div class="container" style="margin-top: 5%; margin-left: 10%;">
                              <div class="row">
                                <div class="col-md-8" >
                                  <div class="panel panel-info">
                                    <div class="panel-heading">
                                      <h3 class="text-center">{{ $demand->sous_type }}</h3>
                                    </div>
                                    <div class="panel-body">
                                      <div class="row">

                                        <div class=" col-md-9 col-lg-9 "> 
                                          <table class="table table-user-information text-right">
                                            <tbody>
                                              <tr>
                                                <td><b>{{ $demand->student->prenom_ar.' '.$demand->student->nom_ar  }}</b></td>
                                                <td>الإسم و اللقب</td>
                                              </tr>
                                              <tr>
                                                <td><b>{{ $demand->classe->abbreviation }}</b></td>
                                                <td>القسم</td>
                                              </tr>
                                              <tr>
                                                <td><b>{{ $demand->student->ddn }}</b></td>
                                                <td>تاريخ الولادة</td>
                                              </tr>
                                          
                                              <tr>
                                                <td><b>{{ $demand->student->rue_etudiant_ar }}</b></td>
                                                <td>العنوان</td>
                                              </tr>
                                              <tr>
                                                <td><b>{{ $demand->student->email }}</b></td>
                                                <td>البريد الإلكتروني</td>
                                              </tr>
                                              <tr>
                                                <td><b>{{ $demand->student->tel1_etudiant }}</b></td>
                                                <td>رقم الهاتف</td>
                                              </tr>
                                              <tr>
                                                <td><b>{{ $demand->student->cin }}</b></td>
                                                <td>رقم ب.ت.و</td>
                                              </tr>

                                              <tr>
                                                <td><b>{{ $demand->type_etudiant }}</b></td>
                                                <td>طالب</td>
                                              </tr>
                                              @if ($demand->ecole_etudiant)
                                                <tr>
                                                  <td><b>{{ $demand->ecole_etudiant }}</b></td>
                                                  <td>المؤسسة</td>
                                                </tr> 
                                              @endif
                                              <tr>
                                                <td><b>{{ $demand->previous_annee }}</b></td>
                                                <td>المستوى الدراسي للسنة الفارطة</td>
                                              </tr>
                                              <tr>
                                                <td><b>{{ $demand->previous_annee_specialite }}</b></td>
                                                <td>إختصاص السنة الفارطة</td>
                                              </tr>
                                              <tr>
                                                <td><b>{{ date('Y-m-d | H:i', strtotime($demand->created_at)) }}</b></td>
                                                <td>تاريخ الإرسال</td>
                                              </tr>
                                              
                                            </tbody>
                                          </table>
                                          
                                        </div>

                                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="Student Pic" src={{ asset($upload.'/students/'.$demand->student->profile_image) }}  style="width:150px !important; height:150px !important"  class="img-circle img-responsive"> </div>

                                      </div>
                                    </div>
                                      <div class="panel-footer">
                                        <a href="{{ asset($upload.'/demandesStudents/releveeNotes/'.$demand->relevee_notes) }}" target="_blank" class="btn btn-primary"> الوثيقة المصاحبة / بطاقة أعداد </a>
                                      </div>
                                    
                                  </div>
                                </div>
                                <div class="col-md-4"></div>
                              </div>
                            </div>
                          <!-- partial -->
                        @endif

                       
                    @endforeach
                </div>
                <!-- partial -->
            </div>
        </div>
    </div>
</div>