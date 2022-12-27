<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = "appointment";
    protected $primaryKey = "appointment_id";
    
    protected $fillable = ['user_id', 'patient_name', 'patient_contact', 'patient_email',
                            'doctor_id', 'slot_id', 'time', 'reason', 'token', 'confirm', 'receive', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

    public function scopeSearch($appointment)
    {
        if($search_text = request()->keyword)
        {
            $appointment = $appointment->where('appointment_id', 'LIKE', '%'.$search_text.'%')
                                        ->orWhere('patient_name', 'LIKE', '%'.$search_text.'%')
                                        ->orWhere('patient_contact', 'LIKE', '%'.$search_text.'%')
                                        ->orWhere('patient_email', 'LIKE', '%'.$search_text.'%')
                                        ->orWhere('time', 'LIKE', '%'.$search_text.'%')
                                        ->orWhere('reason', 'LIKE', '%'.$search_text.'%');
        }
        
        return $appointment;
    }
}
