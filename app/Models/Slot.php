<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $table = "slot";
    protected $primaryKey = 'slot_id';

    protected $fillable = ['date', 'doctor_id'];

    public function time()
    {
        return $this->hasMany(Time::class, 'time_id');
    }

    public function scopeSearch($slot)
    {
        if($search_text = request()->keyword)
        {
            $slot = $slot->where('slot_id', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('date', 'LIKE', '%'.$search_text.'%');
        }

        return $slot;
    }
}
