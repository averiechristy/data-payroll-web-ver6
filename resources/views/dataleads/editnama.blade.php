@extends('layouts.app')

@section('content')

<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Tambahkan KCU Baru
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="/rename/{{$data->id}}" method="post" onsubmit="return validateForm()">
                                         
                                       
                                       @csrf

                                       <div class="form-group">
                        <label for="}">Nama Customer</label>
                        <input type="text" class="form-control" name="new_name" value="{{$data->cust_name}}" required>
                    </div>  


                                             

                                          

                                            <div class="form-group mb-4">
                                                <button type="submit" class="btn " style="background-color: #01004C; color: white;">Simpan</button>
                                            </div>
                                        </form>
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


    <script>

function validateForm() {
    let namacust = document.forms["saveform"]["new_name"].value;


    if (namacust == ""){
        alert("Nama Customer tidak boleh kosong");
        return false;
    }

}
</script>


  
@endsection