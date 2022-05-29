<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $colors = array(
            'red',
            'pink',
            'green',
            'black',
            'gray',
            'blue',
        );

        return [
            'name' => $this->faker->unique()->randomElement($colors),
            'hex'=> $this->faker->unique()->hexcolor()
        ];
    }
}
