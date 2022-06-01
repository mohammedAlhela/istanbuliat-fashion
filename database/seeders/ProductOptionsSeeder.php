<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variation;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $products = Product::all();
                foreach($products as $product) { 
                // $product->image = '/images/products/product.jpg';
                // $product->wash_care = 'Cold water wash';
                // $product->contents = '60% cottons,40% ligra';
                //  $product->status = 1;
                $product->save();
            }
    }
}
