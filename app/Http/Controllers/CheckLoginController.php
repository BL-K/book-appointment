<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function checkUserType()
    {
        if(!Auth::user())
        {
            return redirect()->route('login');
        }
        if(Auth::user()->userType === 'ADM')
        {
            return redirect()->route('admin.dashboard.dashboard');
        }
        if(Auth::user()->userType === 'USR')
        {
            return redirect()->route('hospital.dashboard.dashboard');
        }
    }

}

