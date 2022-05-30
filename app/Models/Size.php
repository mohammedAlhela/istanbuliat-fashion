<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [ 'id', 'name'];

    public $timestamps = false;

    public function variations()
    {
        return $this->hasMany(Variation::class , 'size_id'  , 'id');
    }

    public function sizeGuides()
    {
        return $this->hasMany(SizeGuide::class , 'size_id'  , 'id');
    }
}
