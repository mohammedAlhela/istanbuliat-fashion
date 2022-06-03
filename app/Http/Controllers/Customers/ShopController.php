<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Variation;
use DB;
use App\Http\Resources\Admins\ProductsResource;

class ShopController extends Controller
{

    public function index()
    {

        $products = Product::orderBy('updated_at')->where('status' , 1)->with('category')->get();
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Category::where('status' , '!=' , 0)->with('products')->get();
        $max_price = Product::orderBy('price' , 'desc')->first()->price;

        return view('customers.shop')->with([
            'products' => $products,
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
            'max_price' => $max_price,
        ]);

    }
}
