<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{

    protected $guarded = [];

    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class)->select('id' , 'name' );
    }

    public function color()
    {
        return $this->belongsTo(Color::class)->select('id' , 'name' );
    }

    public function images()
    {
        return $this->hasMany(VariationImage::class, 'variation_id', 'id');
    }

}
