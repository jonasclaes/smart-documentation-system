<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends StoreUserRequest
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
        $rules = parent::rules();

        $rules['username'] = ['required', 'max:255', 'string', Rule::unique('users', 'username')->ignore($this->user)];
        $rules['email'] = ['required', 'max:255', 'email', Rule::unique('users', 'email')->ignore($this->user)];
        unset($rules['password']);

        return $rules;
    }
}
