<?php

namespace App\Rules\Admins;

use DB;

use Illuminate\Contracts\Validation\Rule;


class UniqueVariationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */


     public $sizeId ;
     public $productId ;
     
    public function __construct($sizeId , $productId)
    {
       $this->sizeId = $sizeId;
       $this->productId = $productId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      

        return   !DB::table('variations')->where('product_id'  , $this->productId)->where('color_id', $value)->where('size_id' , $this->sizeId)->first();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'you cant add 2 variations with the same color and size';
    }
}
