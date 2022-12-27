<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital_Speciality extends Model
{
    use HasFactory;

    protected $table = "hospital_speciality";
    protected $primaryKey = "hospital_speciality_id";

    protected $fillable = ['user_id', 'speciality_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($hospital_speciality)
    {
        if($search_text = request()->keyword)
        {
            $hospital_speciality = $hospital_speciality->where('hospital_speciality_id', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('speciality_name', 'LIKE', '%'.$search_text.'%');
        }
        
        return $hospital_speciality;
    }
}
