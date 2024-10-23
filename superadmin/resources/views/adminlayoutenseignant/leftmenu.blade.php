  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="http://www.smartschools.tn/issat/storage/AdminLTELogoIsam.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      {{-- <img src="https://www.smartschools.tn/issat/storage/logo-issat.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">Super Admin</span>
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
                Consultation des avis
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('locaux') ? 'active':''; }}">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Gestion Enseignants
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('teachers') ? 'active':''; }}" href="{{ url('teachers') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste des Enseignants</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('pointages') ? 'active':''; }}" href="{{ url('pointages') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pointages enseignants</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('attendances') ? 'active':''; }}" href="{{ url('attendances') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Absences enseignants</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('locaux') ? 'active':''; }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gestion Personnels
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('personnels') ? 'active':''; }}" href="{{ url('personnels') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Liste des personnels</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('postePersonnels') ? 'active':''; }}" href="{{ url('postePersonnels') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Postes des personnels</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('attendancePersonnels') ? 'active':''; }}" href="{{ url('attendancePersonnels') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Absences personnels</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('locaux') ? 'active':''; }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Gestion demandes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('demandeEtudiant') ? 'active':''; }}" href="{{ url('demandeEtudiant') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demande étudiant</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('demandeEnseignant') ? 'active':''; }}" href="{{ url('demandeEnseignant') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demande enseignant</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('demandePersonnel') ? 'active':''; }}" href="{{ url('demandePersonnel') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demande personnel</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('locaux') ? 'active':''; }}">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Gestion reclamations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('reclamationEtudiant') ? 'active':''; }}" href="{{ url('reclamationEtudiant') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reclamation étudiant</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('reclamationEnseignant') ? 'active':''; }}" href="{{ url('reclamationEnseignant') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reclamation enseignant</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('reclamationPersonnel') ? 'active':''; }}" href="{{ url('reclamationPersonnel') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reclamation personnel</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('#') ? 'active':''; }}">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Gestion Département
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ Request::is('matieres') ? 'active':''; }}" href="{{ url('matieres') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Matières</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('salles') ? 'active':''; }}" href="{{ url('salles') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Salles</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('all-classes') ? 'active':''; }}" href="{{ url('all-classes') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Classes</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::is('departements') ? 'active':''; }}" href="{{ url('departements') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Départements</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('demandestudent') ? 'active':''; }}" href="{{ url('demandestudent') }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Demandes Etudiants
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('reclamations') ? 'active':''; }}" href="{{ url('reclamations') }}">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Reclamations Etudiants
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link {{ Request::is('liens') ? 'active':''; }}" href="{{ url('liens') }}">
              <i class="nav-icon fas fa-link"></i>
              <p>
                Liens Utils
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('missions') ? 'active':''; }}" href="{{ url('missions') }}">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
                Gestion des ordres
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          {{-- <li class="nav-item">
            <a class="nav-link {{ Request::is('reclamations') ? 'active':''; }}" href="{{ url('reclamations') }}">
              <i class="nav-icon fas fa-exclamation-triangle"></i>
              <p>
                Réclamations Personnels
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link {{ Request::is('admins') ? 'active':''; }}" href="{{ url('admins') }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gestion des admins
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

          <li class="nav-item">
            <a class="nav-link {{ Request::is('edit-variable') ? 'active':''; }}" href="{{ url('edit-variable') }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Variables Globales
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