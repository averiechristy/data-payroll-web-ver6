@extends('layouts.app')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Leads</h1>

                    <form action="{{ route('filter.data') }}" method="post">    @csrf

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
        <input type="date" id="awal_value" name="tanggal_awal" class="form-control" id="exampleInputEmail1" aria-describedby="date"
               value="{{ isset($tanggalawal) ? $tanggalawal : '' }}" autocomplete="off">
    </div>
</a>
</div>

<div class="col-xl-2 col-md-6 mb-4">
    <a  id='tanggal_akhir'>
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal Akhir</label>
        <input type="date" id="akhir_value" name="tanggal_akhir" class="form-control" id="exampleInputEmail1" aria-describedby="date"
               value="{{ isset($tanggalakhir) ? $tanggalakhir : '' }}" autocomplete="off">
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
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                    
                        <form action="{{ route('dataleads.export') }}" method="GET" id="exportForm">
    <input type="hidden" name="kcu" value="{{ $selectedKCU ?? '' }}">
    <input type="hidden" name="jenis_data" value="{{ $selectedJenis ?? '' }}">
    <!-- ... other hidden fields for filter data ... -->
    <button type="submit" style="float: right;" class="btn btn-success btn-sm mb-2">Export Data</button>
</form>
<form action="{{ route('delete.data') }}" method="post" onsubmit="return confirmDelete();">
    @csrf
    <button type="submit" style="float: right; margin-right:6px;" class="btn btn-danger  btn-sm mb-2">Delete Data</button>



                        </div>
                        
                        <div class="card-body">


                        <div class="dataTables_length mb-3" id="myDataTable_length">
<label for="entries"> Show
<select id="entries" name="myDataTable_length" aria-controls="myDataTable"  onchange="changeEntries()" class>
<option value="10">10</option>
<option value="25">25</option>
<option value="50">50</option>
<option value="100">100</option>
</select>
entries
</label>
</div>

<div id="myDataTable_filter" class="dataTables_filter">
    <label for="search">Search
        <input id="search" placeholder>
    </label>
</div>


                       
                          
                                <table  class="table table-bordered"  width="100%" cellspacing="0" style="border-radius: 10px;">
                                    <thead>
                                        <tr>
                                        <th>Select</th>
                                          <th>No</th>
                                          
                                          <th>Tanggal Awal </th>
                                          <th>Tanggal Akhir</th>
                                          <th>Nama Customer</th>
                                          <th>No. Telp</th>
                                          <th>PIC</th>
                                          <th>Status</th>
                                          <th>KCU</th>
                                          <th>Tanggal Terima Form KBB - Sales</th>
                                          <th>Tanggal Terima Form KBB Payroll - Cabang</th>
                                          <th>Jenis Data</th>
                                          <th>Tanggal Follow Up</th>
                                          <th>Action</th>

                                         
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <br>
                                       <br>
                                    <div class="form-check">
    <input class="form-check-input" type="checkbox" id="selectAllCheckbox" onclick="selectAll()">
    <label class="form-check-label" for="selectAllCheckbox">Select All</label>
</div>
                                     @foreach ($dataleads as $dataleads)
                                    <tr>
                                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $dataleads->id }}" name="selectedIds[]">
                        </div>
                    </td>
                                      <td>{{$dataleads -> no}}</td>
                                      <td>{{$dataleads -> tanggal_awal}}</td>
                                      <td>{{$dataleads -> tanggal_akhir}}</td>
                                  <td>{{$dataleads -> cust_name}}</td>
                                  <td>{{$dataleads -> phone_no}}</td>
                                  <td>{{$dataleads -> nama_pic_kbb}}</td>
                                  <td>{{$dataleads -> status}}</td>
                                  <td>{{ $dataleads->kcuData->nama_kcu }}</td>
                                                                    <td>{{$dataleads -> tanggal_terima_form_kbb}}</td>
                                  <td>{{$dataleads -> tanggal_terima_form_kbb_payroll}}</td>
                                  <td>{{$dataleads -> jenis_data}}</td>
                                  <td>{{$dataleads -> tanggal_follow_up}}</td>
                                  <td>
               
                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#rename{{$dataleads->id}}">
                                    <i class="fas fa-fw fa-edit" style="color:orange" >
                                </i></a>
                                
                                <div class="modal fade" id="rename{{$dataleads->id}}" tabindex="-1" role="dialog" aria-labelledby="renameLabel{{$dataleads->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renameLabel{{$dataleads->id}}">Rename Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for renaming a folder -->
                <form action="{{ route('folder.rename', ['id' => $dataleads->id]) }}" method="POST">
                    @csrf <!-- Untuk melindungi dari serangan CSRF -->
                    <div class="form-group">
                        <label for="newFolderName{{$dataleads->id}}">Nama Folder</label>
                        <input type="text" class="form-control" id="newFolderName{{$dataleads->id}}" name="new_name" value="{{$dataleads->cust_name}}" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Rename</button>
            </form>
            </div>
        </div>
    </div>
