<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'name' => 'required|min:4|string|max:225',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->user->id),
                'email',
            ],
            'password' => 'nullable|min:8',
            'role' => 'required',
        ];
    }
}
