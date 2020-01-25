
<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>IITSCO - SISTEMAS</title>

  <!-- Custom fonts for this template-->
  <link href="{{ URL::asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ URL::asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- data tables -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <style>
    input {text-transform: uppercase;}
    label {text-transform: uppercase;}
    button {text-transform: uppercase;}
    a {text-transform: uppercase;}
    textarea {text-transform: uppercase;}
    select {text-transform: uppercase;}
    table {text-transform: uppercase; font-size: 10}
  </style>

</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3" >ANALISIS DE SISTEMAS <sup>S</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->

      <li class="nav-item active">
        <a class="nav-link" href="{{url('home')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>itsco </span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Interface
        </div>
        @if (auth()->check())
        <!-- Nav Item - Pages Collapse Menu -->
        {{-- @if (! auth()->user()->is_client) --}}
        {{-- <li @if(request()->is('ver')) class="active" @endif> --}}
          {{-- <a href="/ver">Ver incidencias</a> --}}
        {{-- </li> --}}
        {{-- @endif --}}
        @if (auth()->user()->is_admin)
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Administrador</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">USUARIO</h6>
              <a class="collapse-item" href="{{url('usuarios')}}">Usuarios</a>
              <a class="collapse-item" href="{{url('equipos')}}">Equipos</a>
              <a class="collapse-item" href="{{url('marcas')}}">Marcas</a>
              <a class="collapse-item" href="{{url('modelos')}}">Modelos</a>
              
            </div>
          </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Asignacion</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">equipos</h6>
              <a class="collapse-item" href="{{url('Equipo-marca')}}">Asignacion de Equipo</a>
              <a class="collapse-item" href="{{url('AsAdministrador')}}">Incidencias</a>
              <a class="collapse-item" href="{{url('preventivo')}}">Preventivo</a>
            </div>
          </div>
        </li>
        @endif

        @if (auth()->user()->is_client  )

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Cliente</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">USUARIO</h6>
              <a class="collapse-item" href="{{url('AsCliente')}}">Incidencias</a>
              <a class="collapse-item" href="{{url('Asignacion')}}">Generar <br/> Incidencias</a>
              <a class="collapse-item" href="{{url('preventivo/cliente')}}">Mantenimiento <br/> Preventivo</a>

            </div>
          </div>
        </li>


        @endif

        @if (auth()->user()->is_support)

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Soporte</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">USUARIO</h6>
              <a class="collapse-item" href="{{url('AsSoporte')}}">Incidencias</a>
              <a class="collapse-item" href="{{url('Asignacion')}}">Generar <br/> Incidencias</a>
              <a class="collapse-item" href="{{url('preventivo/soporte')}}">Mantenimiento <br/> Preventivo</a>
            </div>
          </div>
        </li>


        @endif
        <!-- Divider -->
       @if(auth()->user()->is_admin){

        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Addons
        </div>

        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Reporte</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Reporte:</h6>
              <a class="collapse-item" href="{{url('reporte')}}" target="_BLANK">Reporte Principal</a>
    
            </div>
          </div>
        </li>
}@endif
        <!-- Nav Item - Charts -->
        

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
              <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

          </ul>
          <!-- End of Sidebar -->

          <!-- Content Wrapper -->

          <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

              <!-- Topbar -->
              <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
 <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiB6UcPV58dBeVdkiN63ZboxZOBPxmVtf_AFhJ5Wc9N-4Z_UsC&s" width="150px;" />
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                  <!-- Nav Item - Alerts -->


                  <div class="topbar-divider d-none d-sm-block"></div>

                  <!-- Nav Item - User Information -->
                  <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->rdbtnombre}}&nbsp; {{Auth::user()->rdbtapellido}}</span>
                      <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                     
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Salir
                      </a>
                    </div>
                  </li>

                </ul>

              </nav>
              @yield('content')
              <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

          </div>
          <!-- End of Page Wrapper -->

          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
          </a>

          <!-- Logout Modal-->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">SESION</span>
                  </button>
                </div>
                <div class="modal-body">desea cerrar sesion.</div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">CancelAR</button>
                  <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  SALIR
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ URL::asset('/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ URL::asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ URL::asset('/js/sb-admin-2.min.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{ URL::asset('/vendor/chart.js/Chart.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ URL::asset('/js/demo/chart-area-demo.js')}}"></script>
        <script src="{{ URL::asset('/js/demo/chart-pie-demo.js')}}"></script>
        <script src="{{URL::asset('/js/app.js')}}"></script>

        <!-- datatables-->
        @endif
        @yield('scripts')
      </body>

      </html>
