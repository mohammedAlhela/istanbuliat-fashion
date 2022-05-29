<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = [ 'id', 'name' , 'hex'];
    public $timestamps = false;

    public function variations()
    {
        return $this->hasMany(Variation::class , 'color_id'  , 'id');
    }
}
