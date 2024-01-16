<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Data Payroll</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
</head>

<body id="page-top">    
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


                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- <button id="exportPdfButton" class="btn btn-primary mb-2 btn-sm">Export to PDF</button> -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <button id="exportPdfButton" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Download Report</button> -->
                    </div>
                    
                    <div class="Download">
                        <button id="exportPdfButton" style="float: right;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i
                                class="fas fa-download fa-sm text-white-50"></i> Download Report By Step</button>
                   


                        <button id="exportPdfButtonStatus" style="float: right; margin-right:6px;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Download Report by Status</button>

                                <button id="exportPdfButtonAkuisisi" style="float: right; margin-right:6px;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Download Report Akuisisi</button>
                                </div>

                                
<br>
<br>
<br>
                <form action="{{ route('filter-data') }}" method="post">

                
    @csrf

    @include('components.alert')

    
    
                <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-2 col-md-6 mb-4">
    <div class="form-group">
        <label for="exampleInputEmail1">KCU</label>
        <select name="kcu" class="form-select form-control form-select-sm" aria-label=".form-select-sm example">
            <option value="" selected disabled>Pilih KCU </option>
            @foreach ($kcu as $item)
                <option value="{{ $item->id }}" {{ (isset($selectedKCU) && $selectedKCU == $item->id) ? 'selected' : '' }}>
                    {{ $item->nama_kcu }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-2 col-md-6 mb-4">   
    <div class="form-group">
        <label for="exampleInputEmail1">Jenis Data</label>
        <select name="jenis_data" class="form-select form-select-sm form-control" aria-label=".form-select-sm example">
            <option value="" selected disabled>Pilih Jenis Data</option>
            <option value="Referral" {{ (isset($selectedJenis) && $selectedJenis == 'Referral') ? 'selected' : '' }}>Referral</option>
            <option value="Data Leads" {{ (isset($selectedJenis) && $selectedJenis == 'Data Leads') ? 'selected' : '' }}>Data Leads</option>
        </select>
    </div>
</div>



<div class="col-xl-2 col-md-6 mb-4">
<a  id='tanggal_awal'>
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal Awal</label>
        <input type="text" id="awal_value" name="tanggal_awal" class="form-control" id="exampleInputEmail1" aria-describedby="date"
               value="{{ isset($tanggalAwal) ? $tanggalAwal : '' }}" autocomplete="off">
    </div>
</a>
</div>

<div class="col-xl-2 col-md-6 mb-4">
    <a  id='tanggal_akhir'>
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal Akhir</label>
        <input type="text" id="akhir_value" name="tanggal_akhir" class="form-control" id="exampleInputEmail1" aria-describedby="date"
               value="{{ isset($tanggalAkhir) ? $tanggalAkhir : '' }}" autocomplete="off">
    </div>
</a>
</div>


<div class="col-xl-2 col-md-6 mb-4">

<div class="form-group">
    <label for="exampleInputEmail1">      </label>
    <button type="submit" class="btn btn-primary btn-sm form-control mt-2">Filter</button>
  </div>
  
</div>

</form>


</div>

<div id ="chartnew">

<div id ="chartstatus">
                        <!-- Content Row -->
                        
                        <h5 class="mb-0 text-black-800 mb-3">Data by Step</h5>
    <hr>
                        <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                       Total Interested</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalBerminat}} ({{ $persentaseBerminat}} %)</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-success text-uppercase mb-1">
                        Total Contacted</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalContacted}} ({{ $persentaseContacted}} %)</div>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- Tasks Card Example -->
<!-- <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-warning text-uppercase mb-1">
                        Total Closing</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalClosing}}({{$persentaseClosing}} %)</div>
                </div>
              
            </div>
        </div>
    </div>
</div> -->


</div>

<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-danger text-uppercase mb-1">
                       Total Uncontacted</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalUnContacted}} ({{ $persentaseUnContacted}} %)</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-info text-uppercase mb-1">
                       Total Not Call Yet</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalNotCall}} ({{ $persentaseNotCall}} %)</div>
                </div>
               
            </div>
        </div>
    </div>
</div>

<div>


<div class="row">
<!-- Pie Chart -->
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Total Interested</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartInterested"></canvas>
            </div>
            
        </div>
    </div>
</div>
<!-- Pie Chart -->
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Total Contacted</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartContacted"></canvas>
            </div>
            
        </div>
    </div>
</div>


<!-- Pie Chart -->
<!-- <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Total Closing</h6>
           
        </div>
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartClosing"></canvas>
            </div>
            
        </div>
    </div>
</div> -->



</div>



