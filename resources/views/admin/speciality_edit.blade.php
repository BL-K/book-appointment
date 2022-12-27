@extends('layouts.admin_app')

@section('content')

    <h1 class="page-title">Cập nhật chuyên khoa</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel-heading"><h3>Cập nhật chuyên khoa</h3></div>
            @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <br>
                <div class="panel">
                    <div class="panel-body">
                        <form name="add_form" class="inline-form" method="POST" action="{{URL::to ('admin/update_speciality/'.$speciality->speciality_id)}}" enctype="multipart/form-data">
                            @csrf 
                             <div class="form-group row">
                                 <label for="speciality_name" class="col-sm-3 col-form-label text-right">Chuyên khoa</label>
                                 <div class="col-sm-6">
                                     <input id="speciality_name" type="text" class="form-control @error('speciality_name') is-invalid @enderror" name="speciality_name" value="{{ $speciality->speciality_name }}" required autocomplete="speciality_name">
 
                                     @error('speciality_name')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="speciality_icon" class="col-sm-3 col-form-label text-right">Biểu tượng</label>
                                 <div class="col-sm-6">
                                     <input id="speciality_icon" type="file" class="form-control" name="speciality_icon" value="{{ $speciality->speciality_icon }}" accept="image/*" onchange="openFile(event)">
                                     <script>
                                         var openFile = function(file) {
                                             var input = file.target;
     
                                             var reader = new FileReader();
                                             reader.onload = function() {
                                                 var dataURL = reader.result;
                                                 var output = document.getElementById('output');
                                                 output.src = dataURL;
                                             };
                                             reader.readAsDataURL(input.files[0]);
                                         };
                                     </script>
                                     @error('speciality_icon')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                 </div>
                             </div>
                             <div class="form-group row" align="center">
                                 <label for="inputIcon" class="col-sm-3 col-form-label text-right"></label>
                                     <div class="col-sm-6">
                                         <img src="{{URL::to ('public/'.$speciality->speciality_icon )}}" id="output" class="img-fluid thumbnail" width="60px" height="60px">
                                     </div>
                             </div>
                                 <div class="form-group row" style="text-align: center;">
                                     <button type="reset" class="btn btn-light btn-sm px-5 mr-2" name="clear">Xóa</button>
                                     <button type="submit" class="btn btn-primary btn-sm px-5" name="save">Cập nhật</button>
                                 </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection