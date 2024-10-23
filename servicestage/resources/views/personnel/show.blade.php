@extends('adminlayoutenseignant.layout')
@section('title', 'Profil Personnel')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Profil Personnel</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('personnels') }}">Liste des personnels</a></li>
          <li class="breadcrumb-item active">Profil Personnel</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

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
                <img class="profile-user-img img-fluid img-circle"
                    src="{{url('dist/img/user4-128x128.jpg')}}"
                    alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ $profile->prenom.' '.$profile->nom }}</h3>

              <p class="text-muted text-center">{{ $profile->prenom_ar.' '.$profile->nom_ar }}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>CIN</b> <a class="float-right">{{ $profile->cin }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{ $profile->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Téléphone</b> <a class="float-right">{{ $profile->profile_personnel->phone }}</a>
                </li>
              </ul>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        @endforeach

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Info</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-user-alt mr-1"></i> Genre</strong>
            <p class="text-muted">{{ $profile->profile_personnel->genre }}</p>
            <hr>
            <strong><i class="fas fa-book mr-1"></i> Date de naissance</strong>
            <p class="text-muted">
              {{ $profile->profile_personnel->ddn }}
            </p>
            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
            <p class="text-muted">{{ $profile->profile_personnel->rue.", ".$profile->profile_personnel->gov.", ".$profile->profile_personnel->codepostal  }}</p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#demande" data-toggle="tab">Demandes</a></li>
              <li class="nav-item"><a class="nav-link" href="#attendance" data-toggle="tab">Attendance</a></li>
              <li class="nav-item"><a class="nav-link" href="#reclamation" data-toggle="tab">Réclamations</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="demande">
                
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Année</th>
                        <th>Semestre</th>
                        <th>Statut</th>
                        <th>Langue</th>
                        <th>Date</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($demandepersonnels as $demand)
                
                    <tr>
                    <td>{{ $demand->id }}</td>
                    <td>{{ $demand->type }}</td>
                    <td>{{ $demand->years }}</td>
                    <td>{{ $demand->semestre }}</td>

                    @if (($demand->statut=='Envoyée'))
                    <td><span class="demandEnvoyee">{{ $demand->statut }}</span></td>
                    @endif
                    @if (($demand->statut=='En cours'))
                    <td><span class="demandEncours">{{ $demand->statut }}</span></td>
                    @endif
                    @if (($demand->statut=='Traitée'))
                    <td><span class="demandTraitee">{{ $demand->statut }}</span></td>
                    @endif
                    
                    <td>{{ $demand->langue }}</td>
                    <td>{{ date('Y-m-d') }}</td>
                    {{-- <td>{{ strtotime($demand->created_at).date('Y-m-d') }}</td> --}}
                    
                    <td class="text-right">
                        <a href="{{ url('edit-demandepersonnel/'.$demand->id) }}" class="btn btn-link btn-success btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                    <td class="text-right">
                        <a href="{{ url('show-demandepersonnel/'.$demand->id) }}" class="btn btn-link btn-info btn-just-icon edit"><i class="nav-icon fas fa-eye"></i></a>
                    </td>
                    <td>
                        <form action="{{ url('delete-demandepersonnel/'.$demand->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                        {{-- @csrf
                        @method('DELETE') --}}
                        <button type="submit" class="btn btn-link btn-danger btn-just-icon remove"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    </tr>

                    @endforeach

                  </tbody>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Année</th>
                        <th>Semestre</th>
                        <th>Statut</th>
                        <th>Langue</th>
                        <th>Date</th>
                        <th></th>
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
                        <th>Jour</th>
                        <th>teacher_id</th>
                        <th>attendance_date</th>
                        <th>attendance_statut</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($attendancepersonnels as $personnel)
                      @foreach ($personnel->attendances_personnels as $attendance)
                      <tr>
                        <td>{{ $attendance->id }}</td>
                        <td>{{ $attendance->jour }}</td>
                        <td>{{ $attendance->personnel_id }}</td>
                        <td>{{ $attendance->attendance_date }}</td>
                        <td>{{ $attendance->attendance_statut }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      @endforeach
                    @endforeach

                  </tbody>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Jour</th>
                        <th>personnel_id</th>
                        <th>attendance_date</th>
                        <th>attendance_statut</th>
                        <th></th>
                        <th></th>
                        <th></th>
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
                        <th>matiere_id</th>
                        <th>teacher_id</th>
                        <th>attendance_date</th>
                        <th>attendance_statut</th>
                        <th></th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($reclamationpersonnel as $personnel)
                      @foreach ($personnel->reclamationspersonnels as $reclam)
                      <tr>
                        <td>{{ $reclam->id }}</td>
                        <td>{{ $reclam->service }}</td>
                        <td>{{ $reclam->description }}</td>

                        @if (($reclam->statut=='Envoyée'))
                        <td><span class="demandEnvoyee">{{ $reclam->statut }}</span></td>
                        @endif
                        @if (($reclam->statut=='En cours'))
                        <td><span class="demandEncours">{{ $reclam->statut }}</span></td>
                        @endif
                        @if (($reclam->statut=='Traitée'))
                        <td><span class="demandTraitee">{{ $reclam->statut }}</span></td>
                        @endif

                        <td>{{ date('Y-m-d', strtotime($reclam->created_at)) }}</td>
                        <td class="text-right">
                          {{-- <a href="{{ url('show-reclamation/'.$reclam->id) }}" class="btn btn-link btn-info btn-just-icon edit"><i class="material-icons">account_box</i></a> --}}
                          <a href="{{ url('edit-reclamation/'.$reclam->id) }}" class="btn btn-link btn-success btn-just-icon edit"><i class="nav-icon fas fa-user"></i></a>
                        </td>
                        <td>
                            <form action="{{ url('delete-reclamation/'.$reclam->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                <button type="submit" class="btn btn-link btn-danger btn-just-icon remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
                    @endforeach

                  </tbody>
                  <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>matiere_id</th>
                        <th>personnel_id</th>
                        <th>attendance_date</th>
                        <th>attendance_statut</th>
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