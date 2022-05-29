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
        $nameError = null;
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

            "tagsNamesArray" => ["required"],
            "sku" => ["required"],
            "colorsNamesArray" => [$colorsError],
            "sizesNamesArray" => [$sizesError],
            "selling_price" => ["required"],
            "category_id" => ["required"],

            "name" => ["unique:products,name," . $id, "required", "string", "min:5", "max:50"],
            "short_description" => ["required", "string", "min:10", "max:300"],
            "long_description" => ["required", "string", "min:50", "max:1000"],
            "image" => [$imageError, "image", "mimes:jpg,png,jpeg,gif,svg,webp"],
        ];

    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required.',
            'tagsNamesArray.requires' => 'The tags field is required.',
            'colorsNamesArray.requires' => 'The colors field is required.',
            'sizesNamesArray.requires' => 'The sizes field is required.',
        ];
    }

}
