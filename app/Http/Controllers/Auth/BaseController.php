<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function($request,$next){
        $this->user = Auth::user();
        return $next($request);
        });
    }

    public function getRole()
    {
        return $this->user->name;
    }
}
