@extends('layouts.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="mt-3">
@include('components.alert')
</div>
                <div class="card shadow mb-4">
                    <!-- Page Heading -->
                    <div class="card-header py-3">
                    <h3 class="h3 mb-2 text-gray-800">Rekap Call</h3>
</div>

                    <!-- DataTales Example -->
               
                        <div class="card-body py-3">
                        <form  name="saveform" onsubmit="return validateForm()" action="{{route('rekapcall.import')}}" method="POST" enctype="multipart/form-data">
                            @csrf
  <div class="form-group">
    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <button type="submit" class="btn btn-primary btn-sm">Import Data</button>   
  
</form>



                        </div>
                    
                    </div>


                    <div class="card shadow mb-4">
                    <!-- Page Heading -->
                    <div class="card-header py-3">
                    <h3 class="h3 mb-2 text-gray-800">Rekap Akuisisi</h3>
</div>

                    <!-- DataTales Example -->
               
                        <div class="card-body py-3">
                        <form  name="simpanform" onsubmit="return validasiForm()" action="{{route('rekapakuisisi.import')}}" method="POST" enctype="multipart/form-data">
                            @csrf
  <div class="form-group">
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

function validateForm() {
   
    let file = document.forms["saveform"]["file"].value;

    if (file == ""){
        alert("File Rekap Call tidak boleh kosong");
        return false;
    }
}
</script>

<script>

function validasiForm() {
   
    let file = document.forms["simpanform"]["file"].value;

    if (file == ""){
        alert("File Rekap Akuisisi tidak boleh kosong");
        return false;
    }
}
</script>
   @endsection