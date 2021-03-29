<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManagerRequest extends FormRequest
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

        $manager_rules = [
            'name'                  => 'required',
            'mobile'                => 'required|numeric|regex:/(01)[0-9]{9}/|unique:users',
            'gender'                => 'required|in:male,female',
            // 'level'                 => 'required|in:manager',
            'avatar_image'          => 'sometimes|nullable|image|mimes:jpeg,png',
            'national_id'           => 'sometimes|nullable|digits:14|unique:users',
            'country'               => 'sometimes|nullable',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ];

        

        return $manager_rules;
    }
}
