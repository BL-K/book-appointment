<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = "patient";
    protected $primaryKey = "patient_id";
    
    protected $fillable = ['user_id', 'patient_name','patient_dob', 'patient_gender','patient_contact', 
                            'patient_email', 'patient_address', 'patient_city'];

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'appointment_id');
    }

    public function scopeSearch($patient)
    {
        if($search_text = request()->keyword)
        {
            $patient = $patient->where('patient_id', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('patient_name', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('patient_dob', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('patient_gender', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('patient_email', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('patient_contact', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('patient_address', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('patient_city', 'LIKE', '%'.$search_text.'%');
        }
        
        return $patient;
    }
}
