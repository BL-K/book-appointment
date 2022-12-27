@extends('layouts.hospital_app')

@section('content')
    <h1 class="page-title">Đánh giá</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Đánh giá về bác sĩ {{$doctor->doctor_name}}</h3>
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
                <br>
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
                                    <th>Họ và tên</th>
                                    <th>Nội dung</th>
                                    <th>Ngày đánh giá</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            @php $i=1; @endphp
                            @foreach ($review as $rev_list)
                                <tbody>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$rev_list->review_name}}</td>
                                        <td>{{$rev_list->review}}</td>
                                        <td>{{ date('d-m-Y', strtotime($rev_list->created_at)) }}</td>
                                        <td><a onclick="return confirm('Bạn có muốn xóa đánh giá của {{$rev_list->review_name}}?');"
                                            href="{{ URL::to('hospital/delete_review/' . $rev_list->review_id) }}"
                                            class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                    </tr>       
                                </tbody>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ và tên</th>
                                    <th>Nội dung</th>
                                    <th>Ngày đánh giá</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
