  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboards') }}" class="brand-link">
      <img src="http://www.smartschools.tn/issat/storage/AdminLTELogoIsam.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Service Scolarité</span>
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
            <a href="#" class="nav-link {{ Request::is('students') ? 'active':''; }}">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Gestion des étudiants
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('https://isamgafsa.tn/inscription/public/') ? 'active':''; }}" href="{{ url('https://isamgafsa.tn/inscription/public/') }}" target="_blank">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ajouter étudiant</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('students') ? 'active':''; }}" href="{{ url('students') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inscription étudiants</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('import-student') ? 'active':''; }}" href="{{ url('import-student') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Importer étudiants</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('search-student') ? 'active':''; }}" href="{{ url('search-student') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rechercher étudiant</p>
                </a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link {{ Request::is('classe-student') ? 'active':''; }}" href="{{ url('classe-student') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Etudiant par classe</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('filtrage') ? 'active':''; }}" href="{{ url('filtrage') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Filtrage des Etudiants </p>
                </a>
              </li>
            </ul>
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
            <a class="nav-link {{ Request::is('reclamations') ? 'active':''; }}" href="{{ url('reclamations') }}">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Reclamations Etudiants
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
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Gestion des absences
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('classe-student-attendance') ? 'active':''; }}" href="{{ url('classe-student-attendance') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Absence des étudiants</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('justifications') ? 'active':''; }}" href="{{ url('justifications') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Absence justifié</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('eliminations') ? 'active':''; }}" href="{{ url('eliminations') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Elimination absences</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('exportations') ? 'active':''; }}" href="{{ url('exportations') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exportation</p>
                </a>
              </li> --}}
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('emploi') ? 'active':''; }}" href="{{ url('emploi') }}">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Emploi de temps Groupe
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