  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="http://www.smartschools.tn/issat/storage/AdminLTELogoIsam.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Service de stages</span>
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
            <a class="nav-link {{ Request::is('avis') ? 'active':''; }}" href="{{ url('avis') }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Gestion des avis
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('events') ? 'active':''; }}" href="{{ url('events') }}">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Gestion des événements 
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('news') ? 'active':''; }}" href="{{ url('news') }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Gestion des actualités 
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('maps') ? 'active':''; }}" href="{{ url('maps') }}">
              <i class="nav-icon fas fa-map"></i>
              <p>
                Vie estudiantine 
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('avis') ? 'active':''; }}" href="{{ url('avis') }}">
              <i class="nav-icon fas fa-flag"></i>
              <p>
                Gestion des avis 
                /* <span class="right badge badge-danger">New</span> */ 
              </p>
            </a>
          </li> --}}

          {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('bibliotheques') ? 'active':''; }}" href="{{ url('bibliotheques') }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Gestion de Bibliothèque 
              </p>
            </a>
          </li> --}}

         {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('pointages') ? 'active':''; }}" href="{{ url('pointages') }}">
              <i class="nav-icon fas fa-map-pin"></i>
              <p>
                Pointages enseignants
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('attendances') ? 'active':''; }}" href="{{ url('attendances') }}">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Absences enseignants
              </p>
            </a>
          </li>--}}

          {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('clubs') ? 'active':''; }}" href="{{ url('clubs') }}">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Gestion de clubs 
              </p>
            </a>
          </li> --}}

          {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('stages') ? 'active':''; }}" href="{{ url('stages') }}">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>
                Gestion de stages 
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('#') ? 'active':''; }}">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>
                Gestion des stages 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('pfe') ? 'active':''; }}" href="{{ url('pfe') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PFE + Mémoire</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('encadrement') ? 'active':''; }}" href="{{ url('encadrement') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Encadrement</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('professionnel') ? 'active':''; }}" href="{{ url('professionnel') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stage Professionnel</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('#') ? 'active':''; }}">
              <i class="nav-icon fas fa-puzzle-piece"></i>
              <p>
                Gestion des activités
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link {{ Request::is('#') ? 'active':''; }}">
                  <i class="nav-icon fas fa-sitemap"></i>
                  <p>
                    Clubs
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a class="nav-link {{ Request::is('clubStudents') ? 'active':''; }}" href="{{ url('clubStudents') }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Gestion Clubs</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ Request::is('clubs') ? 'active':''; }}" href="{{ url('clubs') }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Demandes Clubs</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('sorties') ? 'active':''; }}" href="{{ url('sorties') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sorties</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('missions') ? 'active':''; }}" href="{{ url('missions') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Missions</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('offres') ? 'active':''; }}" href="{{ url('offres') }}">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Gestion de offres 
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('downloads') ? 'active':''; }}" href="{{ url('downloads') }}">
              <i class="nav-icon fas fa-download"></i>
              <p>
                Espace téléchargements
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