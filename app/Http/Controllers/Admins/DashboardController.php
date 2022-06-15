<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{

    public function __construct()
    {

        $this->middleware([
             'admin']);

    }

    public function index()
    {

    return view('admins.dashboard');
    }


    public function getData()
    {
        $admins = DB::table('users')->where('role', '!=', 0)->select('username')->get();
        $customers = DB::table('users')->where('role', 0)->select('username')->get();
        $products = DB::table('products')->select('name')->get();
        $subscribers = DB::table('subscribers')->select('email')->get();

        $response = [
            'admins' => $admins,
            'products' => $products,
            'customers' => $customers,
            'subscribers' => $subscribers,
        ];

        return response($response, 201);
    }

}
