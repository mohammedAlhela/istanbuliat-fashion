<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{

    public function __construct()
    {

        $this->middleware([
             'cors']);

    }

    public function getData()
    {
        $admins = DB::table('users')->where('role', '!=', 0)->select('name')->get();
        $customers = DB::table('users')->where('role', 0)->select('name')->get();
        $products = DB::table('products')->select('name')->get();
        $subscribes = DB::table('subscribes')->select('email')->get();

        $response = [
            'admins' => $admins,
            'products' => $products,
            'customers' => $customers,
            'subscribes' => $subscribes,
        ];

        return response($response, 201);
    }

}
