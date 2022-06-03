<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Variation;

class VariationFactory extends Factory
{

          /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Variation::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'color_id' => $this->faker->numberBetween(1, 7),
            'size_id' => $this->faker->numberBetween(1, 6),
            'product_id' => $this->faker->numberBetween(1, 15),
            'sku' => Str::random(12),
            'selling_price' => $this->faker->numberBetween(500, 1000),
            'discount_price' => $this->faker->numberBetween(50, 200),
            'image' => '/images/products/variations/variation.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
