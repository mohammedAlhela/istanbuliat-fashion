<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    
    protected $guarded = [];

        public function products()
        {
            return $this->belongsToMany(Product::class, 'variations', 'size_id', 'product_id')->select(array('name' , 'size_id'));
    
        }
}
