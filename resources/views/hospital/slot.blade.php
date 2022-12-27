@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Khung giờ khám bệnh</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Danh sách bác sĩ</h3>
                </div>

                <form action="" type="get">
                    @csrf
                    <ul class="nav navbar-nav search-nav">
                        <li>
                            <div class="search">
                                <div class="form-group form-animate-text">
                                    <input type="text" id="keyword" name="keyword" class="form-text"
                                        placeholder="Tìm kiếm" required>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-primary" style="height: 45px"><i
                            class="fas fa-search"></i></button>
                </form>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatable" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Bác sĩ</th>
                                    <th>Chuyên khoa</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            @php $i=1; @endphp
                        @foreach ($doctor as $doc_list)
                                <tbody>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$doc_list->doctor_name}}</td>  
                                        <td>{{$doc_list->speciality_name}}</td>
                                        <td>
                                            <a href="{{URL::to ('hospital/slot_date/'.$doc_list->doctor_id)}}" class="btn btn-sm btn-success"><i class="fa-solid fa-list"></i></a>
                                            <a href="{{URL::to ('hospital/slot_add/'.$doc_list->doctor_id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Tạo khung giờ</a>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Bác sĩ</th>
                                    <th>Chuyên khoa</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                        <div class="">
                            {{$doctor->appends(request()->all())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
