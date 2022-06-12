<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
class HomePageController extends Controller
{

    public function index()
    {

        $sliders = Slider::select('title' , 'link' , 'small_image' , 'big_image')->where('status', 1)
            ->get();

            $categories =  Category::select('name' , 'description' , 'image')->where('status', '!=', 0)->get();

          $deals = Product::
            with(['category'])
            ->where('offer', "!=", 0)->where('status' , 1) ->limit(8)->get();

            $bestSelling = Product::
            with(['category'])
            ->where('offer', null)->where('status' , 1) ->limit(8)->get();


        $share = Product::
            with(['category'])->offset(8)
            ->limit(6)->get();

        return view('customers.home')->with([
            'sliders' => $sliders,
            'deals' => $deals,
            'categories' => $categories,
            'share' => $share,
            'bestSelling' => $bestSelling,
        ]);
    }

}
