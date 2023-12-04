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
               value="{{ isset($tanggalAwal) ? $tanggalAwal : '' }}">
    </div>
</a>
</div>

<div class="col-xl-2 col-md-6 mb-4">
    <a  id='tanggal_akhir'>
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal Akhir</label>
        <input type="text" id="akhir_value" name="tanggal_akhir" class="form-control" id="exampleInputEmail1" aria-describedby="date"
               value="{{ isset($tanggalAkhir) ? $tanggalAkhir : '' }}">
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

<!-- <div class="col-xl-2 col-md-6 mb-4">
    <div class="form-group">
        <label for="exampleInputEmail1">      </label>
        <button type="submit" class="btn btn-danger btn-sm form-control mt-2" id="resetFilterBtn">Reset Filter</button>
    </div>
</div> -->

</div>

                        <!-- Content Row -->
                        <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                        Interested</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $persentaseBerminat}} %</div>
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
                        Contacted</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $persentaseContacted}} %</div>
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
                        Closing</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$persentaseClosing}} %</div>
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
            <h6 class="m-0 font-weight-bold text-primary">Interested</h6>
           
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
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Contacted</h6>
           
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
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Closing</h6>
           
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChartClosing"></canvas>
            </div>
            
        </div>
    </div>
</div>


</div>


<!-- Area Chart -->

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="">
         
  <canvas id="myChart"></canvas>

            </div>
        </div>
    </div>

    

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var weeklyData = @json($weeklyData);

    var labels = Object.keys(weeklyData).map(function (week) {
        return 'Week ' + week;
    });

    var contactedData = labels.map(function (week) {
        return weeklyData[week.replace('Week ', '')].totalContacted;
    });

    var interestedData = labels.map(function (week) {
        return weeklyData[week.replace('Week ', '')].totalBerminat;
    });

    var closingData = labels.map(function (week) {
        return weeklyData[week.replace('Week ', '')].totalClosing;
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
                barThickness: 50,
                borderWidth: 1,
            }, {
                label: 'Interested',
                data: interestedData,
                backgroundColor: '#FF9F40',
                borderWidth: 1,
                barThickness: 50,
            }, {
                label: 'Closing',
                data: closingData,
                backgroundColor: '#4BC0C0',
                borderWidth: 1,
                barThickness: 50,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10,
                    min: 0,
                }
            }
        }
    });
</script>



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
            legend: {
                display: false
            },
            cutoutPercentage: 80,
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
            legend: {
                display: false
            },
            cutoutPercentage: 80,
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
            legend: {
                display: false
            },
            cutoutPercentage: 80,
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
      'Today': [moment(), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
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

</body>

</html>
   

