<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientContactRequest extends FormRequest
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
            'clientId' => ['required', 'integer', 'exists:clients,id'],
            'firstName' => ['required', 'max:255', 'string'],
            'lastName' => ['required', 'max:255', 'string'],
            'role' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'max:255', 'string'],
            'phoneNumber' => ['nullable', 'max:255', 'string'],
        ];
    }
}