<div class="row">
<!-- Pie Chart -->
<div class="col-xl-6 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Total Uncontacted</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartUncontacted"></canvas>
            </div>
            
        </div>
    </div>
</div>
<!-- Pie Chart -->
<div class="col-xl-6 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Total Not Call Yet</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartNotCall"></canvas>
            </div>
            
        </div>
    </div>
</div>


<!-- Pie Chart -->

</div>
</div>

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="">
         
  <canvas id="myChart"></canvas>


            </div>
          <!-- <small class="text-danger">
            Minggu di bagi dalam kelipatan 7
          </small> -->
        </div>
    </div>

</div>

</div>

<br>


<div id="chartchart">

<h5 class="mb-0 text-black-800 mb-3">Data by Status</h5>
    <hr>
 
                        <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                        Berminat</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Berminat}} ({{ $persentaseStatusBerminat}} %) </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-dark text-uppercase mb-1">
                        Tidak Berminat</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$TidakBerminat}} ({{ $persentaseStatusTidakBerminat}} %)</div>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- Tasks Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-warning text-uppercase mb-1">
                        Tidak Terhubung</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$TidakTerhubung}} ({{$persentaseStatusTidakTerhubung}} %)</div>
                </div>
              
            </div>
        </div>
    </div>
</div>


</div>

<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-danger text-uppercase mb-1">
                       No. Telp Tidak Valid</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$NoTelpTidakValid}} ({{ $persentaseStatusNoTelpTidakValid}} %)</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-success text-uppercase mb-1">
                        Diskusi Internal</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$DiskusiInternal}} ({{ $persentaseStatusDiskusiInternal}} %)</div>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- Tasks Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-info text-uppercase mb-1">
                        Call Again</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$CallAgain}} ({{$persentaseStatusCallAgain}} %)</div>
                </div>
              
            </div>
        </div>
    </div>
</div>




<!-- Area Chart -->


<div class="row">
<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Berminat</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartBerminat"></canvas>
            </div>
            
        </div>
    </div>
</div>
<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tidak Berminat</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartTidakBerminat"></canvas>
            </div>
            
        </div>
    </div>
</div>


<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tidak Terhubung</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartTidakTerhubung"></canvas>
            </div>
            
        </div>
    </div>
</div>


</div>
</div>


<div class="row">
<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">No Telp Tidak Valid</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartNoTelpTidakValid"></canvas>
            </div>
            
        </div>
    </div>
</div>
<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Diskusi Internal</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartDiskusiInternal"></canvas>
            </div>
            
        </div>
    </div>
</div>


<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Call Again</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartCallAgain"></canvas>
            </div>
            
        </div>
    </div>
</div>


</div>


<div id="barchart"> 
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="">
         
  <canvas id="myChartStatus"></canvas>

            </div>
            <!-- <small class="text-danger">
            Minggu di bagi dalam kelipatan 7
          </small> -->
        </div>
    </div>
    </div>
    

    </div>


    </div>


    <br>

    <div id="chartakuisisi">
    <h5 class="mb-0 text-black-800 mb-3">Data by Akuisisi</h5>
    <hr>

    <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                       Akuisisi (Closing)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Akuisisi}} ({{ $persentaseAkuisisi}} %)</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-success text-uppercase mb-1">
                        Reaktivasi</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Reaktivasi}} ({{ $persentaseReaktivasi}} %)</div>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!-- Tasks Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-warning text-uppercase mb-1">
                       Migrasi Limit</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$MigrasiLimit}}({{$persentaseMigrasiLimit}} %)</div>
                </div>
              
            </div>
        </div>
    </div>
</div>


</div>

<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-danger text-uppercase mb-1">
                       Not Ok</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$NotOk}} ({{ $persentaseNotOk}} %)</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Annual) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-info text-uppercase mb-1">
                      Waiting Confirmation</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$waitingconfirm}} ({{ $persentasewaitingconfirm}} %)</div>
                </div>
               
            </div>
        </div>
    </div>
</div>

<div>
<div class="row">
<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Akuisisi</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartAkuisisi"></canvas>
            </div>
            
        </div>
    </div>
</div>


<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Reaktivasi</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartReaktivasi"></canvas>
            </div>
            
        </div>
    </div>
</div>


<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Migrasi Limit</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartMigrasiLimit"></canvas>
            </div>
            
        </div>
    </div>
</div>

<div class="row">
<!-- Pie Chart -->
<div class="col-xl-6 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Not Ok</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartNotOk"></canvas>
            </div>
            
        </div>
    </div>
</div>


<div class="col-xl-6 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Waiting Confirmation</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartwaitingconfirm"></canvas>
            </div>
            
        </div>
    </div>
