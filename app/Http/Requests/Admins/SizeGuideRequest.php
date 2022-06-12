<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Admins\UniqueSizeGuideRule;

class SizeGuideRequest extends FormRequest
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
        $productId = app("request")->get("product_id");
        $sideId = app("request")->get("size_id");

        return [
            'size_name' => [  'required' , new UniqueSizeGuideRule($id , $productId ,  $sideId) ],
            'shoulder' => [  'required'],
            'bust' => [  'required'],
            'wist' => [  'required'],
            'hip' => [  'required'],

        ];
    }
}
