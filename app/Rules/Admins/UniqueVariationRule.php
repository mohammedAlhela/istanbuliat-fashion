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
     public $id ;

     
    public function __construct($sizeId , $productId , $id)
    {
       $this->sizeId = $sizeId;
       $this->productId = $productId;
       $this->id = $id;
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

        
        if($this->id ) { 

            return   !DB::table('variations')->where('id' , '!=' , $this->id)->where('product_id'  , $this->productId)->where('color_id', $value)->where('size_id' , $this->sizeId)->first();
        }

        else { 
            return   !DB::table('variations')->where('product_id'  , $this->productId)->where('color_id', $value)->where('size_id' , $this->sizeId)->first();

        }
      

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
