<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
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
            'clientNumber' => ['required', 'max:255', 'string', Rule::unique('clients', 'clientNumber')],
            'name' => ['required', 'max:255', 'string'],
            'contactEmail' => ['required', 'max:255', 'string'],
            'contactPhoneNumber' => ['required', 'max:255', 'string'],

        ];
    }
}
