<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tag;

class TagFactory extends Factory
{
           /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    public function definition()
    {
        return [
             'name' => $this->faker->unique()->randomElement(['sport', 'uniform' , 'dark' , 'light' , 'summer' , 'winter' , 'autumn' , 'spring' , 'long pants' , 'short pants'])  ,
        ];
    }
}
