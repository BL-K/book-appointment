<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $table = "time";
    protected $primaryKey = 'time_id';

    protected $fillable = ['time', 'slot_id', 'status'];

    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

}
