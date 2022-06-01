<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return arrayp
     */
    public function definition()
    {

        $name = $this->faker->unique()->name() ;
        $discount_price = $this->faker->numberBetween(50, 200) ;
        $selling_price = $this->faker->numberBetween(500, 1000) ;
        return [
            'name' =>  $name,
            'slug' => str_replace(" " , "-" , $name)  ,
            'category_id' => $this->faker->numberBetween(1,7),
            'sku' => Str::random(12),
            'short_description' =>  $this->faker->text(80),
            'long_description' =>  $this->faker->text(500),
            'selling_price' => $selling_price,
             'discount_price' => $discount_price,
             'price' =>  $discount_price,
             'offer' =>   (($selling_price - $discount_price) * 100) / $selling_price  ,
             'colors'=> 'red,blue',
             'sizes'=> '40,42',
            'status' => 0,
            'featured' => 0,
            'trend' => 0,
            'stock_qty' => 0,
            'stock_ordered' => 0,
            'image' => '/images/products/product.jpg',
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
