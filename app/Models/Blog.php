<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blog";
    protected $primaryKey = "blog_id";
    
    protected $fillable = ['blog_title', 'blog_image', 'blog_content'];

    public function scopeSearch($blog)
    {
        if($search_text = request()->keyword)
        {
            $blog = $blog->where('blog_id', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('blog_title', 'LIKE', '%'.$search_text.'%')
                        ->orWhere('blog_content', 'LIKE', '%'.$search_text.'%');
        }
        
        return $blog;
    }
}