</div>
</div>


<div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="">
         
  <canvas id="myChartAkuisisi"></canvas>


            </div>
          <!-- <small class="text-danger">
            Minggu di bagi dalam kelipatan 7
          </small> -->
        </div>
    </div>

</div>

</div>

</div>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
<script>

@if(isset($monthlyData))
var monthlyData = @json($monthlyData);

var labels = monthlyData.map(function (data) {
    return data.monthName;
});

var contactedData = monthlyData.map(function (data) {
    return data.totalContacted;
});

var interestedData = monthlyData.map(function (data) {
    return data.totalBerminat;
});





    var notcallData = monthlyData.map(function (data) {
    return data.totalNotCall;
});

  

    var uncontactedData = monthlyData.map(function (data) {
    return data.totalUnContacted;
});


var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Contacted',
            data: contactedData,
            backgroundColor: '#36A2EB',
            barThickness: 10,
            borderWidth: 1,
        }, {
            label: 'Interested',
            data: interestedData,
            backgroundColor: '#FF9F40',
            borderWidth: 1,
            barThickness: 10,
        }, {
                label: 'Not Call Yet',
                data: notcallData,
                backgroundColor: '#9966FF',
                borderWidth: 1,
                barThickness: 10,
            },
            {
                label: 'UnContacted',
                data: uncontactedData,
                backgroundColor: '#FF6384',
                borderWidth: 1,
                barThickness: 10,
            }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 500,
                min: 0,
            }
        }
    }
});

@elseif(isset($twomonthdata))
var twomonthdata = @json($twomonthdata);

var labels = twomonthdata.map(function (data) {
    return data.monthName;
});

var contactedData = twomonthdata.map(function (data) {
    return data.totalContacted;
});

var interestedData = twomonthdata.map(function (data) {
    return data.totalBerminat;
});




    var notcallData = twomonthdata.map(function (data) {
    return data.totalNotCall;
});

  

    var uncontactedData = twomonthdata.map(function (data) {
    return data.totalUnContacted;
});


var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Contacted',
            data: contactedData,
            backgroundColor: '#36A2EB',
            barThickness: 10,
            borderWidth: 1,
        }, {
            label: 'Interested',
            data: interestedData,
            backgroundColor: '#FF9F40',
            borderWidth: 1,
            barThickness: 10,
        }, {
                label: 'Not Call Yet',
                data: notcallData,
                backgroundColor: '#9966FF',
                borderWidth: 1,
                barThickness: 10,
            },
            {
                label: 'UnContacted',
                data: uncontactedData,
                backgroundColor: '#FF6384',
                borderWidth: 1,
                barThickness: 10,
            }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 500,
                min: 0,
            }
        }
    }
});

@elseif (isset($weeklyData))

    var weeklyData = @json($weeklyData);

    var labels = Object.keys(weeklyData).map(function (week) {
  var weekData = weeklyData[week];
  return `W ${week} (${weekData.start_date} - ${weekData.end_date})`;
});

var contactedData = labels.map(function (week) {
  var weekNumber = week.match(/\d+/)[0]; // Mendapatkan nomor minggu dari label
  return weeklyData[weekNumber].totalContacted;
});

var interestedData = labels.map(function (week) {
  var weekNumber = week.match(/\d+/)[0];
  return weeklyData[weekNumber].totalBerminat;
});


var notcallData = labels.map(function (week) {
  var weekNumber = week.match(/\d+/)[0];
  return weeklyData[weekNumber].totalNotCall;
});

var uncontactedData = labels.map(function (week) {
  var weekNumber = week.match(/\d+/)[0];
  return weeklyData[weekNumber].totalUnContacted;
});


    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Contacted',
                data: contactedData,
                backgroundColor: '#36A2EB',
                barThickness: 20,
                borderWidth: 1,
            }, {
                label: 'Interested',
                data: interestedData,
                backgroundColor: '#FF9F40',
                borderWidth: 1,
                barThickness: 20,
            }, 
            {
                label: 'Not Call Yet',
                data: notcallData,
                backgroundColor: '#9966FF',
                borderWidth: 1,
                barThickness: 20,
            },
            {
                label: 'UnContacted',
                data: uncontactedData,
                backgroundColor: '#FF6384',
                borderWidth: 1,
                barThickness: 20,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    min: 0,
                }
            }
        }
    });

    @else

    var overallTotals = @json($overallTotals);
    var labels = [overallTotals.start_date + ' to ' + overallTotals.end_date];
    
    var datasets = [{
    label: 'Berminat',
    data: [overallTotals.totalBerminat],
    backgroundColor: '#36A2EB',
    borderWidth: 1,
    barThickness: 50,

}, {
    label: 'Contacted',
    data: [overallTotals.totalContacted],
    backgroundColor: '#FF9F40',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'Not Called',
    data: [overallTotals.totalNotCall],
    backgroundColor: '#9966FF',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'Uncontacted',
    data: [overallTotals.totalUnContacted],
    backgroundColor: '#FF6384',
    borderWidth: 1,
                    barThickness: 50,

}];



