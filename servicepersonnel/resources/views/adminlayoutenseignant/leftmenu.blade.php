  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="https://www.smartschools.tn/isamgf/storage/AdminPersonnels.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Service Personnels</span>
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
            <a class="nav-link {{ Request::is('personnels') ? 'active':''; }}" href="{{ url('personnels') }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gestion des personnels
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('demandepersonnel') ? 'active':''; }}" href="{{ url('demandepersonnel') }}">
              <i class="nav-icon fas fa-clone"></i>
              <p>
                Gestion des demandes
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('#') ? 'active':''; }}">
              <i class="nav-icon fas fa-eraser"></i>
              <p>
                Gestions des congés 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('soldes') ? 'active':''; }}" href="{{ url('soldes') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Soldes</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('conges') ? 'active':''; }}" href="{{ url('conges') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Congés</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('attendances') ? 'active':''; }}" href="{{ url('attendances') }}">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                Gestion des présences
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('formations') ? 'active':''; }}" href="{{ url('formations') }}">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Gestion des formations  
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('avis') ? 'active':''; }}" href="{{ url('avis') }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Gestion des avis
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('missions') ? 'active':''; }}" href="{{ url('missions') }}">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Orders & Missions
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('notes') ? 'active':''; }}" href="{{ url('notes') }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Notes professionnels 
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('reclamations') ? 'active':''; }}" href="{{ url('reclamations') }}">
              <i class="nav-icon fas fa-exclamation-triangle"></i>
              <p>
                Gestion des reclamations
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-header">Info Admin</li>
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
                {{-- <span class="badge badge-info right">2</span> --}}
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