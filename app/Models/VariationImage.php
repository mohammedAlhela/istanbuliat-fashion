<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationImage extends Model
{
    use HasFactory;

    protected $table = 'variation_images';

    
    protected $guarded = [];

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

}
