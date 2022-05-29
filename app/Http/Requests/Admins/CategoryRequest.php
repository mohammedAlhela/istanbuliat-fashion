<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

        $bigImageError = null;
        $nameError = null ;

        if (!$id) {

            $bigImageError = "required";
        } else {

            $bigImageError = "nullable";
        }

        return [
            "name" => [ "unique:categories,name," .$id, "required", "min:3", "string", "max:50"],

            "big_image" => [ $bigImageError , "image", "mimes:jpg,png,jpeg,gif,svg,webp"],
        ];

    }
}
