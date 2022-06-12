<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function getRandomProductsIdsArray()
    {

        $arrayData = array();

        $productsIds = Product::pluck('id')->all();

        $randomKeys = array_rand($productsIds, 4);

        foreach ($randomKeys as $randomKey) {
            array_push($arrayData, $productsIds[$randomKey]);
        }

        return $arrayData;

    }

    public function run()
    {

        // $usersIds = User::where('role', 0)->pluck('id')->all();

        // foreach ($usersIds as $userId) {

            $productsIds = [1,2,3,4,5,6,7,8,9];

            foreach (  $productsIds as $productId) {

                $wishlist = new Wishlist;
                $wishlist->user_id = 1;
                $wishlist->product_id = $productId;
                $wishlist->save();

            }
        // }

    }

}
