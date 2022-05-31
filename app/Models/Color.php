<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'products',
    ];

    protected $fillable = ['id', 'name', 'hex'];
    public $timestamps = false;

    public function variations()
    {
        return $this->hasMany(Variation::class, 'color_id', 'id');
    }

    public function getProductsAttribute()
    {

        $productsIds = DB::table('variations')->where('color_id', $this->id)->pluck('product_id')->all();
        $uniqueProductsIds = array();
        foreach ($productsIds as $productId) {
            if (!in_array($productId, $uniqueProductsIds)) {
                array_push($uniqueProductsIds, $productId);
            }
        }
        return DB::table('products')->whereIn('id', $uniqueProductsIds)->get();

    }

}
