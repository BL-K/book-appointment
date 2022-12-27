<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperation extends Model
{
    use HasFactory;

    protected $table = "cooperation";
    protected $primaryKey = "cooperation_id";
    
    protected $fillable = ['person_name','person_contact', 'person_email','hospital_name', 
                            'hospital_address', 'cooperation_content'];

    public function scopeSearch($cooperation)
    {
        if($search_text = request()->keyword)
        {
            $cooperation = $cooperation->where('cooperation_id', 'LIKE', '%'.$search_text.'%')
                                        ->orWhere('hospital_name', 'LIKE', '%'.$search_text.'%')
                                        ->orWhere('person_contact', 'LIKE', '%'.$search_text.'%')
                                        ->orWhere('person_email', 'LIKE', '%'.$search_text.'%');
        }
        
        return $cooperation;
    }
}
