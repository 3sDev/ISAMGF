@extends('adminlayoutscolarite.layout')
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
<link rel="stylesheet" href="{{ URL::asset('css/modal.css') }}" />

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
</style>

    <div class="row">
        @if (session('message'))
            <h5>{{ session('message') }}</h5>
        @endif

     

      <div class="col-md-3">

        <a href="{{ url('message/create') }}" class="btn btn-primary btn-block mb-3">Nouveau message</a>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">1. Messagerie étudiants</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              <li>
              <li class="nav-item active">
                <a class="nav-link active" href="#bre" data-toggle="tab">
                  <i class="fas fa-inbox"></i> Boite de Réception 
                  <span class="badge bg-danger float-right">{{$countMsgStudent}}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#mee" data-toggle="tab">
                  <i class="far fa-file-alt"></i> Messages envoyés 
                </a>
              </li>
              <div class="card-header">
                <h3 class="card-title">2. Messagerie personnels</h3>
    
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <li class="nav-item">
                <a class="nav-link" href="#brs" data-toggle="tab">
                  <i class="far fa-envelope"></i> Boite de Réception
                  <span class="badge bg-danger float-right">{{$countMsgService}}</span>
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
        {{-- <div class="card">
          <div class="card-header">
            <h3 class="card-title">Labels</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle text-danger"></i>
                  Important
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle text-warning"></i> Promotions
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle text-primary"></i>
                  Social
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div> --}}
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
              <div class="active tab-pane" id="bre">
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
                          {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
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
                            {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
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
              </div>

              <!-- /.mail-box-messages Services -->
              <div class="tab-pane" id="mee">
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
                          {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
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
              </div>

              <!-- /.mail-box-messages Services -->
              <div class="tab-pane" id="brs">
                <div class="card-header">
                  <h3 class="card-title">Liste des messages reçus - Services</h3>
                </div>
                <br>
                <table id="example3" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID2</th>
                            <th>Objet</th>
                            <th>Message</th>
                            <th>Date</th> 
                            <th class="disabled-sorting text-right">Actions</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($msgSendService as $msgservice)

                      @if ($msgservice->statut == 'false')  
                      <tr>
                        <td class="notView">{{ $msgservice->id }}</td>                        
                        <td class="notView"><span class="textable">{{ $msgservice->objet }}</span></td>
                        <td class="notView"><span class="textable">{{ $msgservice->message }}</span></td>
                        
                        <td class="notView">{{ date('Y-m-d H:i', strtotime($msgservice->created_at)) }}</td>
                        <td class="text-right">
                          <a href="{{ url('message/'.$msgservice->id) }}" class="btn btn-link btn-info btn-just-icon like"><i class="nav-icon fas fa-eye"></i></a>
                          {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
                        </td>
                        <td>
                          <form action="{{ url('students/'.$msgservice->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-danger btn-just-icon remove"><i class="fas fa-trash"></i></button>

                          </form>
                        </td>
                      </tr>

                      @elseif ($msgservice->statut == 'true')
                      <tr>
                        <td class="view">{{ $msgservice->id }}</td>
                        <td class="view"><span class="textable">{{ $msgservice->objet }}</span></td>
                        <td class="view"><span class="textable">{{ $msgservice->message }}</span></td>
                        <td class="view">{{ date('Y-m-d H:i', strtotime($msgservice->created_at)) }}</td>
                        <td class="text-right">
                          <a href="{{ url('message/'.$msgservice->id) }}" class="btn btn-link btn-info btn-just-icon like"><i class="nav-icon fas fa-eye"></i></a>
                          {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
                        </td>
                        <td>
                          <form action="{{ url('students/'.$msgservice->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
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
                            <th>Objet</th>
                            <th>Message</th>
                            <th>Date</th> 
                            <th class="disabled-sorting text-right">Actions</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <!-- /.mail-box-messages -->
              </div>

              <!-- /.mail-box-messages Services -->
              <div class="tab-pane" id="mes">
                <div class="card-header">
                  <h3 class="card-title">Liste des messages envoyés - Services</h3>
                </div>
                <br>
                <table id="example4" class="table table-striped">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Objet</th>
                          <th>Message</th>
                          <th>Date</th> 
                          <th class="disabled-sorting text-right">Actions</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($msgReceivedService as $msgRS)
                      
                    <tr>
                      <td>{{ $msgRS->id }}</td>
                      <td><span class="textable">{{ $msgRS->objet }}</span></td>
                      <td><span class="textable">{{ $msgRS->message }}</span></td>
                      <td>{{ date('Y-m-d H:i', strtotime($msgRS->created_at)) }}</td>
                      <td class="text-right">
                        <a href="{{ url('message/'.$msgRS->id) }}" class="btn btn-link btn-info btn-just-icon like"><i class="nav-icon fas fa-eye"></i></a>
                        {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
                      </td>
                      <td>
                        <form action="{{ url('students/'.$msgRS->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this data?')">
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
                          <th>Objet</th>
                          <th>Message</th>
                          <th>Date</th> 
                          <th class="disabled-sorting text-right">Actions</th>
                          <th></th>
                      </tr>
                  </tfoot>
              </table>
              <!-- /.mail-box-messages -->
              </div>

                <!-- /.mail-box-messages Services -->
                <div class="tab-pane" id="corbeille">
                  <div class="card-header">
                    <h3 class="card-title">Corbeille</h3>
                  </div>
                  <br>
                  <table id="example5" class="table table-striped">
                      <thead>
                          <tr>
                              <th>ID2</th>
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
                            {{-- <a href="{{ url('message/'.$msg->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit"><i class="fas fa-pencil-alt"></i></a> --}}
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
                </div>

            </div>

          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    @endsection