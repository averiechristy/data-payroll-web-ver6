@extends('layouts.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="mt-3">
@include('components.alert')


<div id="loading1">
    <p>Loading...</p>
</div>
<div id="loading2">
    <p>Loading...</p>
</div>
<div id="loading3">
    <p>Loading...</p>
</div>

<div class="card shadow mb-4">
                    <!-- Page Heading -->
                    <div class="card-header py-3">
                    <h3 class="h3 mb-2 text-gray-800">Data Leads</h3>
</div>



                    <!-- DataTales Example -->
               
                        <div class="card-body py-3">
                        <form  id= "form1" name="saveform" action="{{ route('dataleads.import') }}" method="POST" onsubmit="return formvalidasi()" enctype="multipart/form-data">                                         
                           
                        @csrf

                            <div class="form-group mb-4 mt-2">
                                                <label for="" class="form-label">Pilih KCU</label>

<select name="kcu" class="form-control " style="border-color: #01004C;" aria-label=".form-select-lg example"  oninvalid="this.setCustomValidity('Pilih salah satu KCU')" oninput="setCustomValidity('')" required>
  

<option value="" selected disabled>-- Pilih KCU --</option>
@foreach ($kcu as $item)
        <option value="{{ $item->id }}"{{ old('kcu') == $item->id ? 'selected' : '' }}> {{ $item->nama_kcu }}</option>
    @endforeach
</select>

                                            </div>
                            <label class="mt-3" for="">Tanggal Awal:</label>
                            <input type="date" id="tanggal_awal" name="tanggal_awal">

                            <label class="mt-3" for="">Tanggal Akhir:</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir">

                         
  
  <div class="form-group mt-3">
    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <button type="submit" class="btn btn-primary btn-sm mb-2">Import Data</button>   
  
</form>



                        </div>
                    
                    </div>

                <div class="card shadow mb-4">
                    <!-- Page Heading -->
                    <div class="card-header py-3">
                    <h3 class="h3 mb-2 text-gray-800">Rekap Call</h3>
</div>

                    <!-- DataTales Example -->
               
                        <div class="card-body py-3">



                        <form id= "form2" name="saveformCall" onsubmit="return validateForm()" action="{{route('rekapcall.import')}}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group mb-4 mt-2">
                                                <label for="" class="form-label">Pilih KCU</label>

<select name="kcu" class="form-control " style="border-color: #01004C;" aria-label=".form-select-lg example"  oninvalid="this.setCustomValidity('Pilih salah satu KCU')" oninput="setCustomValidity('')" required >
  

<option value="" selected disabled>-- Pilih KCU --</option>
@foreach ($kcu as $item)
        <option value="{{ $item->id }}"{{ old('kcu') == $item->id ? 'selected' : '' }}> {{ $item->nama_kcu }}</option>
    @endforeach
</select>

                                            </div>


                                            <label class="mt-3" for="">Tanggal Awal:</label>
                            <input type="date" id="tanggal_awal" name="tanggal_awal">

                            <label class="mt-3" for="">Tanggal Akhir:</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir">
  <div class="form-group mt-3">
    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <button type="submit" class="btn btn-primary btn-sm">Import Data</button>   
  
</form>



                        </div>
                    
                    </div>


                    



                    <div class="card shadow mb-4">
                    <!-- Page Heading -->
                    <div class="card-header py-3">
                    <h3 class="h3 mb-2 text-gray-800">Rekap Akuisisi </h3>
</div>

                    <!-- DataTales Example -->
               
                        <div class="card-body py-3">
                        <form id= "form3"  name="simpanform" onsubmit="return validasiForm()" action="{{route('rekapakuisisi.importbulan')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-4 mt-2">
                                                <label for="" class="form-label">Pilih KCU</label>

<select name="kcu" class="form-control " style="border-color: #01004C;" aria-label=".form-select-lg example"  oninvalid="this.setCustomValidity('Pilih salah satu KCU')" oninput="setCustomValidity('')" required>
  

<option value="" selected disabled>-- Pilih KCU --</option>
@foreach ($kcu as $item)
        <option value="{{ $item->id }}"{{ old('kcu') == $item->id ? 'selected' : '' }}> {{ $item->nama_kcu }}</option>
    @endforeach
</select>

                                            </div>


                                            <!-- <label class="mt-3" for="">Bulan :</label>
                            <input type="month" id="bulan" name="bulan"> -->

                            <label class="mt-3" for="">Tanggal Awal:</label>
                            <input type="date" id="tanggal_awal" name="tanggal_awal">

                            <label class="mt-3" for="">Tanggal Akhir:</label>
                            <input type="date" id="tanggal_akhir" name="tanggal_akhir">

                           
  <div class="form-group mt-3">
    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <button type="submit" class="btn btn-primary btn-sm">Import Data</button>   
  
</form>



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
    
   

<script>

function validateForm(){
    let tanggal_awal = document.forms["saveformCall"]["tanggal_awal"].value;
    let tanggal_akhir = document.forms ["saveformCall"]["tanggal_akhir"].value;
    let file = document.forms["saveformCall"]["file"].value;
    if (tanggal_awal == ""){
        alert("Tanggal Awal tidak boleh kosong");
        return false;
    }

    else if (tanggal_akhir == ""){
        alert("Tanggal Akhir tidak boleh kosong");
        return false;
    }

    else
    if (file == ""){
        alert("File Rekap Call tidak boleh kosong");
        return false;
    }
}

function validasiForm() {
    let tanggal_awal = document.forms["simpanform"]["tanggal_awal"].value;
    let tanggal_akhir = document.forms ["simpanform"]["tanggal_akhir"].value;
    let file = document.forms["simpanform"]["file"].value;
    if (tanggal_awal == ""){
        alert("Tanggal Awal tidak boleh kosong");
        return false;
    }

    else if (tanggal_akhir == ""){
        alert("Tanggal Akhir tidak boleh kosong");
        return false;
    }

    else

    if (file == ""){
        alert("File Rekap Akuisisi tidak boleh kosong");
        return false;
    }
}
</script>


<script>

function formvalidasi() {
    
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form1 = document.getElementById('form1');
        const form2 = document.getElementById('form2');
        const form3 = document.getElementById('form3');
        const loading1 = document.getElementById('loading1');
        const loading2 = document.getElementById('loading2');
        const loading3 = document.getElementById('loading3');

        form1.addEventListener('submit', function() {
            loading1.style.display = 'block';
        });

        form2.addEventListener('submit', function() {
            loading2.style.display = 'block';
        });

        form3.addEventListener('submit', function() {
            loading3.style.display = 'block';
        });
    });
</script>

<style>
    #loading1 {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    text-align: center;
    padding-top: 200px;
    color: white;
}
#loading2 {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    text-align: center;
    padding-top: 200px;
    color: white;
}
#loading3 {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    text-align: center;
    padding-top: 200px;
    color: white;
}
</style>
   @endsection