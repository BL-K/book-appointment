<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function blog_add()
    {
        return view('admin.blog_add');
    }

    public function insert_blog()
    {
        $data = request()->validate([
            'blog_title' => 'required',
            'blog_image' => 'required|image',
            'blog_content' => 'required',
        ]);

        $imagePath = request('blog_image')->store('admin_uploads/blog', 'public');

        $blog = new Blog();

        $blog->blog_title = $data['blog_title'];
        $blog->blog_image = $imagePath;
        $blog->blog_content = $data['blog_content'];
        
        $blog->save();

        return redirect()->back()->with('success', 'Tuyệt !!! Blog đã được tạo thành công.');
    }

    public function blog_list()
    {
        $blog = Blog::orderBy('blog_id', 'DESC')->search()->paginate(10);

        return view('admin.blog_list')->with(compact('blog'));
    }

    public function blog_view_edit($blog_id)
    {
        $blog = Blog::find($blog_id);

        return view('admin.blog_view_edit')->with(compact('blog'));
    }

    public function update_blog($blog_id)
    {
        $data = request()->validate([
            'blog_title' => 'required',
            'blog_content' => 'required',
        ]);

        $blog = Blog::find($blog_id);

        $image = request('blog_image');
        if($image)
        {
            $imagePath = request('blog_image')->store('admin_uploads/blog', 'public');
            
            $blog->blog_title = $data['blog_title'];
            $blog->blog_image = $imagePath;
            $blog->blog_content = $data['blog_content'];
        }
        else
        {
            $blog->blog_title = $data['blog_title'];
            $blog->blog_content = $data['blog_content'];
        }

        $blog->save();
        
        return redirect()->back()->with('success', 'Tuyệt !!! Blog đã được cập nhật thành công.');
    }

    public function delete_blog($blog_id)
    {
        $blog = Blog::find($blog_id);

        $destinationPath = 'public/'.$blog->blog_image;
        if(file_exists($destinationPath))
        {
            unlink($destinationPath);
        }
        
        $blog->delete();

        return redirect()->back()->with('success', 'Blog đã được xóa thành công.');
    }
}
