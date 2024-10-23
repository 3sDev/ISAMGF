  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboards') }}" class="brand-link">
      <img src="http://www.smartschools.tn/issat/storage/AdminLTELogoIsam.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Service Examens</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item {{ Request::is('dashboards') ? 'active':''; }}" href="{{ url('dashboards') }}">
            <a class="nav-link {{ Request::is('dashboards') ? 'active':''; }}" href="{{ url('dashboards') }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('#') ? 'active':''; }}">
              <i class="nav-icon fas fa-paste"></i>
              <p>
                Gestion des avis
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('avis') ? 'active':''; }}" href="{{ url('avis') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Avis Etudiants</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('avisTeacher') ? 'active':''; }}" href="{{ url('avisTeacher') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Avis Enseignants</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('notes') ? 'active':''; }}" href="{{ url('notes') }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Gestion des notes
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('demandestudent') ? 'active':''; }}" href="{{ url('demandestudent') }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Demandes Etudiants
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ Request::is('emploiExamens') ? 'active':''; }}" href="{{ url('emploiExamens') }}">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Calendrier des examens
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('emploiSurveillances') ? 'active':''; }}" href="{{ url('emploiSurveillances') }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Surveillance Enseignants
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-header" style="border-top: 1px solid #ccc;">Info Admin</li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('profile.show') ? 'active':''; }}" href="{{ url('profile.show') }}">
              <i class="nav-icon far fa-user"></i>
              <p>
                Mon Profil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('message') ? 'active':''; }}" href="{{ url('message') }}">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Messagerie
              </p>
            </a>
          </li>
          <li class="nav-item">
            @if (auth()->id())
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <div class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                          this.closest('form').submit(); " role="button">
                          <i class="nav-icon far fa-play-circle"></i>
                          {{ __('Déconnecter') }}
                      </a>
                  </div>
              </form>
            @endif
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>