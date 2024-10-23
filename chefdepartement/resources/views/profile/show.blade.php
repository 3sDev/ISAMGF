
 @extends('adminlayoutenseignant.layout')
 @section('title', 'Profil Admin')
 @section('contentPage')

 <link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Mon profil</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Mon profil</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <!-- /.card-header -->
                  <x-app-layout>                
                    <div>
                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                @livewire('profile.update-profile-information-form')
                
                                <x-jet-section-border />
                            @endif
                
                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.update-password-form')
                                </div>
                
                                <x-jet-section-border />
                            @endif
                
                            {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.two-factor-authentication-form')
                                </div>
                
                                <x-jet-section-border />
                            @endif --}}
                
                            {{-- <div class="mt-10 sm:mt-0">
                                @livewire('profile.logout-other-browser-sessions-form')
                            </div> --}}
                
                            {{-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                <x-jet-section-border />
                
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.delete-user-form')
                                </div>
                            @endif --}}
                        </div>
                    </div>
                </x-app-layout>
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->


@endsection




