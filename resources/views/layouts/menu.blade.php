@if (Route::has('login'))
@auth
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href="{{asset('/images/LOGO_Centro_Medico_Diaz.png')}}">
  <title>ERP::CMD</title>

  @include('layouts.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('/images/LOGO_Centro_Medico_Diaz.png')}}" alt="AdminLTELogo" height="260" width="260">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>            
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('vendors/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('vendors/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('vendors/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{ Auth::user()->username }}<i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ Auth::user()->username }}</span>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                          {{ __('Cerrar sesion') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>           
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" id="" href="{{url('/configuraciones/usuario/cambio-calve')}}" ><i class=""></i>Cambiar Contraseña</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('/images/LOGO_Centro_Medico_Diaz.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Centro Médico Díaz</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('vendors/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('/')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->                    

          @if (session('menu_configuracion')=='1')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configurar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (session('ventana_configuracion_empleado')=='1')
              <li class="nav-item">
                <a href="{{asset('/empleado')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empleado</p>
                </a>
              </li>
              @endif
              @if (session('ventana_configuracion_usuario')=='1')
<!--              <li class="nav-item">
                <a href="{{asset('/configuraciones/registrar')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>-->
              @endif
            </ul>
          </li>
          @endif
          @if(session('rcp_menu_recepcion')=='1')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-regular fa-bell"></i>
              <p>
                RECEPCIÓN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (session('rcp_vista_recepcion')=='1')
              <li class="nav-item">
                <a href="{{route('vista_recepcion')}}" class="nav-link">
                  <i class="nav-icon fas fa-hospital-user"></i>
                  <p>Pacientes</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          
         @if(session('menu_medico')=='1')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa fa-briefcase-medical "></i>
              <p>
                MÉDICO
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (session('ventana_medico_remisiones')=='1')
              <li class="nav-item">
                <a href="{{asset('/medico/sala-espera/remisiones')}}" class="nav-link">
                  <i class="nav-icon fa fa-restroom"></i>
                  <p>Sala de Espera</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if(session('menu_farmacia')=='1')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa fa-pills"></i>
              <p>
                FARMACIA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (session('far_leer_recetas')=='1')
              <li class="nav-item">
                <a href="{{asset('/farmacia/recetas')}}" class="nav-link">
                  <i class="nav-icon fa fa-receipt"></i>
                  <p>Recetas</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if(session('med_leer_historial_clinico')=='1')
          <li class="nav-item">
            <a href="{{asset('/historial-clinico-pacientes')}}" class="nav-link">
              <i class="nav-icon fas fa-book-medical"></i>
              <p>
                Historial Clínico
              </p>
            </a>
          </li>
          @endif

          @if(session('arc_leer_archivos')=='1')
          <li class="nav-item">
            <a href="{{asset('/archivos-pacientes')}}" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Archivos
              </p>
            </a>
          </li>
          @endif

          <!--<li class="nav-header">EXAMPLES</li>-->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->



  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="">CMD</a>.</strong>
    Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('layouts.scripts')
@yield('scripts')
</body>
</html>
@else
<h1>SIN ACCESO</h1>
@endauth
@endif
