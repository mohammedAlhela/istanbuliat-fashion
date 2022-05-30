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
                $product->status = 1;
                $product->save();
            }
    }
}
