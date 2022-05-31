<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $smallImageError = null;


        if (!$id) {

            $bigImageError = "required";
            $smallImageError = "required";

        } else {

            $bigImageError = "nullable";
            $smallImageError = "nullable";

        }

        return [
            "title" => ["required", "min:5", "string", "max:50"],
            "link" => ["required"],
            "big_image" => [$bigImageError, "image", "mimes:jpg,png,jpeg,gif,svg,webp" , 'max:1000'],
            "small_image" => [$smallImageError, "image", "mimes:jpg,png,jpeg,gif,svg,webp" , 'max:1000'],

        ];

    }
}
