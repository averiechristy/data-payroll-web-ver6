@extends('layouts.app')

@section('content')

<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Edit User Akun
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="/updateuser/{{$data->id}}" method="post" onsubmit="return validateForm()">
                                         
                                       
                                       @csrf

                                          




                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Nama</label>
                                                <input name="nama" type="text"  value="{{$data->nama}}" class="form-control {{$errors->has('nama') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="{{old('nama')}}"  oninvalid="this.setCustomValidity('Nama user tidak boleh kosong')" oninput="setCustomValidity('')" />
                                                @if ($errors->has('nama'))
                                                    <p class="text-danger">{{$errors->first('nama')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group mb-4">
    <label for="" class="form-label">Username</label>
    <input name="username" type="text" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"
        style="border-color: #01004C;" value="{{$data->username}}"
        oninput="removeSpecialCharacters(this); setCustomValidity('')"
        onkeydown="avoidSpace(event);" />

    @if ($errors->has('username'))
        <p class="text-danger">{{$errors->first('username')}}</p>
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
    let nama = document.forms["saveform"]["nama"].value;
    let username = document.forms ["saveform"]["username"].value;


    if (nama == ""){
        alert("Nama tidak boleh kosong");
        return false;
    }

    else if (username == ""){
        alert("Username tidak boleh kosong");
        return false;
    }
}
</script>

  
@endsection