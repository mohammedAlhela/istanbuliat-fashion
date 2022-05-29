<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use DB;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function getRandomTagsIdsArray()
    {
        $arrayData = array();
        $tagsIds = Tag::pluck('id')->all();
        $randomKeys = array_rand( $tagsIds , 3);
        foreach ($randomKeys as $randomKey) {
            array_push($arrayData, $tagsIds[$randomKey]);
        }
        return $arrayData;
    }
    public function run()
    {
        $productsIds = Product::pluck('id')->all();
        foreach ($productsIds as $productId) {
            foreach ($this->getRandomTagsIdsArray() as $tagId) {
                DB::table('product_tag')->insert([
                    'product_id' => $productId,
                    'tag_id' => $tagId,
                ]);
            }
        }
    }
}