var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
        labels: labels,
        datasets: datasets
    },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    min: 0,
                }
            }
        }
    });

    
    @endif
</script>



<!-- Akuisisi Bar Chart -->

<script>

@if(isset($monthlyDataAkuisisi))
var monthlyData = @json($monthlyDataAkuisisi);

var labels = monthlyData.map(function (data) {
    return data.monthName;
});

var Reaktivasi = monthlyData.map(function (data) {
    return data.Reaktivasi;
});

var MigrasiLimit = monthlyData.map(function (data) {
    return data.MigrasiLimit;
});

var NotOk = monthlyData.map(function (data) {
    return data.NotOk;
});

var Akuisisi = monthlyData.map(function (data) {
    return data.Akuisisi;
});

var waitingconfirm = monthlyData.map(function (data) {
    return data.waitingconfirm;
});



var ctx = document.getElementById('myChartAkuisisi').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Reaktivasi',
            data: Reaktivasi,
            backgroundColor: '#36A2EB',
            barThickness: 10,
            borderWidth: 1,
        }, {
            label: 'Migrasi Limit',
            data: MigrasiLimit,
            backgroundColor: '#FF6384',
            borderWidth: 1,
            barThickness: 10,
        }, 
        {
            label: 'Akuisisi',
            data: Akuisisi,
            backgroundColor: '#9966FF',
            barThickness: 10,
            borderWidth: 1,
        }, {
            label: 'Not Ok',
            data: NotOk,
            backgroundColor: '#FF9F40',
            borderWidth: 1,
            barThickness: 10,
        }, {
            label: 'Waiting Confirmation',
            data: waitingconfirm,
            backgroundColor: '#4BC0C0',
            borderWidth: 1,
            barThickness: 10,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 500,
                min: 0,
            }
        }
    }
});



@elseif(isset($twomonthdataAkuisisi))
var twomonthdataAkuisisi = @json($twomonthdataAkuisisi);

var labels = twomonthdataAkuisisi.map(function (data) {
    return data.monthName;
});

var Reaktivasi = twomonthdataAkuisisi.map(function (data) {
    return data.Reaktivasi;
});

var MigrasiLimit = twomonthdataAkuisisi.map(function (data) {
    return data.MigrasiLimit;
});

var Akuisisi = twomonthdataAkuisisi.map(function (data) {
    return data.Akuisisi;
});

var NotOk = twomonthdataAkuisisi.map(function (data) {
    return data.NotOk;
});


var waitingconfirm = twomonthdataAkuisisi.map(function (data) {
    return data.waitingconfirm;
});


var ctx = document.getElementById('myChartAkuisisi').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Reaktivasi',
            data: Reaktivasi,
            backgroundColor: '#36A2EB',
            barThickness: 10,
            borderWidth: 1,
        }, {
            label: 'Migrasi Limit',
            data: MigrasiLimit,
            backgroundColor: '#FF6384',
            borderWidth: 1,
            barThickness: 10,
        }, 
        {
            label: 'Akuisisi',
            data: Akuisisi,
            backgroundColor: '#9966FF',
            barThickness: 10,
            borderWidth: 1,
        }, {
            label: 'Not Ok',
            data: NotOk,
            backgroundColor: '#FF9F40',
            borderWidth: 1,
            barThickness: 10,
        }, {
            label: 'Waiting Confirmation',
            data: waitingconfirm,
            backgroundColor: '#4BC0C0',
            borderWidth: 1,
            barThickness: 10,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 500,
                min: 0,
            }
        }
    }
});
@elseif(isset($weeklyDataAkuisisi))

    var weeklyDataAkuisisi = @json($weeklyDataAkuisisi);
    var labels = Object.keys(weeklyDataAkuisisi).map(function (week) {
  var weekData = weeklyDataAkuisisi[week];
  return `W ${week} (${weekData.start_date} - ${weekData.end_date})`;
});

var Reaktivasi = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataAkuisisi[weekNumber].Reaktivasi;
});


var MigrasiLimit = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataAkuisisi[weekNumber].MigrasiLimit;
});

