<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "review";
    protected $primaryKey = 'review_id';

    protected $fillable = ['review_name', 'review', 'doctor_id'];

    public function scopeSearch($review)
    {
        if($search_text = request()->keyword)
        {
            $review = $review->where('review_id', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('review_name', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('review', 'LIKE', '%'.$search_text.'%');
        }
        
        return $review;
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
