<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

        $imageError = null;
        $colorsError = null;
        $sizesError = null;

        if (!$id) {
            $imageError = "required";
            $sizesError = "required";
            $colorsError = "required";
        } else {

            $imageError = "nullable";
            $sizesError = "nullable";
            $colorsError = "nullable";
        }

        return [
            "category_id" => ["required"],
            "sku" => ["required" ,"unique:products,sku," . $id],
            "colorsNamesString" => [$colorsError],
            "sizesNamesString" => [$sizesError],
            "selling_price" => ["required"],
            "name" => ["unique:products,name," . $id, "required", "string", "min:5", "max:100"],
            "arabic_name" => ["unique:products,arabic_name," . $id, "required", "string", "min:5", "max:100"],
            "image" => [$imageError, "image", "mimes:jpg,png,jpeg,gif,svg,webp" ],
            
        ];

    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required.',
            'colorsNamesString.requires' => 'The colors field is required.',
            'sizesNamesString.requires' => 'The sizes field is required.',
        ];
    }

}
