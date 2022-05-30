<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $namesArray = array(
            'kimono',
            'coats',
            'tops',
            'dresses',
            'abayas',
            'trend',

        );

        return [
            'name' => $this->faker->unique()->randomElement($namesArray),
            'description' => $this->faker->unique()->text(),
            'image' => '/images/categories/category.jpg',
        ];
    }
}
