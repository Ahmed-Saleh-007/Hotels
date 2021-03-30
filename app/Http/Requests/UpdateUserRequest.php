<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "email"                 => ["required", "email", "unique:users,id," . $this->user->id],
            'gender'                => 'required|in:male,female',
            'level'                 => 'required|in:manager,receptionist,client',
            'avatar_image'          => 'sometimes|nullable|image|mimes:jpeg,png',
            'national_id'           => 'sometimes|nullable|digits:14|unique:users,id,' . $this->user->id,
            'country'               => 'sometimes|nullable',
            'mobile'                => ["required", "regex:/(01)[0-9]{9}/", "unique:users,id,". $this->user->id],
            'password'              => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ];

        return $manager_rules;
    }
}
