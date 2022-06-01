<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class VariationImageRequest extends FormRequest
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
        if (!$id) {
            $imageError = "required";

        }
        else  {
            $imageError = "nullable";
        }
        return [
            'image' => [   $imageError , 'image', "mimes:jpg,png,jpeg,gif,svg,webp" , 'max:1000'],
        ];
    }
}
