<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;

class ShopController extends Controller
{

    public function index()
    {

        $products = Product::orderBy('updated_at')->where('status', 1)->with(['category', 'colors', 'sizes'])->get();

        foreach ($products as $product) {

            $product->colorsNamesString = implode(",", array_unique($product->colors->pluck('name')->all()));
            $product->sizesNamesString = implode(",", array_unique($product->sizes->pluck('name')->all()));

        }

        $sizes = Size::all();
        $colors = Color::all();

        foreach ($colors as $color) {

            $color->productsLength =  array_unique($color->products->pluck('name')->all());
      

        }

        foreach ($sizes as $size) {

            $size->productsLength =  array_unique($size->products->pluck('name')->all());
      

        }


        foreach ($products as $product) {

            $product->colorsNamesString = implode(",", array_unique($product->colors->pluck('name')->all()));
            $product->sizesNamesString = implode(",", array_unique($product->sizes->pluck('name')->all()));

        }

        $categories = Category::where('status', '!=', 0)->with('products')->get();
        $max_price = 0;
        if(count(Product::all())) { 
            $max_price = Product::orderBy('price', 'desc')->first()->price;
        }

        return view('customers.shop')->with([
            'products' => $products,
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
            'max_price' => $max_price,
        ]);

    }
}
