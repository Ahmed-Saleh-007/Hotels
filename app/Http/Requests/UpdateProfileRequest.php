<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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

        $rules = [
            'name'                  => 'required',
            "email"                 => ["required", "email", "unique:users,id," . auth()->id()],
            'gender'                => 'required|in:male,female',
            'avatar_image'          => 'sometimes|nullable|image|mimes:jpeg,png',
            'national_id'           => 'sometimes|nullable|digits:14|unique:users,id,' . auth()->id(),
            'country'               => 'sometimes|nullable',
            'mobile'                => ["required", "regex:/(01)[0-9]{9}/", "unique:users,id,". auth()->id()],
            'password'              => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ];

        return $rules;
    }
}
