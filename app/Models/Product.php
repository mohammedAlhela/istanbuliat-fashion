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
        return $this->belongsTo(Category::class);
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'product_id', 'id')->with(['color', 'size' ,  'product' , 'images']);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');

    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'variations', 'product_id', 'color_id');

    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'variations', 'product_id', 'size_id');

    }

    public function wishlist()
    {
        return $this->belongsToMany(User::class, 'wishlist', 'product_id', 'user_id');
    }

}