var Akuisisi = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataAkuisisi[weekNumber].Akuisisi;
});

var NotOk = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataAkuisisi[weekNumber].NotOk;
});
var waitingconfirm = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataAkuisisi[weekNumber].waitingconfirm;
});
    var ctx = document.getElementById('myChartAkuisisi').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
            label: 'Reaktivasi',
            data: Reaktivasi,
            backgroundColor: '#36A2EB',
            barThickness: 10,
            borderWidth: 1,
        }, {
            label: 'Migrasi Limit',
            data: MigrasiLimit,
            backgroundColor: '#FF6384',
            borderWidth: 1,
            barThickness: 10,
        }, 
        {
            label: 'Akuisisi',
            data: Akuisisi,
            backgroundColor: '#9966FF',
            barThickness: 10,
            borderWidth: 1,
        }, {
            label: 'Not Ok',
            data: NotOk,
            backgroundColor: '#FF9F40',
            borderWidth: 1,
            barThickness: 10,
        }, {
            label: 'Waiting Confirmation',
            data: waitingconfirm,
            backgroundColor: '#4BC0C0',
            borderWidth: 1,
            barThickness: 10,
        }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    min: 0,
                }
            }
        }
    });

    @else 

   // Ambil data dari PHP dan inisialisasi chart
var overallTotalsAkuisisi = <?php echo json_encode($overallTotalsAkuisisi); ?>;

// Ambil label dan data dari overallTotalsAkuisisi
var labelsStatus = [overallTotalsAkuisisi.start_date + ' to ' + overallTotalsAkuisisi.end_date];
var datasetsStatus = [{
    label: 'Berminat',
    data: [overallTotalsAkuisisi.Reaktivasi],
    backgroundColor: '#36A2EB',
    borderWidth: 1,
                    barThickness: 50,


}, {
    label: 'Tidak Berminat',
    data: [overallTotalsAkuisisi.MigrasiLimit],
    backgroundColor: '#FF6384',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'Tidak Terhubung',
    data: [overallTotalsAkuisisi.Akuisisi],
    backgroundColor: '#4BC0C0',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'No. Telp Tidak Valid',
    data: [overallTotalsAkuisisi.NotOk],
    backgroundColor: '#FF9F40',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'Diskusi Internal',
    data: [overallTotalsAkuisisi.waitingconfirm],
    backgroundColor: '#9966FF',
    borderWidth: 1,
                    barThickness: 50,

}, ];


// Inisialisasi chart
var ctxStatus = document.getElementById('myChartAkuisisi').getContext('2d');
var myStatusChart = new Chart(ctxStatus, {
    type: 'bar',
    data: {
        labels: labelsStatus,
        datasets: datasetsStatus
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
   @endif
</script>


<!-- End Of Akuisisi Bar Chart -->

<!-- Akuisisi Data Pie -->

<script>
    var ctx = document.getElementById("myPieChartAkuisisi");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $AkuisisiPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $AkuisisiPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>

<script>
    var ctx = document.getElementById("myPieChartReaktivasi");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $ReaktivasiPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $ReaktivasiPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>



<script>
    var ctx = document.getElementById("myPieChartMigrasiLimit");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $MigrasiLimitPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $MigrasiLimitPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>


<script>
    var ctx = document.getElementById("myPieChartNotOk");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $NotOkPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $NotOkPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>

<script>
    var ctx = document.getElementById("myPieChartwaitingconfirm");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $waitingconfirmPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $waitingconfirmPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>
<!-- End of akuisisi Data Pie -->
<script>
    var ctx = document.getElementById("myPieChartInterested");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalBerminatPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalBerminatPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>



<script>
    var ctx = document.getElementById("myPieChartContacted");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                 data: [
        @if(isset($dataKCU))
            {{ $totalContactedPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalContactedPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
           
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
    });
</script>
<script>
    var ctx = document.getElementById("myPieChartClosing");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                 data: [
        @if(isset($dataKCU))
            {{ $totalClosingPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalClosingPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
           
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
    });
</script>


<script>
    var ctx = document.getElementById("myPieChartUncontacted");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalUnContactedPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalUnContactedPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>


<script>
    var ctx = document.getElementById("myPieChartNotCall");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalNotCallPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalNotCallPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>


<script>

@if(isset($monthlyDataStatus))
var monthlyData = @json($monthlyDataStatus);

var labels = monthlyData.map(function (data) {
    return data.monthName;
});

var Berminat = monthlyData.map(function (data) {
    return data.Berminat;
});


var TidakBerminat = monthlyData.map(function (data) {
    return data.TidakBerminat;
});

var TidakTerhubung = monthlyData.map(function (data) {
    return data.TidakTerhubung;
});


var NoTelpTidakValid = monthlyData.map(function (data) {
    return data.NoTelpTidakValid;
});

var DiskusiInternal = monthlyData.map(function (data) {
    return data.DiskusiInternal;
});

var CallAgain = monthlyData.map(function (data) {
    return data.CallAgain;
});


var ctx = document.getElementById('myChartStatus').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Berminat',
            data: Berminat,
            backgroundColor: '#36A2EB',
            barThickness: 20,
            borderWidth: 1,
        }, {
            label: 'Tidak Berminat',
            data: TidakBerminat,
            backgroundColor: '#FF6384',
            borderWidth: 1,
            barThickness: 20,
        }, {
            label: 'Tidak Terhubung',
            data: TidakTerhubung,
            backgroundColor: '#4BC0C0',
            borderWidth: 1,
            barThickness: 20,
        },
        {
            label: 'No. Telp Tidak Valid',
            data: NoTelpTidakValid,
            backgroundColor: '#FF9F40',
            barThickness: 20,
            borderWidth: 1,
        }, {
            label: 'Diskusi Internal',
            data: DiskusiInternal,
            backgroundColor: '#9966FF',
            borderWidth: 1,
            barThickness: 20,
        }, {
            label: 'Call Again',
            data: CallAgain,
            backgroundColor: '#FFCD56',
            borderWidth: 1,
            barThickness: 20,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 500,
                min: 0,
            }
        }
    }
});



