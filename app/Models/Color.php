<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'variations', 'color_id', 'product_id')->select(array('name', 'color_id'));

    }

    public function images()
    {
        return $this->hasMany(ProductColorImage::class, 'color_id', 'id');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'color_id', 'id');
    }


}
