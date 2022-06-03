<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Product;
use App\Models\Subscribe;




class DashboardController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function getData()
    {
        $admins = User::where('role', '!=', 0)->get();
        $customers = User::where('role', 0)->get();
        $products = Product::all();
        $subscribers = Subscribe::all();

        $response = [
            'admins' => $admins,
            'products' => $products,
            'customers' => $customers,
            'subscribers' => $subscribers
        ];

        return response($response, 201);
    }


}
