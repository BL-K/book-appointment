<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use HasFactory;

    protected $table = "hospital";
    protected $primaryKey = 'hospital_id';

    protected $fillable = ['user_id', 'hospital_name', 'hospital_image', 'hospital_contact',
                            'hospital_email', 'hospital_url', 'hospital_desc',
                            'hospital_address', 'hospital_city',
                            'open_week', 'close_week', 'open_sat', 'close_sat', 'open_sun', 'close_sun'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($hospital)
    {
        if($search_text = request()->keyword)
        {
            $hospital = $hospital->where('hospital_id', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('hospital_name', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('hospital_contact', 'LIKE', '%'.$search_text.'%')
                                    ->orWhere('hospital_email', 'LIKE', '%'.$search_text.'%');
        }
        
        return $hospital;
    }
}
