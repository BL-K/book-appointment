@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Danh sách blog</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Danh sách blog</h3>
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
                                    <th>Tiêu đề</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            @foreach ($blog as $blog_list)
                                <tbody>
                                    <tr>
                                        <td>{{ $blog_list->blog_title }}</td>
                                        <td>
                                            <a href="{{ URL::to('admin/blog_view_edit/' . $blog_list->blog_id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-eye"></i> | <i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('Bạn có muốn xóa blog {{ $blog_list->blog_title }}?');"
                                                href="{{ URL::to('admin/delete_blog/' . $blog_list->blog_id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                            <tfoot>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </tfoot>
                        </table>
                        <br>
                        <div class="">
                            {{ $blog->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
