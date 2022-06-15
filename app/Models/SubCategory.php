<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    
    
    
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class)->select( 'id' ,  'name' );
    }

    public function products()
    {
        return $this->hasMany(Product::class , 'sub_category_id'  , 'id')->select('name' , 'sub_category_id');
    }

}
