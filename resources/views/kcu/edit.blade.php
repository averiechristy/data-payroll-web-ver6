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
                                       <form name="saveform" action="/updatekcu/{{$data->id}}" method="post" onsubmit="return validateForm()">
                                         
                                       
                                       @csrf

                                          




                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Nama KCU</label>
                                                <input name="nama_kcu" type="text"  class="form-control {{$errors->has('nama_kcu') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="{{ old('nama_kcu', $data->nama_kcu) }}"  oninvalid="this.setCustomValidity('Nama user tidak boleh kosong')" oninput="setCustomValidity('')" />
                                                @if ($errors->has('nama_kcu'))
                                                    <p class="text-danger">{{$errors->first('nama_kcu')}}</p>
                                                @endif
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
    let namakcu = document.forms["saveform"]["nama_kcu"].value;


    if (namakcu == ""){
        alert("Nama KCU tidak boleh kosong");
        return false;
    }

}
</script>


  
@endsection