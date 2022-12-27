<?php

namespace App\Models;

use App\Models\Hospital;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $primaryKey = 'id';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'userType',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isHospital(){
        return $this->userType == 'USR';
    }

    public function hospital()
    {
        return $this->hasOne(Hospital::class);
    }

    public function scopeSearch($user)
    {
        if($search_text = request()->keyword)
        {
            $user = $user->where('id', 'LIKE', '%'.$search_text.'%')
                            ->orWhere('name', 'LIKE', '%'.$search_text.'%')
                            ->orWhere('email', 'LIKE', '%'.$search_text.'%');
        }

        return $user;
    }
}
