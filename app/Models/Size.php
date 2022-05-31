<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [ 'id', 'name'];

    protected $appends = [
        'products',
    ];


    public $timestamps = false;

    public function variations()
    {
        return $this->hasMany(Variation::class , 'size_id'  , 'id');
    }

    public function sizeGuides()
    {
        return $this->hasMany(SizeGuide::class , 'size_id'  , 'id');
    }

    public function getProductsAttribute()
    {

        $productsIds = DB::table('variations')->where('size_id', $this->id)->pluck('product_id')->all();
        $uniqueProductsIds = array();
        foreach ($productsIds as $productId) {
            if (!in_array($productId, $uniqueProductsIds)) {
                array_push($uniqueProductsIds, $productId);
            }
        }
        return DB::table('products')->whereIn('id', $uniqueProductsIds)->get();

    }
}