@elseif(isset($twomonthdataStatus))
var twomonthdatastatus = @json($twomonthdataStatus);

var labels = twomonthdatastatus.map(function (data) {
    return data.monthName;
});

var Berminat = twomonthdatastatus.map(function (data) {
    return data.Berminat;
});


var TidakBerminat = twomonthdatastatus.map(function (data) {
    return data.TidakBerminat;
});

var TidakTerhubung = twomonthdatastatus.map(function (data) {
    return data.TidakTerhubung;
});


var NoTelpTidakValid = twomonthdatastatus.map(function (data) {
    return data.NoTelpTidakValid;
});

var DiskusiInternal = twomonthdatastatus.map(function (data) {
    return data.DiskusiInternal;
});

var CallAgain = twomonthdatastatus.map(function (data) {
    return data.CallAgain;
});


var ctx = document.getElementById('myChartStatus').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Berminat',
            data: Berminat,
            backgroundColor: '#36A2EB',
            barThickness: 20,
            borderWidth: 1,
        }, {
            label: 'Tidak Berminat',
            data: TidakBerminat,
            backgroundColor: '#FF6384',
            borderWidth: 1,
            barThickness: 20,
        }, {
            label: 'Tidak Terhubung',
            data: TidakTerhubung,
            backgroundColor: '#4BC0C0',
            borderWidth: 1,
            barThickness: 20,
        },
        {
            label: 'No. Telp Tidak Valid',
            data: NoTelpTidakValid,
            backgroundColor: '#FF9F40',
            barThickness: 20,
            borderWidth: 1,
        }, {
            label: 'Diskusi Internal',
            data: DiskusiInternal,
            backgroundColor: '#9966FF',
            borderWidth: 1,
            barThickness: 20,
        }, {
            label: 'Call Again',
            data: CallAgain,
            backgroundColor: '#FFCD56',
            borderWidth: 1,
            barThickness: 20,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                max: 500,
                min: 0,
            }
        }
    }
});
@elseif(isset($weeklyDataStatus))

    var weeklyDataStatus = @json($weeklyDataStatus);
    var labels = Object.keys(weeklyDataStatus).map(function (week) {
  var weekData = weeklyDataStatus[week];
  return `W ${week} (${weekData.start_date} - ${weekData.end_date})`;
});

var Berminat = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataStatus[weekNumber].Berminat;
});

var TidakBerminat = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataStatus[weekNumber].TidakBerminat;
});

var TidakTerhubung = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataStatus[weekNumber].TidakTerhubung;
});


var NoTelpTidakValid = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataStatus[weekNumber].NoTelpTidakValid;
});

var DiskusiInternal = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataStatus[weekNumber].DiskusiINternal;
});