</div>
                                  </td>
                                    </tr>
                                    @endforeach
                                    </tbody>

                                </table>

</form>
                                <div class="dataTables_info" id="dataTableInfo" role="status" aria-live="polite">
    Showing <span id="showingStart">1</span> to <span id="showingEnd">10</span> of <span id="totalEntries">0</span> entries
</div>
        
<div class="dataTables_paginate paging_simple_numbers" id="myDataTable_paginate">
    
    <a href="#" class="paginate_button" id="doublePrevButton" onclick="doublePreviousPage()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
    <a href="#" class="paginate_button" id="prevButton" onclick="previousPage()"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    <span>
        <a id="pageNumbers" aria-controls="myDataTable" role="link" aria-current="page" data-dt-idx="0" tabindex="0"></a>
    </span>
    <a href="#" class="paginate_button" id="nextButton" onclick="nextPage()"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
    <a href="#" class="paginate_button" id="doubleNextButton" onclick="doubleNextPage()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
</div>
                              
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
           
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    
    <style>
  .actions-container {
    display: flex;
    align-items: center; /* Optional: Align items vertically centered */
  }

  .muted {
    pointer-events: none; /* Disable click events */
    opacity: 0.5; /* Add transparency to indicate it's muted */
  }


</style>


<script>
    var itemsPerPage = 10; // Ubah nilai ini sesuai dengan jumlah item per halaman
    var currentPage = 1;
    var filteredData = [];
    
    function initializeData() {
    var tableRows = document.querySelectorAll("table tbody tr");
    filteredData = Array.from(tableRows); // Konversi NodeList ke array
    updatePagination();
}

// Panggil fungsi initializeData() untuk menginisialisasi data saat halaman dimuat
initializeData();
    
function doublePreviousPage() {
        if (currentPage > 1) {
            currentPage = 1;
            updatePagination();
        }
    }
    
function nextPage() {
    var totalPages = Math.ceil(document.querySelectorAll("table tbody tr").length / itemsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        updatePagination();
    }
}
  
function doubleNextPage() {
    var totalPages = Math.ceil(document.querySelectorAll("table tbody tr").length / itemsPerPage);
    if (currentPage < totalPages) {
        currentPage = totalPages;
        updatePagination();
    }
}

    function previousPage() {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    }
 
    function updatePagination() {
    var startIndex = (currentPage - 1) * itemsPerPage;
    var endIndex = startIndex + itemsPerPage;

    // Sembunyikan semua baris
    var tableRows = document.querySelectorAll("table tbody tr");
    tableRows.forEach(function (row) {
        row.style.display = 'none';
    });

    // Tampilkan baris untuk halaman saat ini
    for (var i = startIndex; i < endIndex && i < filteredData.length; i++) {
        filteredData[i].style.display = 'table-row';
    }

    // Update nomor halaman
    var totalPages = Math.ceil(filteredData.length / itemsPerPage);
    var pageNumbers = document.getElementById('pageNumbers');
    pageNumbers.innerHTML = '';

    var totalEntries = filteredData.length;

    document.getElementById('showingStart').textContent = startIndex + 1;
    document.getElementById('showingEnd').textContent = Math.min(endIndex, totalEntries);
    document.getElementById('totalEntries').textContent = totalEntries;

    var pageRange = 3; // Jumlah nomor halaman yang ditampilkan
    var startPage = Math.max(1, currentPage - Math.floor(pageRange / 2));
    var endPage = Math.min(totalPages, startPage + pageRange - 1);

    for (var i = startPage; i <= endPage; i++) {
        var pageButton = document.createElement('button');
        pageButton.className = 'btn btn-primary btn-sm mr-1 ml-1';
        pageButton.textContent = i;
        if (i === currentPage) {
            pageButton.classList.add('btn-active');
        }
        pageButton.onclick = function () {
            currentPage = parseInt(this.textContent);
            updatePagination();
        };
        pageNumbers.appendChild(pageButton);
    }
}
    function changeEntries() {
        var entriesSelect = document.getElementById('entries');
        var selectedEntries = parseInt(entriesSelect.value);

        // Update the 'itemsPerPage' variable with the selected number of entries
        itemsPerPage = selectedEntries;

        // Reset the current page to 1 when changing the number of entries
        currentPage = 1;

        // Update pagination based on the new number of entries
        updatePagination();
    }

    function applySearchFilter() {
    var searchInput = document.getElementById('search');
    var filter = searchInput.value.toLowerCase();
    
    // Mencari data yang sesuai dengan filter
    filteredData = Array.from(document.querySelectorAll("table tbody tr")).filter(function (row) {
        var rowText = row.textContent.toLowerCase();
        return rowText.includes(filter);
    });

    // Set currentPage kembali ke 1
    currentPage = 1;

    updatePagination();
}

