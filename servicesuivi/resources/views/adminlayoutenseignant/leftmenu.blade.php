  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboards') }}" class="brand-link">
      <img src="http://www.smartschools.tn/issat/storage/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Services de Suivi</span>
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
            <a class="nav-link {{ Request::is('pointages') ? 'active':''; }}" href="{{ url('pointages') }}">
              <i class="nav-icon fas fa-map-pin"></i>
              <p>
                Pointages enseignants
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('attendances') ? 'active':''; }}" href="{{ url('attendances') }}">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Absences enseignants
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
		  
		       <li class="nav-item">
            <a class="nav-link {{ Request::is('rattrapage') ? 'active':''; }}" href="{{ url('rattrapage') }}">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Avis de rattrapage
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('#') ? 'active':''; }}">
              <i class="nav-icon fas fa-braille"></i>
              <p>
                Disponibilité des locaux
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('salledisponible') ? 'active':''; }}" href="{{ url('salledisponible') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Emploi salles</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('sallestatut') ? 'active':''; }}" href="{{ url('sallestatut') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disponibilité Salles</p>
                </a>
              </li>
            </ul>
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
                <span class="badge badge-info right">2</span>
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