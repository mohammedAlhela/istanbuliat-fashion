<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class ProductColorImageRequest extends FormRequest
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

        $imageErrors =[];
 
        if (!$id) {
            
        } else {
            [  'required' ,'image', "mimes:jpg,png,jpeg,gif,svg,webp" ];
        }



        return [
            'image' =>   $imageErrors
        ];
    }
}
