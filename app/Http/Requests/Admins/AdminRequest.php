<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $passwordError = null;

        if (!$id) {

            $passwordError = "required";
        } else {

            $passwordError = "nullable";
        }

        return [

            'username' => ['required', 'string', 'max:255'],

            'password' => [$passwordError, 'string', 'min:8',

            ],

            'email' => ["unique:users,email," . $id, 'required', 'string', 'email', 'max:255',

            ],

        ];
    }
}
