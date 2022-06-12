<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = ['id', 'name', 'hex'];

    public $timestamps = false;

    public function variations()
    {
        return $this->hasMany(Variation::class, 'color_id', 'id');
    }

    
    public function products()
    {
         return $this->belongsToMany(Product::class, 'variations', 'color_id', 'product_id')->select(array('name' , 'color_id'))->whereRaw('products.status = 1');

        

       

    }

}
