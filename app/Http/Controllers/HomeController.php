<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirectAfterLogin()
    {
        if (Auth::check() && Auth::user()->role ) {
            return redirect('admins/dashboard');
        } elseif (Auth::check() && !Auth::user()->role ) {
            return redirect('/');
        } else {
            return redirect('/');
        }
    }

    public function index()
    {
    return view('customers.home');
    }



    

}
