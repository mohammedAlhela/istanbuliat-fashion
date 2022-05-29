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

        $products = Product::orderBy('updated_at')->with('category')->get();
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Category::with('products')->get();
        $max_price = Product::orderBy('price' , 'desc')->first()->price;

        foreach ($colors as $color) { 
            $productsIds = DB::table('variations')->where('color_id', $color->id)->pluck('product_id')->all();
            $uniqueProductsIds = array();
            foreach ( $productsIds as $productId) { 
             if(!in_array($productId , $uniqueProductsIds)) { 
                array_push($uniqueProductsIds , $productId) ;
             }
            }
            $color->products_count =  count ($uniqueProductsIds);
        }

        foreach ($sizes as $size) { 
            $productsIds = DB::table('variations')->where('size_id', $size->id)->pluck('product_id')->all();
            $uniqueProductsIds = array();
            foreach ( $productsIds as $productId) { 
             if(!in_array($productId , $uniqueProductsIds)) { 
                array_push($uniqueProductsIds , $productId) ;
             }
            }
            $size->products_count =  count ($uniqueProductsIds);
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
