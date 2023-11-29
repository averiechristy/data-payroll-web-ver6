
@extends('layouts.app')

@section('content')
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
            <option disabled selected>Pilih Jenis Data</option>
            <option value="Referral" {{ (isset($selectedJenis) && $selectedJenis == 'Referral') ? 'selected' : '' }}>Referral</option>
            <option value="Data Leads" {{ (isset($selectedJenis) && $selectedJenis == 'Data Leads') ? 'selected' : '' }}>Data Leads</option>
        </select>
    </div>
</div>



<!-- Tasks Card Example -->
<div class="col-xl-2 col-md-6 mb-4">
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" class="form-control" id="exampleInputEmail1" aria-describedby="date"
               value="{{ isset($tanggalAwal) ? $tanggalAwal : '' }}">
    </div>
</div>

<div class="col-xl-2 col-md-6 mb-4">
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" class="form-control" id="exampleInputEmail1" aria-describedby="date"
               value="{{ isset($tanggalAkhir) ? $tanggalAkhir : '' }}">
    </div>
</div>



<div class="col-xl-2 col-md-6 mb-4">

<div class="form-group">
    <label for="exampleInputEmail1">      </label>
    <button type="submit" class="btn btn-primary btn-sm form-control mt-2">Filter</button>
  </div>
  
</div>

</form>

<div class="col-xl-2 col-md-6 mb-4">

<div class="form-group">
    <label for="exampleInputEmail1">      </label>
    
    <button type="submit" class="btn btn-danger btn-sm form-control mt-2">Reset Filter</button>
  </div>
  
</div>

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

    var labels = Object.keys(weeklyData);
    var contactedData = labels.map(function (week) {
        return weeklyData[week].totalContacted;
    });
    
    var interestedData = labels.map(function (week) {
        return weeklyData[week].totalInterested;
    });
    
    var closingData = labels.map(function (week) {
        return weeklyData[week].totalClosing;
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
                backgroundColor:'#FF9F40',
        borderWidth: 1,
        barThickness: 50, 
            }, {
                label: 'Closing',
                data: closingData,
                backgroundColor:'#4BC0C0',
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

@endsection
