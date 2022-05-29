<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $products = Product::all();

            foreach ($products  as $product) {

            $product->offer = $product->discount_price ? ( ($product->selling_price - $product->discount_price) * 100 ) / $product->selling_price : null ;
            $product->save();
            }

    }
}
