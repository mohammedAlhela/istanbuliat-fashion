<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Share;

class HomePageController extends Controller
{

    public function index()
    {

        $sliders = Slider::where('status', 1)
            ->get();

        $categories = Category::get();

        $deals = Product::
            with(['category', 'variations', 'colors', 'sizes'])
            ->where('offer', "!=", 0)->get();

        $share = Product::
            with(['category', 'variations', 'colors', 'sizes'])->offset(8)
            ->limit(6)->get();

        return view('customers.home')->with([
            'sliders' => $sliders,
            'deals' => $deals,
            'categories' => $categories,
            'share' => $share,

        ]);
    }

    public function shareProduct()
    {
        $socialShare = Share::page('http://127.0.0.1:8000/shop?category=dresses', 'Shop new dresses products')->facebook()->twitter()->linkedin()->telegram()->whatsapp()->getRawLinks();

dd($socialShare);
    }

}
