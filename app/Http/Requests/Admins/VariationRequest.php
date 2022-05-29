<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Admins\UniqueVariationRule;


class VariationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {



        $id = app("request")->get("id");

        $sizeId = app("request")->get("size_id");
        $productId = app("request")->get("product_id");
        
        $imageError = null;
        if (!$id) {
            $imageError = "required";

        }
        else  {
            $imageError = "nullable";

        }

        return [
            'size_id' => ['required'],
            'color_id' => ['required' , 
            // new UniqueVariationRule($sizeId ,
            
            // $productId)
        
        ],
            'image' => [   $imageError , 'image', "mimes:jpg,png,jpeg,gif,svg,webp"],
        ];
    }

    public function messages()
    {
        return [
            'size_id.required' => 'The size field is required.',
            'color_id.required' => 'The color field is required.',
        ];
    }

}
