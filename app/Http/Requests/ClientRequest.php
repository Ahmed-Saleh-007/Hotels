<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $client_rules = [
            'name'                  => 'required',
            'mobile'                => 'required|numeric|regex:/(01)[0-9]{9}/|unique:users',
            'gender'                => 'required|in:male,female',
            // 'level'                 => 'required|in:manager',
            'avatar_image'          => 'sometimes|nullable|image|mimes:jpeg,png',
            'national_id'           => 'sometimes|nullable|digits:14',
            'country'               => 'sometimes|nullable',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ];

        if ($this->getMethod() == 'POST') {

            $client_rules += ['email'    => ["required", "email", "unique:users"] ];

        }else {

            $client_rules += ["email"    => ["required", "email", "unique:users,id," . $this->user->id] ];

        }

        return $client_rules;
    }
}
