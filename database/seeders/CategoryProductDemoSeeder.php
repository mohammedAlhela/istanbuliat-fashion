<?php

namespace Database\Seeders;

use App\Models\Product;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryProductDemoSeeder extends Seeder
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

            $product->category_id = Category::where('name'  , 'dresses')->first()->id;
            $product->save();
        }
    }
}
