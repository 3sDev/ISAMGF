@extends('adminlayoutenseignant.layout')
@section('title', 'Liste des messages')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Liste des messages</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Liste des messages</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />

<style>
.textable {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
.notView {
  font-weight: bold;
  color: black;
  font-size: 15px;
}

.view {
  font-weight: 500;
  color: rgb(94, 94, 94);
  font-size: 15px;
}

.typeMessage{
  padding: 5px 8px;
  background-color: aliceblue;
  color: rgb(111, 29, 188);
}
</style>

    <div class="row">
        @if (session('message'))
            <h5>{{ session('message') }}</h5>
        @endif

     

      <div class="col-md-3">

        <a href="{{ url('message/create') }}" class="btn btn-primary btn-block mb-3">Nouveau message</a>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Messagerie</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              {{-- <li class="nav-item active">
                <a class="nav-link active" href="#bre" data-toggle="tab">
                  <i class="fas fa-inbox"></i> Boite de Réception (Etudiants)
                  <span class="badge bg-danger float-right">{{$countMsgStudent}}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#mee" data-toggle="tab">
                  <i class="far fa-file-alt"></i> Messages envoyés (Etudiants)
                </a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="#brs" data-toggle="tab">
                  <i class="far fa-envelope"></i> Boite de Réception
                  <span class="badge bg-danger float-right">{{ $countMsgNotView }}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#mes" data-toggle="tab">
                  <i class="far fa-file-alt"></i> Messages envoyés
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#corbeille" data-toggle="tab">
                  <i class="far fa-trash-alt"></i> Corbeille
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="mailbox-controls">
              <!-- /.float-right -->
            </div>

            <div class="tab-content">

              <!-- /.mail-box-messages Etudiants -->
              {{-- <div class="active tab-pane" id="bre">
                <div class="card-header">
                  <h3 class="card-title">Liste des messages reçus - Etudiants</h3>
                </div>
                <br>
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Classe</th>
                            <th>Etudiant</th>
                            <th>Objet</th>
                            <th>Date</th> 
                            <th class="disabled-sorting text-right">Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($msgs as $msg)

                      @if ($msg->statut == 'false')
                      <tr>
                        <td class="notView">{{ $msg->id }}</td>
                        <td class="notView">{{ $msg->student->classe_id}}</td>
                        <td class="notView">{{ $msg->student->prenom .' '. $msg->student->nom }}</td>
                        <td class="notView"><span class="textable">{{ $msg->objet }}</span></td>
                        <td class="notView">{{ date('Y-m-d H:i', strtotime($msg->created_at)) }}</td>
                        <td class="text-right">
                          <a href="{{ url('message/'.$msg->id) }}" class="btn btn-link btn-info btn-just-icon like"><i class="nav-icon fas fa-eye"></i></a>
                        </td>
                        <td>
                          <form action="{{ url('students/'.$msg->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-danger btn-just-icon remove"><i class="fas fa-trash"></i></button>

                          </form>
                        </td>
                      </tr>

                      @elseif ($msg->statut == 'true')
                        <tr>
                          <td class="view">{{ $msg->id }}</td>
                          <td class="view">{{ $msg->student->classe_id}}</td>
                          <td class="view">{{ $msg->student->prenom .' '. $msg->student->nom }}</td>
                          <td class="view"><span class="textable">{{ $msg->objet }}</span></td>
                          <td class="view">{{ date('Y-m-d H:i', strtotime($msg->created_at)) }}</td>
                          <td class="text-right">
                            <a href="{{ url('message/'.$msg->id) }}" class="btn btn-link btn-info btn-just-icon like"><i class="nav-icon fas fa-eye"></i></a>
                          </td>
                          <td>
                            <form action="{{ url('students/'.$msg->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-link btn-danger btn-just-icon remove"><i class="fas fa-trash"></i></button>

                            </form>
                          </td>
                        </tr>
                      @endif

                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Classe</th>
                            <th>Etudiant</th>
                            <th>Objet</th>
                            <th>Date</th> 
                            <th class="disabled-sorting text-right">Actions</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <!-- /.mail-box-messages -->
              </div> --}}

              <!-- /.mail-box-messages Services -->
              {{-- <div class="tab-pane" id="mee">
                <div class="card-header">
                  <h3 class="card-title">Liste des messages envoyés - Etudiants</h3>
                </div>
                <br>
                <table id="example2" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Classe</th>
                            <th>Etudiant</th>
                            <th>Objet</th>
                            <th>Date</th> 
                            <th class="disabled-sorting text-right">Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($msgSend as $msgs)
                        
                      <tr>
                        <td>{{ $msgs->id }}</td>
                        <td>{{ $msgs->student->classe_id}}</td>
                        <td>{{ $msgs->student->prenom .' '. $msgs->student->nom }}</td>
                        <td><span class="textable">{{ $msgs->objet }}</span></td>
                        <td>{{ date('Y-m-d H:i', strtotime($msgs->created_at)) }}</td>
                        <td class="text-right">
                          <a href="{{ url('message/'.$msgs->id) }}" class="btn btn-link btn-info btn-just-icon like"><i class="nav-icon fas fa-eye"></i></a>
                        </td>
                        <td>
                          <form action="{{ url('students/'.$msgs->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-danger btn-just-icon remove"><i class="fas fa-trash"></i></button>

                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Classe</th>
                            <th>Etudiant</th>
                            <th>Objet</th>
                            <th>Date</th> 
                            <th class="disabled-sorting text-right">Actions</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <!-- /.mail-box-messages -->
              </div> --}}

              <!-- /.mail-box-messages Services -->
              <div class="active tab-pane" id="brs">
                <div class="card-header">
                  <h3 class="card-title">Liste des messages reçus ({{ $allMsgReceive }} messages)</h3>
                </div>
                <br>
                <table id="example3" class="table table-striped">
                    <thead>
                        <tr>
                            {{-- <th>ID2</th> --}}
                            <th>Objet</th>
                            <th>Envoyé par</th>
                            <th>Date</th> 
                            <th width="6%"></th>
                            <th width="6%"></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($msgSendService as $msgservice)

                      @if ($msgservice->statut == 'false')  
                      <tr>
                        {{-- <td class="notView">{{ $msgservice->id }}</td>                         --}}
                        <td class="notView"><span class="textable">{{ $msgservice->objet }}</span></td>
                        <td class="notView"><span class="textable">{{ $msgservice->user_sender->name }}</span></td>
                        
                        <td class="notView">{{ date('Y-m-d | H:i', strtotime($msgservice->created_at)) }}</td>
                        <td class="text-center">
                          <a href="{{ url('show-message-service/'.$msgservice->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                          {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
                        </td>
                        <td>
                          <form action="{{ url('corbeil-message/'.$msgservice->id) }}" method="POST" onsubmit="return confirm('Confirmation!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>

                      @elseif ($msgservice->statut == 'true')
                      <tr>
                        {{-- <td class="view">{{ $msgservice->id }}</td> --}}
                        <td class="view"><span class="textable">{{ $msgservice->objet }}</span></td>
                        <td class="view"><span class="textable">{{ $msgservice->user_sender->name }}</span></td>
                        <td class="view">{{ date('Y-m-d | H:i', strtotime($msgservice->created_at)) }}</td>
                        <td class="text-center">
                          <a href="{{ url('show-message-service/'.$msgservice->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                          {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
                        </td>
                        <td>
                          <form action="{{ url('corbeil-message/'.$msgservice->id) }}" onsubmit="return confirm('Confirmation!')">
                            <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endif

                      @endforeach
                    </tbody>
                </table>
                <!-- /.mail-box-messages -->
              </div>

              <!-- /.mail-box-messages Services -->
              <div class="tab-pane" id="mes">
                <div class="card-header">
                  <h3 class="card-title">Liste des messages envoyés ({{ $allMsgSend }} messages)</h3>
                </div>
                <br>
                <table id="example4" class="table table-striped">
                  <thead>
                      <tr>
                          {{-- <th>ID</th> --}}
                          <th>Objet</th>
                          <th>Envoyé vers</th>
                          <th>Date</th> 
                          <th width="6%"></th>
                          <th width="6%"></th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($msgReceivedService as $msgRS)
                      
                    <tr>
                      {{-- <td>{{ $msgRS->id }}</td> --}}
                      <td><span class="textable">{{ $msgRS->objet }}</span></td>
                      <td><span class="textable">{{ $msgRS->user_receiver->name }}</span></td>
                      <td>{{ date('Y-m-d | H:i', strtotime($msgRS->created_at)) }}</td>
                      <td class="text-center">
                        <a href="{{ url('message/'.$msgRS->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                        {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
                      </td>
                      <td>
                        <form action="{{ url('corbeil-message/'.$msgRS->id) }}" onsubmit="return confirm('Confirmation!')">
                          <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
              <!-- /.mail-box-messages -->
              </div>

                <!-- /.mail-box-messages Services -->
                <div class="tab-pane" id="corbeille">
                  <div class="card-header">
                    <h3 class="card-title">Corbeille</h3>
                  </div>
                  <br>
                  <table id="example1" class="table table-striped">
                      <thead>
                          <tr>
                              {{-- <th>ID2</th> --}}
                              <th>Objet</th>
                              <th>Service</th>
                              <th>Type</th>
                              <th>Date</th> 
                              <th width="6%"></th>
                              <th width="6%"></th>
                              <th width="6%"></th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($cacherMessage as $msgs)
                          
                        <tr>
                          {{-- <td>{{ $msgs->id }}</td> --}}
                          <td><span class="textable">{{ $msgs->objet }}</span></td>

                          @if ($msgs->user_sender_id == $idAdmin)
                            <td><span>{{ $msgs->user_receiver->name }}</span></td>
                            <td><span class="typeMessage">Message envoyé</span></td>
                          @else
                            <td><span>{{ $msgs->user_sender->name }}</span></td>
                            <td><span class="typeMessage">Message reçu</span></td>
                          @endif
                          
                          <td>{{ date('Y-m-d H:i', strtotime($msgs->created_at)) }}</td>
                          <td class="text-right">
                            <a href="{{ url('show-message-service/'.$msgs->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a>
                          </td>
                          <td>
                            <form action="{{ url('restaurer-message/'.$msgs->id) }}" onsubmit="return confirm('Restaurer ce message!')">
                              <button type="submit" class="btn btn-link btn-warning btn-just-icon remove btn-sm"><i class="fas fa-undo"></i></button>
                            </form>
                          </td>
                          <td>
                            <form action="{{ url('delete-message/'.$msgs->id) }}" onsubmit="return confirm('Supprimer définitivement')">
                              <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm" alt="restaurer"><i class="fas fa-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                  </table>
                  <!-- /.mail-box-messages -->
                </div>

            </div>

          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!}
@endsection