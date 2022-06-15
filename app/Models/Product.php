<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class)->select('id', 'name');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class)->select('id', 'name' , 'category_id');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'product_id', 'id')->with(['color', 'size' , 'product']);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');

    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'variations', 'product_id', 'color_id')->select(array('colors.id', 'name', 'product_id'))->with('images');

    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'variations', 'product_id', 'size_id')->select(array('sizes.id', 'name', 'product_id'));

    }

    public function sizeGuides()
    {
        return $this->hasMany(SizeGuide::class, 'product_id', 'id')->with('size');
    }

    
    public function images()
    {
        return $this->hasMany(ProductColorImage::class, 'product_id', 'id');
    }


}