var CallAgain = labels.map(function (weekLabel) {
  var weekNumber = weekLabel.match(/\d+/)[0]; // Get the week number from the label
  return weeklyDataStatus[weekNumber].CallAgain;
});



    var ctx = document.getElementById('myChartStatus').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
            label: 'Berminat',
            data: Berminat,
            backgroundColor: '#36A2EB',
            barThickness: 20,
            borderWidth: 1,
        }, {
            label: 'Tidak Berminat',
            data: TidakBerminat,
            backgroundColor: '#FF6384',
            borderWidth: 1,
            barThickness: 20,
        }, {
            label: 'Tidak Terhubung',
            data: TidakTerhubung,
            backgroundColor: '#4BC0C0',
            borderWidth: 1,
            barThickness: 20,
        },
        {
            label: 'No. Telp Tidak Valid',
            data: NoTelpTidakValid,
            backgroundColor: '#FF9F40',
            barThickness: 20,
            borderWidth: 1,
        }, {
            label: 'Diskusi Internal',
            data: DiskusiInternal,
            backgroundColor: '#9966FF',
            borderWidth: 1,
            barThickness: 20,
        }, {
            label: 'Call Again',
            data: CallAgain,
            backgroundColor: '#FFCD56',
            borderWidth: 1,
            barThickness: 20,
        }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    min: 0,
                }
            }
        }
    });

    @else 

   // Ambil data dari PHP dan inisialisasi chart
var overallTotalsStatus = <?php echo json_encode($overallTotalsStatus); ?>;

// Ambil label dan data dari overallTotalsStatus
var labelsStatus = [overallTotalsStatus.start_date + ' to ' + overallTotalsStatus.end_date];
var datasetsStatus = [{
    label: 'Berminat',
    data: [overallTotalsStatus.Berminat],
    backgroundColor: '#36A2EB',
    borderWidth: 1,
                    barThickness: 50,


}, {
    label: 'Tidak Berminat',
    data: [overallTotalsStatus.TidakBerminat],
    backgroundColor: '#FF6384',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'Tidak Terhubung',
    data: [overallTotalsStatus.TidakTerhubung],
    backgroundColor: '#4BC0C0',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'No. Telp Tidak Valid',
    data: [overallTotalsStatus.NoTelpTidakValid],
    backgroundColor: '#FF9F40',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'Diskusi Internal',
    data: [overallTotalsStatus.DiskusiInternal],
    backgroundColor: '#9966FF',
    borderWidth: 1,
                    barThickness: 50,

}, {
    label: 'Call Again',
    data: [overallTotalsStatus.CallAgain],
    backgroundColor: '#FFCD56',
    borderWidth: 1,
                    barThickness: 20,

}];


