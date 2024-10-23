<!--
=========================================================
Smart Institute - v1.0
=========================================================

Product Page: https://www.sss.com.tn
Copyright 2022 3S
Coded by MMB

=========================================================
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @livewireStyles
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  <title>
    @yield('title')
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="https://www.smartschools.tn/issat/storage/logo.png" alt="AdminLTELogo" height="80" width="80">
  </div>

  <!-- Navbar -->
 @component('adminlayoutenseignant.topmenu')
 @endcomponent
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @component('adminlayoutenseignant.leftmenu')
  @endcomponent

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @component('adminlayoutenseignant.header')
    @endcomponent
    <!-- /.content-header -->
    @component('adminlayoutenseignant.content')
    @endcomponent
    <!-- Main content -->

  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
@component('adminlayoutenseignant.footer')
@endcomponent

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Script Files -->
@component('adminlayoutenseignant.jsfile')
@endcomponent

@stack('modals')
@livewireScripts

</body>
</html>
