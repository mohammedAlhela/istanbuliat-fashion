<?php

namespace Database\Seeders;

use App\Models\Product;
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
        foreach ($products as $product) {
            $product->wash_care = '';
            $product->save();
        }


    }
}
