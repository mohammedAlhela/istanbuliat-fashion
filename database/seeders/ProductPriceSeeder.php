<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductPriceSeeder extends Seeder
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

            $product->price = $product->discount_price ?  $product->discount_price : $product->selling_price ;
            $product->save();
            }

    }
}
