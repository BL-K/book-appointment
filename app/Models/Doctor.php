<?php

namespace App\Models;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    
    protected $table = "doctor";
    protected $primaryKey = "doctor_id";
    
    protected $fillable = ['user_id', 'doctor_name', 'doctor_avatar', 'speciality_name', 'doctor_experience', 
                            'doctor_dob', 'doctor_gender', 'doctor_contact', 'doctor_email', 'doctor_desc', 
                            'doctor_address', 'doctor_city'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function slot()
    {
        return $this->hasMany(Slot::class, 'slot_id');
    }

    public function scopeSearch($doctor)
    {
        if($search_text = request()->keyword)
        {
            $doctor = $doctor->where('doctor_id', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('doctor_name', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('doctor_email', 'LIKE', '%'.$search_text.'%');
        }
        return $doctor;
    }
}
