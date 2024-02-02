<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" >
       
        <div class="sidebar-brand-text mx-3">Data Payroll</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">                      

  
    <!-- Heading -->
    <li class="nav-item {{ Request::is('user/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('user.index')}}">
            
            <span>Users</span></a>
    </li>

    <li class="nav-item {{ Request::is('kcu/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('kcu.index')}}">
            
            <span>Data KCU</span></a>
    </li>

    <li class="nav-item {{ Request::is('dataleads/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('dataleads.index')}}"> 
            <span>Data Leads</span></a>
    </li>


    <li class="nav-item {{ Request::is('bedabulan/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('bedabulan.index')}}"> 
            <span>Data Akuisisi Bulan Lain</span></a>
    </li>

    <li class="nav-item {{ Request::is('usagebedabulan/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('usagebedabulan.index')}}"> 
            <span>Data Usage  Bulan Lain</span></a>
    </li>


    <li class="nav-item {{ Request::is('rekapcall/index') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('rekapcall.index')}}"> 
            <span>Import Data</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
          
            <span>Import Data</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('rekapcall.index')}}">Rekap Call</a>
                <a class="collapse-item" href="#">Rekap Akuisisi Payroll</a>
               
            </div>
        </div>
    </li> -->

    <!-- Nav Item - Tables -->
   

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">



</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

           
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Search -->
           

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                                    
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                        <img class="img-profile rounded-circle"
                            src="{{asset('img/undraw_profile.svg')}}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                       
                        <a class="dropdown-item" href="{{ route('password') }}">
                            <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                            Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>