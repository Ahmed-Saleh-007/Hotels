<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $register_rules = [
            'name'         => ['required', 'string', 'max:255'],
            'avatar_image' => ['required', 'image', 'mimes:jpeg,jpg'],
            'country'      => ['required'],
            'gender'       => ['required', 'in:male,female'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ];

        return $register_rules;
    }
}
