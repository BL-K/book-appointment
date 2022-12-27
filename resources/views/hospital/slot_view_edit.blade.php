@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Cập nhật khung giờ khám bệnh</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <form name="add_form" method="POST" action="{{ URL::to('hospital/update_slot/'.$slot->slot_id) }}" enctype="multipart/form-data">
                @csrf
                <div class="panel-heading">
                    <h3>Cập nhật khung giờ khám bệnh</h3>
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
                            <label>Ngày</label>
                            <input type="hidden" class="form-control" id="week" name="week" value="{{ date('d-m-Y', strtotime($slot->date)) }}">
                            <input class="form-control" id="week" name="week" value="{{ date('d-m-Y', strtotime($slot->date)) }}" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Thời gian</label>
                            <p>Chọn tất cả
                                <input type="checkbox"
                                    onclick=" for(c in document.getElementsByName('time[]')) document.getElementsByName('time[]').item(c).checked=this.checked">
                            </p>

                            <table id="datatable" class="table table-striped" style="width:100%">
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="07:00 - 07:30" @if (isset($time)){{ $time->contains('time', '07:00 - 07:30') ? 'checked' : '' }}@endif> 07:00 - 07:30</td>
                                        <td><input type="checkbox" name="time[]" value="07:30 - 08:00" @if (isset($time)){{ $time->contains('time', '07:30 - 08:00') ? 'checked' : '' }}@endif> 07:30 - 08:00</td>
                                        <td><input type="checkbox" name="time[]" value="08:00 - 08:30" @if (isset($time)){{ $time->contains('time', '08:00 - 08:30') ? 'checked' : '' }}@endif> 08:00 - 08:30</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="08:30 - 09:00" @if (isset($time)){{ $time->contains('time', '08:30 - 09:00') ? 'checked' : '' }}@endif> 08:30 - 09:00</td>
                                        <td><input type="checkbox" name="time[]" value="09:00 - 09:30" @if (isset($time)){{ $time->contains('time', '09:00 - 09:30') ? 'checked' : '' }}@endif> 09:00 - 09:30</td>
                                        <td><input type="checkbox" name="time[]" value="09:30 - 10:00" @if (isset($time)){{ $time->contains('time', '09:30 - 10:00') ? 'checked' : '' }}@endif> 09:30 - 10:00</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="10:00 - 10:30" @if (isset($time)){{ $time->contains('time', '10:00 - 10:30') ? 'checked' : '' }}@endif> 10:00 - 10:30</td>
                                        <td><input type="checkbox" name="time[]" value="10:30 - 11:00" @if (isset($time)){{ $time->contains('time', '10:30 - 11:00') ? 'checked' : '' }}@endif> 10:30 - 11:00</td>
                                        <td><input type="checkbox" name="time[]" value="11:00 - 11:30" @if (isset($time)){{ $time->contains('time', '11:00 - 11:30') ? 'checked' : '' }}@endif> 11:00 - 11:30</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="13:00 - 13:30" @if (isset($time)){{ $time->contains('time', '13:00 - 13:30') ? 'checked' : '' }}@endif> 13:00 - 13:30</td>
                                        <td><input type="checkbox" name="time[]" value="13:30 - 14:00" @if (isset($time)){{ $time->contains('time', '13:30 - 14:00') ? 'checked' : '' }}@endif> 13:30 - 14:00</td>
                                        <td><input type="checkbox" name="time[]" value="14:00 - 14:30" @if (isset($time)){{ $time->contains('time', '14:00 - 14:30') ? 'checked' : '' }}@endif> 14:00 - 14:30</td>
                                    </tr>
                                        <td><input type="checkbox" name="time[]" value="14:30 - 15:00" @if (isset($time)){{ $time->contains('time', '14:30 - 15:00') ? 'checked' : '' }}@endif> 14:30 - 15:00</td>
                                        <td><input type="checkbox" name="time[]" value="15:00 - 15:30" @if (isset($time)){{ $time->contains('time', '15:00 - 15:30') ? 'checked' : '' }}@endif> 15:00 - 15:30</td>
                                        <td><input type="checkbox" name="time[]" value="15:30 - 16:00" @if (isset($time)){{ $time->contains('time', '15:30 - 16:00') ? 'checked' : '' }}@endif> 15:30 - 16:00</td>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="16:00 - 16:30" @if (isset($time)){{ $time->contains('time', '16:00 - 16:30') ? 'checked' : '' }}@endif> 16:00 - 16:30</td>
                                        <td><input type="checkbox" name="time[]" value="16:30 - 17:00" @if (isset($time)){{ $time->contains('time', '16:30 - 17:00') ? 'checked' : '' }}@endif> 16:30 - 17:00</td>
                                        <td><input type="checkbox" name="time[]" value="17:00 - 17:30" @if (isset($time)){{ $time->contains('time', '17:00 - 17:30') ? 'checked' : '' }}@endif> 17:00 - 17:30</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="time[]" value="17:30 - 18:00" @if (isset($time)){{ $time->contains('time', '17:30 - 18:00') ? 'checked' : '' }}@endif> 17:30 - 18:00</td>
                                        <td><input type="checkbox" name="time[]" value="18:00 - 18:30" @if (isset($time)){{ $time->contains('time', '18:00 - 18:30') ? 'checked' : '' }}@endif> 18:00 - 18:30</td>
                                        <td><input type="checkbox" name="time[]" value="18:30 - 19:00" @if (isset($time)){{ $time->contains('time', '18:30 - 19:00') ? 'checked' : '' }}@endif> 18:30 - 19:00</td>
                                    </tr> 
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary btn-block" name="save">Cập nhật</button>
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
            margin-left: 1000px;
        }
    </style>
@endsection
