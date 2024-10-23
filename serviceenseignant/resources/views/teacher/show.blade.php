@extends('adminlayoutenseignant.layout')
@section('title', 'Profil Enseignant')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Profil Enseignant</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('teachers') }}">Liste des enseignants</a></li>
          <li class="breadcrumb-item active">Profil Enseignant</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach
<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />

<div class="row">
  <div class="col-md-3">
    @if (session('message'))
      <h5>{{ session('message') }}</h5>
    @endif
    @foreach ($profiles as $profile)
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            @if ($profile->profile_image)
              <img src={{ asset($upload.'/teachers/'.$profile->profile_image) }} class="profile-user-img img-fluid img-circle" >
            @else
              <img class="profile-user-img img-fluid img-circle"
              src={{ asset('https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-512.png') }}
              alt="Teacher profile picture">
            @endif
          </div>
          <h3 class="profile-username text-center">{{ $profile->prenom.' '.$profile->nom }}</h3>

          <p class="text-muted text-center">{{ $profile->prenom_ar.' '.$profile->nom_ar }}</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Type enseignant</b> <a class="float-right">{{ $profile->type_enseignant }}</a>
            </li>
            <li class="list-group-item">
              <b>Matricule</b> <a class="float-right">{{ $profile->mat_cnrps }}</a>
            </li>
            <li class="list-group-item">
              <b>CIN</b> <a class="float-right">{{ $profile->cin }}</a>
            </li>
            <li class="list-group-item">
              <b>Email</b> <a class="float-right">{{ $profile->email }}</a>
            </li>
          </ul>

          {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    @endforeach

    <!-- About Me Box -->
    {{-- <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Info</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <strong><i class="fas fa-user-alt mr-1"></i> Genre</strong>
        <span class="text-muted">{{ $profile->genre }}</span>
        <hr>
        <strong><i class="fas fa-book mr-1"></i> Date de naissance</strong>
        <span class="text-muted">
          {{ $profile->ddn }}
        </span>
        <hr>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
        <span class="text-muted">{{ $profile->rue_teacher.", ".$profile->gov.", ".$profile->codepostal_teacher  }}</span>
      </div>
      <!-- /.card-body -->
    </div> --}}
    <!-- /.card -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#infos" data-toggle="tab">Informations personnel</a></li>
          <li class="nav-item"><a class="nav-link" href="#demande" data-toggle="tab">Demandes</a></li>
          <li class="nav-item"><a class="nav-link" href="#attendance" data-toggle="tab">Attendance</a></li>
          <li class="nav-item"><a class="nav-link" href="#reclamation" data-toggle="tab">Réclamations</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <!-- /.tab-pane -->
          <div class="active tab-pane" id="infos">
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-6 invoice-col">
                <p class="lead">Informations personnels</p>
                <address>
                  <strong>Genre :</strong> {{ $profile->genre }}<br>
                  <strong>Nationnalité :</strong> {{ $profile->nationnalite }}<br>
                  <strong>Grade :</strong> {{ $profile->grade }}<br>
                  {{-- <strong>Etat civil :</strong> {{ $profile->etat_civil }}<br>
                  <strong>Date naissance :</strong> {{ $profile->ddn }}<br> --}}
                  <strong>Téléphone 1 :</strong> {{ $profile->tel1_teacher }}<br>
                  <strong>Téléphone 2 :</strong> {{ $profile->tel2_ens }}<br>
                  <strong>RIB :</strong> {{ $profile->rib_ens }}<br>
                  
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-6 invoice-col">
                <p class="lead">Enseignant</p>
                <address>
                  <strong>Niveau d'étude :</strong> {{ $profile->niveau_educat }}<br>
                  <strong>Spécialité :</strong> {{ $profile->specialite_ens }}<br>
{{--                   <strong>Département :</strong> {{ $profile->departement->departmentLabel }}<br>
 --}}                  <strong>Diplome :</strong> {{ $profile->diplome1 }}<br>
                  <strong>Année diplome:</strong> {{ $profile->diplome_annee1 }}<br>
                  <strong>Etablissement diplome:</strong> {{ $profile->diplome_etab1 }}<br>
                  
                </address>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="demande">
            
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Langue</th>
                    <th>Date</th>
                    <th></th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>

                @foreach ($demandetachers as $demand)
            
                <tr>
                <td>{{ $demand->id }}</td>
                <td>{{ $demand->type }}</td>

                @if (($demand->statut=='En cours'))
                <td><span class="demandEncours">{{ $demand->statut }}</span></td>
                @endif
                @if (($demand->statut=='Traitée'))
                <td><span class="demandTraitee">{{ $demand->statut }}</span></td>
                @endif
                
                <td>{{ $demand->langue }}</td>
                <td>{{ date('Y-m-d / H:i', strtotime($demand->created_at)) }}</td>
                {{-- <td>{{ strtotime($demand->created_at).date('Y-m-d') }}</td> --}}
                
                
                <td class="text-right">
                    <a href="{{ url('show-demandeteacher/'.$demand->id) }}" class="btn btn-link btn-info btn-just-icon edit btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                    <a href="{{ url('edit-demandeteacher/'.$demand->id) }}" class="btn btn-link btn-success btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                </td>
                <td>
                    <form action="{{ url('delete-demandeteacher/'.$demand->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                    {{-- @csrf
                    @method('DELETE') --}}
                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
                </tr>

                @endforeach

              </tbody>
              <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Langue</th>
                    <th>Date</th>
                    <th></th>
                    <th></th>
                  </tr>
              </tfoot>
            </table>

          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="attendance">
            
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>ID</th>
                    <th>Date absence</th>
                    <th>Statut absence</th>
                    <th>Justification</th>
                    <th>Date Justification</th>
                  </tr>
              </thead>
              <tbody>

                @foreach ($attendanceteachers as $teacher)
                  @foreach ($teacher->attendances_teachers as $attendance)
                  <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->attendance_date }}</td>
                    <td>{{ $attendance->attendance_statut }}</td>
                    <td>{{ $attendance->justification }}</td>
                    <td>{{ $attendance->date_justification }}</td>
                  </tr>
                  @endforeach
                @endforeach

              </tbody>
              <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Date absence</th>
                    <th>Statut absence</th>
                    <th>Justification</th>
                    <th>Date Justification</th>
                  </tr>
              </tfoot>
            </table>

          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="reclamation">
            
            <table id="example3" class="table table-bordered table-striped">
              <thead>
                  <tr>
                    <th>ID</th>
                    <th>Reclamation</th>
                    <th>Statut</th>
                    <th>Date création</th>
                    <th></th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>

                @foreach ($reclamationteacher as $teacher)
                  @foreach ($teacher->reclamationsteachers as $reclam)
                  <tr>
                    <td>{{ $reclam->id }}</td>
                    <td>{{ $reclam->description }}</td>

                    @if (($reclam->statut=='En cours'))
                    <td><span class="demandEncours">{{ $reclam->statut }}</span></td>
                    @endif
                    @if (($reclam->statut=='Traitée'))
                    <td><span class="demandTraitee">{{ $reclam->statut }}</span></td>
                    @endif

                    <td>{{ date('Y-m-d', strtotime($reclam->created_at)) }}</td>
                    <td class="text-right">
                      {{-- <a href="{{ url('show-reclamation/'.$reclam->id) }}" class="btn btn-link btn-info btn-just-icon edit"><i class="material-icons">account_box</i></a> --}}
                      <a href="{{ url('edit-reclamation/'.$reclam->id) }}" class="btn btn-link btn-success btn-just-icon edit btn-sm"><i class="nav-icon fas fa-user"></i></a>
                    </td>
                    <td>
                        <form action="{{ url('delete-reclamation/'.$reclam->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                            <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                @endforeach

              </tbody>
              <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Reclamation</th>
                    <th>Statut</th>
                    <th>Date création</th>
                    <th></th>
                    <th></th>
                  </tr>
              </tfoot>
            </table>

          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@endsection