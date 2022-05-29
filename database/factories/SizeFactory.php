<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sizes = array(
            '36',
            '34',
            '38',
            '40',
            '42',
            '44',
        );

        return [

            'name' => $this->faker->unique()->randomElement($sizes),

        ];
    }
}
