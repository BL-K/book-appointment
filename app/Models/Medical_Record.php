<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_Record extends Model
{
    use HasFactory;

    protected $table = "medical_record";
    protected $primaryKey = "medical_record_id";
    
    protected $fillable = ['appointment_id', 'medical_record'];

}
