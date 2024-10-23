 @extends('adminlayoutscolarite.layoutdatatable')
 @section('title', 'Dashboard')
 @section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tableau de board</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></li> --}}
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<Style>
  .Sameline {
    position: absolute;
    list-style: none;
    /* display: flex; */
    align-items: center;
    justify-content: center;
    margin-top: -25px;
    margin-left: -40px;
    border: none;
    background: none;

  }
  .Sameline i {
    color: #007BFF;
    font-weight: bold;
  }

  .iconView {
    margin-right: 13px;
  }

  a.disabled {
  pointer-events: none;
  cursor: default;
}
</Style>

      <div class="row">
          <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>{{ $studentActive }}/{{ $allStudents }}</h3>
        
                        <p>Etudiant inscrit </p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person"></i>
                      </div>
                      <a href="{{url('students')}}" class="small-box-footer">Voir Plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3>{{ $studentNoActive }}<sup style="font-size: 20px"></sup></h3>
        
                        <p>Etudiant non inscrit</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="{{url('students')}}" class="small-box-footer">Voir Plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{ $studentRetrait }}</h3>
        
                        <p>Retrait d’inscription</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="{{url('students')}}" class="small-box-footer">Voir Plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                      <div class="inner">
                        <h3>{{ $studentMutation }}</h3>
        
                        <p>Mutation des étudiants </p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="{{url('students')}}" class="small-box-footer">Voir Plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
              </div>
            </div>
            {{-- second cards statistics --}}
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3>{{ $studentDesactive }}</h3>
        
                        <p>Etudiant Désactivé</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="{{url('students')}}" class="small-box-footer">Voir Plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-dark">
                      <div class="inner">
                        <h3>{{ $studentDemandeStatut }}/{{ $studentAllDemandes }}</h3>
        
                        <p>Demandes non traités </p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-folder"></i>
                      </div>
                      <a href="{{url('demandestudent')}}" class="small-box-footer">Voir Plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-maroon">
                      <div class="inner">
                        <h3>{{ $studentReclamationStatut }}/{{ $studentAllReclamations }}</h3>
        
                        <p>Réclamations non traités </p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-document"></i>
                      </div>
                      <a href="{{url('reclamations')}}" class="small-box-footer">Voir Plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-gradient-cyan">
                      <div class="inner">
                        <h3>{{ $rattrapageEncours }}/{{ $allRattrapages }}</h3>
        
                        <p>Rattrapage non validés </p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-calendar"></i>
                      </div>
                      <a href="{{url('rattrapage')}}" class="small-box-footer">Voir Plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
              </div>
            </div>
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
  
              <!-- Méteo -->
              <div class="card direct-chat direct-chat-primary">
                <div class="card-header">
                  <h3 class="card-title">Méteo</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <a class="weatherwidget-io disabled" href="https://forecast7.com/fr/34d438d78/gafsa/" data-label_1="GAFSA" data-label_2="WEATHER" data-theme="original">GAFSA WEATHER</a>
                </div>
                <!-- /.card-body -->
              </div>
              <!--/.direct-chat -->
  
             
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">
  
                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">
                          <i class="ion ion-clipboard mr-1"></i>
                          Mes notes (Agenda)
                      </h3>
                      <div class="card-tools">
                        <a href="{{ url('agenda') }}" class="btn btn-block btn-default btn-sm float-right">Voir tous</a>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <ul class="todo-list" data-widget="todo-list">

                        @foreach ($agenda as $agd)

                          <li>
                            <!-- drag handle -->
                            <span class="handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <!-- todo text -->
                            <span class="text">{{ $agd->titre }}</span>
                            <!-- Emphasis label -->
                            <small class="badge badge-warning"><i class="far fa-clock"></i> {{ date('Y-m-d H:i', strtotime($agd->date_rappel)) }}</small>
                            <!-- General tools such as edit or delete-->
                            <div class="tools">
                              <a href="{{ url('show-agenda/'.$agd->id) }}" class="iconView"><i class="nav-icon fas fa-eye"></i></a>
                              <a href="{{ url('agenda/'.$agd->id.'/edit') }}"><i class="fas fa-edit"></i></a>
                              <form action="{{ url('delete-agenda/'.$agd->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                <button type="submit" class="Sameline"><i class="far fa-times-circle"></i></i></button>
                              </form>
                              <i class="fas fa-trash-o"></i>
                            </div>
                          </li>

                        @endforeach 

                      </ul>
                    </div>
                    <br>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      <a href="{{ url('agenda/create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Ajouter note</a>
                    </div>
                </div>
  
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->
      <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
        </script>
@endsection
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
