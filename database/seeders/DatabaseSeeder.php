<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        // \App\Models\Category::factory(8)->create();
        // \App\Models\Color::factory(6)->create();
         //\App\Models\Size::factory(6)->create();
        //   \App\Models\Product::factory(6)->create();
        // \App\Models\Tag::factory(10)->create();
        // \App\Models\Tag::factory(10)->create();
        // \App\Models\Variation::factory(40)->create();
        //  $this->call([ProductTagSeeder::class]);
        //   $this->call([CategoryProductDemoSeeder::class]);
        //   $this->call([ProductPriceSeeder::class]);
          $this->call([ProductOptionsSeeder::class]);

        // $this->call([ProductOfferSeeder::class]);

    }
}
