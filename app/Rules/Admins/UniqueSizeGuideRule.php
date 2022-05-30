<?php

namespace App\Rules\Admins;

use DB;

use Illuminate\Contracts\Validation\Rule;


class UniqueSizeGuideRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */


     public $sizeId ;
     public $productId ;
     public $id ;

     
    public function __construct(  $id , $productId  , $sizeId )
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

            return   !DB::table('size_guides')->where('id' , '!=' , $this->id)->where('product_id'  , $this->productId)->where('size_id' , $this->sizeId)->first();
        }

        else { 
            return   !DB::table('size_guides')->where('product_id'  , $this->productId)->where('size_id' , $this->sizeId)->first();

        }
      

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'size guide already exist';
    }
}