updatePagination();



    // Menangani perubahan pada input pencarian
    document.getElementById('search').addEventListener('input', applySearchFilter);
    // Panggil updatePagination untuk inisialisasi
  
             
</script>

<style>
    
    
.dataTables_paginate{float:right;text-align:right;padding-top:.25em}
.paginate_button {box-sizing:border-box;
    display:inline-block;
    min-width:1.5em;
    padding:.5em 1em;
    margin-left:2px;
    text-align:center;
    text-decoration:none !important;
    cursor:pointer;color:inherit !important;
    border:1px solid transparent;
    border-radius:2px;
    background:transparent}

.dataTables_length{float:left}.dataTables_wrapper .dataTables_length select{border:1px solid #aaa;border-radius:3px;padding:5px;background-color:transparent;color:inherit;padding:4px}
.dataTables_info{clear:both;float:left;padding-top:.755em}    
.dataTables_filter{float:right;text-align:right}
.dataTables_filter input{border:1px solid #aaa;border-radius:3px;padding:5px;background-color:transparent;color:inherit;margin-left:3px}
</style>


<script>

function validateForm() {
    let tanggal_awal = document.forms["saveform"]["tanggal_awal"].value;
    let tanggal_akhir = document.forms ["saveform"]["tanggal_akhir"].value;
    let file = document.forms["saveform"]["file"].value;

    if (tanggal_awal == ""){
        alert("Tanggal Awal tidak boleh kosong");
        return false;
    }

    else if (tanggal_akhir == ""){
        alert("Tanggal Akhir tidak boleh kosong");
        return false;
    }

    else if (file == ""){
        alert("File tidak boleh kosong");
        return false;
    }
}
</script>

<!-- Add this script at the end of your existing JavaScript code -->
<script>
    function confirmDelete() {
        var checkboxes = document.getElementsByName('selectedIds[]');
        var selectedCheckboxes = Array.from(checkboxes).filter(function (checkbox) {
            return checkbox.checked;
        });

        if (selectedCheckboxes.length === 0) {
            alert('Silakan memilih data untuk dihapus');
            return false;
        }

        return confirm('Yakin menghapus data?');
    }
</script>

<script>
    // Function to handle "Select All" checkbox
    function selectAll() {
        var checkboxes = document.getElementsByName('selectedIds[]');
        var selectAllCheckbox = document.getElementById('selectAllCheckbox');

        checkboxes.forEach(function (checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }

    // Function to check if all checkboxes are selected
    function areAllCheckboxesSelected() {
        var checkboxes = document.getElementsByName('selectedIds[]');
        return Array.from(checkboxes).every(function (checkbox) {
            return checkbox.checked;
        });
    }

    // Function to handle checkbox change
    function handleCheckboxChange() {
        var selectAllCheckbox = document.getElementById('selectAllCheckbox');
        selectAllCheckbox.checked = areAllCheckboxesSelected();
    }
</script>

   @endsection