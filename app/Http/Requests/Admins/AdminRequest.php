<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
        $emailError = null;

        if (!$id) {

            $passwordError = "required";
        } else {

            $passwordError = "nullable";
        }

        return [
            'password' => [$passwordError,
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],

            'email' => ["unique:users,email," . $id, 'required', 'min:5', 'email', 'max:50',

            ],

            'name' => ['required', 'min:5', 'max:50', 'string',
            ],

        ];
    }
}
