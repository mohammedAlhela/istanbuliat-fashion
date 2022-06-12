<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = ['id', 'name'];

public $timestamps = false;

    public function variations()
    {
        return $this->hasMany(Variation::class, 'size_id', 'id');
    }

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'variations', 'size_id', 'product_id')->select(array('name' , 'size_id'))->whereRaw('products.status = 1');

    }

    public function sizeGuides()
    {
        return $this->hasMany(SizeGuide::class , 'size_id'  , 'id');
    }

}