// Inisialisasi chart
var ctxStatus = document.getElementById('myChartStatus').getContext('2d');
var myStatusChart = new Chart(ctxStatus, {
    type: 'bar',
    data: {
        labels: labelsStatus,
        datasets: datasetsStatus
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
   @endif
</script>


<script>
    var ctx = document.getElementById("myPieChartBerminat");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalStatusBerminatPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalStatusBerminatPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>




<script>
    var ctx = document.getElementById("myPieChartTidakBerminat");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalStatusTidakBerminatPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalStatusTidakBerminatPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>



<script>
    var ctx = document.getElementById("myPieChartTidakTerhubung");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalStatusTidakTerhubungPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalStatusTidakTerhubungPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>


<script>
    var ctx = document.getElementById("myPieChartNoTelpTidakValid");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalStatusNoTelpTidakValidPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalStatusNoTelpTidakValidPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>


<script>
    var ctx = document.getElementById("myPieChartDiskusiInternal");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalStatusDiskusiInternalPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalStatusDiskusiInternalPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>


<script>
    var ctx = document.getElementById("myPieChartCallAgain");

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var dynamicColors = []; // Menampung warna dinamis

    @foreach ($kcu as $item)
        dynamicColors.push(getRandomColor());
    @endforeach

    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
    @if(isset($dataKCU))
        "{{ $dataKCU->nama_kcu }}",
    @else
        @foreach ($kcu as $item)
            "{{ $item->nama_kcu }}",
        @endforeach
    @endif
],
            datasets: [{
                data: [
        @if(isset($dataKCU))
            {{ $totalStatusCallAgainPerKCU[$dataKCU->id] ?? 0 }},
        @else
            @foreach ($kcu as $item)
                {{ $totalStatusCallAgainPerKCU[$item->id] ?? 0 }},
            @endforeach
        @endif
    ],
                backgroundColor: dynamicColors, // Menggunakan warna dinamis
                hoverBackgroundColor: dynamicColors,
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
           
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            cutoutPercentage: 80,
            plugins: {
            labels:{
              
                render: 'value',
                fontColor: '#fff',
            },
            legend: {
                display: true,
                labels: {
                    color: '#000'
                },
                position: 'bottom',
            }, 
            
        }
        },
       
    });
</script>

<script>
    // Fungsi untuk mengatur ulang nilai formulir
    function resetFilter() {
        // Mengatur ulang nilai formulir ke default
        document.getElementsByName('kcu')[0].value = "";
        document.getElementsByName('jenis_data')[0].value = "";
        document.getElementsByName('tanggal_awal')[0].value = "";
        document.getElementsByName('tanggal_akhir')[0].value = "";

        // Submit formulir setelah diatur ulang
        document.getElementById('filterForm').submit();
    }

    // Menambahkan event listener pada tombol "Reset Filter"
    document.getElementById('resetFilterBtn').addEventListener('click', function (event) {
        event.preventDefault(); // Mencegah pengiriman formulir saat tombol "Reset Filter" diklik
        resetFilter();
    });
</script>


     <!-- Scroll to Top Button-->
     <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "logout" jika anda yakin untuk mengakhiri sesi anda.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
                </div>
            </div>
        </div>
    </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>


    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
<!-- <script src="{{asset('js/demo/chart-bar-demo.js')}}"></script> -->
<!-- <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap core JavaScript-->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    

    <script>
$(function() {
  // Initialize datepicker for tanggal_awal and tanggal_akhir
  $('#tanggal_awal, #tanggal_akhir').daterangepicker({
    opens: 'left',
    locale: {
      format: 'YYYY-MM-DD',
    },
    ranges: {
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
      'This Year': [moment().startOf('year'), moment().endOf('year')],
      'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
    },
  }, function(start, end, label) {
    // Callback function, if needed
    console.log("A new date range selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

    // Set the selected range to tanggal_awal and tanggal_akhir
    $('#awal_value').val(start.format('YYYY-MM-DD'));
    $('#akhir_value').val(end.format('YYYY-MM-DD'));
  });
});
</script>

<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Apakah anda yakin untuk menghapus data ini?`,
              text: "Jika anda menghapus data ini, data ini akan hilang selamanya.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
</script>

<script type="text/javascript">
 
     $('.show_confirm2').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Apakah anda yakin melakukan reset password?`,
              text: "Jika anda melakukan reset, maka password akan berubah menjadi default password.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
</script>
<!-- Add this line to include the html2pdf library -->
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

<script>
    
</script> 

<script>
    document.getElementById('exportPdfButton').addEventListener('click', function() {
        // Select the chart container element
        var chartContainer = document.getElementById('chartstatus');
       
      
        // Set options for html2pdf
        var options = {
            margin: [5, 5, 5, 5], // Adjust margins as needed (top, left, bottom, right)     
            filename: 'chart_export_by_step.pdf',
            image: { type: 'jpeg', quality: 0.98 }, // Set image quality
            html2canvas: { scale: 3 }, // Adjust scale as needed
            jsPDF: { unit: 'mm', format: 'A3', orientation: 'landscape' } // Adjust format and orientation as needed
        };

        // Use html2pdf to export the chart container as PDF with specified options
        html2pdf(chartContainer, options);
    });
</script>

<script>
    document.getElementById('exportPdfButtonStatus').addEventListener('click', function() {
        // Select the chart container element
        var chartContainer = document.getElementById('chartchart');
        
       
        // Set options for html2pdf
        var options = {
            margin: [5, 5, 5, 5], // Adjust margins as needed (top, left, bottom, right)     
            filename: 'chart_export_by_status.pdf',
            image: { type: 'jpeg', quality: 0.98 }, // Set image quality
            html2canvas: { scale: 3 }, // Adjust scale as needed
            jsPDF: { unit: 'mm', format: 'A3', orientation: 'landscape' } // Adjust format and orientation as needed
        };

        // Use html2pdf to export the chart container as PDF with specified options
        html2pdf(chartContainer, options);
    });
</script>


<script>
    document.getElementById('exportPdfButtonAkuisisi').addEventListener('click', function() {
        // Select the chart container element
        var chartContainer = document.getElementById('chartakuisisi');
        
       
        // Set options for html2pdf
        var options = {
            margin: [5, 5, 5, 5], // Adjust margins as needed (top, left, bottom, right)     
            filename: 'chart_export_akuisisi.pdf',
            image: { type: 'jpeg', quality: 0.98 }, // Set image quality
            html2canvas: { scale: 3 }, // Adjust scale as needed
            jsPDF: { unit: 'mm', format: 'A3', orientation: 'landscape' } // Adjust format and orientation as needed
        };

        // Use html2pdf to export the chart container as PDF with specified options
        html2pdf(chartContainer, options);
    });
</script>


</body>

</html>
   
