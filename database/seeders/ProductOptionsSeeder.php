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
        foreach ($products as $product) {
            $colorsIdsArray = Variation::where('product_id', $product->id)->pluck('color_id')->all();
            $sizesIdsArray = Variation::where('product_id', $product->id)->pluck('size_id')->all();
            $colorsNamesArray = Color::whereIn('id',  $colorsIdsArray )->pluck('name')->all();
            $sizesNamesArray = Size::whereIn('id',  $sizesIdsArray )->pluck('name')->all();
            $colorsString = join(",", $colorsNamesArray);
            $sizesString = join(",", $sizesNamesArray);
            $product->sizes = $sizesString;
            $product->colors = $colorsString;
            $product->save();
        
        }

    }
}
