<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    
    protected $table = 'speciality';
    protected $primaryKey = "speciality_id";

    protected $fillable = ['speciality_name', 'speciality_icon'];

    public function hospital()
    {
        return $this->hasMany(Hospital::class, 'hospital_id');
    }

    public function doctor()
    {
        return $this->hasMany(Doctor::class, 'doctor_id');
    }

    public function hospital_speciality()
    {
        return $this->hasMany(Hospital_Speciality::class, 'hospital_speciality_id');
    }

    public function scopeSearch($speciality)
    {
        if($search_text = request()->keyword)
        {
            $speciality = $speciality->where('speciality_id', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('speciality_name', 'LIKE', '%'.$search_text.'%');
        }
        
        return $speciality;
    }
}
