@extends('layouts.admin_app')

@section('content')
    <h1 class="page-title">Cập nhật blog</h1>
    <hr style="height:2px; background-color:gray;">

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
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
            <form name="add_form" method="POST" action="{{ URL::to('admin/update_blog/'. $blog->blog_id) }}" enctype="multipart/form-data">
                @csrf
                <div class="panel-heading">
                    <h3>Cập nhật blog</h3>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="form-group col-md-6">
                                <label for="blog_title">Tiêu đề blog</label>
                                <input id="blog_title" type="text"
                                    class="form-control @error('blog_title') is-invalid @enderror" name="blog_title"
                                    value="{{ $blog->blog_title }}" required autofocus>
                                @error('blog_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                           
                            <div class="form-group col-md-6">
                                <label for="blog_image">Hình ảnh blog</label>
                                <br>
                                <div class="col-md-4">
                                    <div class="imageupload">
                                        <img src="{{ URL::to('public/' . $blog->blog_image) }}"
                                            style="width: 300%; height:300%;" id="output" class="img-fluid thumbnail"
                                            title="Hình ảnh blog">
                                        <div class="col-sm-6" style="width: 300%;">
                                            <input id="blog_image" type="file"
                                                class="form-control @error('blog_image') is-invalid @enderror"
                                                name="blog_image" value="{{ $blog->blog_image }}"
                                                autofocus accept="image/*" onchange="openFile(event)">
                                        </div>
                                    </div>
                                    @error('blog_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="blog_content">Nội dung blog</label>
                            <textarea type="text" id="blog_content" name="blog_content" class="form-control ckeditor">{{ $blog->blog_content }}</textarea>
                            @error('blog_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <button type="reset" class="btn btn-outline-secondary btn-block">Xóa</button>
                </div>
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <style type="text/css">
        input[type="checkbox"] {
            zoom: 1.1;
        }

        label {
            font-size: 15px;
        }

        .imageupload {
            margin-left: -10%;
        }
    </style>

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
@endsection
