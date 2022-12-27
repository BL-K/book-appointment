@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Tạo khung giờ</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <form name="add_form" method="POST" action="{{ URL::to('hospital/insert_slot') }}" enctype="multipart/form-data">
                @csrf
                <div class="panel-heading">
                    <h3>Tạo khung giờ</h3>
                </div>
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
                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group col-md-6">
                            <label for="doctor_id">Bác sĩ</label>
                            <input type="hidden" name="doctor_id" id="doctor_id" value="{{ $doctor->doctor_id }}">
                            <input type="text" class="form-control" id="doctor_id" value="{{ $doctor->doctor_name }}" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="speciality">Chuyên khoa</label>
                            <input id="speciality" type="text" class="form-control" name="speciality"
                                value="{{ $doctor->speciality_name }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group col-md-6">
                            <label>Chọn ngày</label>
                            <input type="date" class="form-control" name="date" min="{{ date("Y-m-d", strtotime('+1 day')) }}">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>Chọn thời gian</label>
                            <br>
                            @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p>Chọn tất cả
                                <input type="checkbox"
                                    onclick=" for(c in document.getElementsByName('time[]')) document.getElementsByName('time[]').item(c).checked=this.checked">
                            </p>
                            <table id="datatable" class="table table-striped" style="width:100%">
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="07:00 - 07:30"> 07:00 - 07:30</td>
                                        <td><input type="checkbox" name="time[]" value="07:30 - 08:00"> 07:30 - 08:00</td>
                                        <td><input type="checkbox" name="time[]" value="08:00 - 08:30"> 08:00 - 08:30</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="08:30 - 09:00"> 08:30 - 09:00</td>
                                        <td><input type="checkbox" name="time[]" value="09:00 - 09:30"> 09:00 - 09:30</td>
                                        <td><input type="checkbox" name="time[]" value="09:30 - 10:00"> 09:30 - 10:00</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="10:00 - 10:30"> 10:00 - 10:30</td>
                                        <td><input type="checkbox" name="time[]" value="10:30 - 11:00"> 10:30 - 11:00</td>
                                        <td><input type="checkbox" name="time[]" value="11:00 - 11:30"> 11:00 - 11:30</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="13:00 - 13:30"> 13:00 - 13:30</td>
                                        <td><input type="checkbox" name="time[]" value="13:30 - 14:00"> 13:30 - 14:00</td>
                                        <td><input type="checkbox" name="time[]" value="14:00 - 14:30"> 14:00 - 14:30</td>
                                    </tr>
                                        <td><input type="checkbox" name="time[]" value="14:30 - 15:00"> 14:30 - 15:00</td>
                                        <td><input type="checkbox" name="time[]" value="15:00 - 15:30"> 15:00 - 15:30</td>
                                        <td><input type="checkbox" name="time[]" value="15:30 - 16:00"> 15:30 - 16:00</td>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="16:00 - 16:30"> 16:00 - 16:30</td>
                                        <td><input type="checkbox" name="time[]" value="16:30 - 17:00"> 16:30 - 17:00</td>
                                        <td><input type="checkbox" name="time[]" value="17:00 - 17:30"> 17:00 - 17:30</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="17:30 - 18:00"> 17:30 - 18:00</td>
                                        <td><input type="checkbox" name="time[]" value="18:00 - 18:30"> 18:00 - 18:30</td>
                                        <td><input type="checkbox" name="time[]" value="18:30 - 19:00"> 18:30 - 19:00</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary btn-block" name="save">Tạo</button>
                </div>
            </form>
        </div>
    </div>
    <style type="text/css">
        input[type="checkbox"] {
            zoom: 1.1;
        }

        table,
        p {
            font-size: 18px;
        }

        p {
            margin-left: 80%;
        }
    </style>
@endsection
