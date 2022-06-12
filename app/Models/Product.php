<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class)->select( 'id' ,  'name' );
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'product_id', 'id')->with(['color', 'size' , 'images'])->select('id' , 'product_id' , 'color_id' , 'size_id' , 'sku' , 'selling_price' , 'discount_price' , 'stock_qty' , 'status' , 'image'  );
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');

    }

    
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'variations', 'product_id', 'color_id')->select(array( 'colors.id' ,  'name' , 'product_id'));

    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'variations', 'product_id', 'size_id')->select(array( 'sizes.id' ,  'name' , 'product_id'));

    }


    public function sizeGuides()
    {
        return $this->hasMany(SizeGuide::class, 'product_id', 'id')->with('size');
    }


    public function wishlists()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'product_id', 'user_id');
    }



}
