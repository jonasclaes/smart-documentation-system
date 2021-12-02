<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFileRequest extends FormRequest
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
            'fileId' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'enclosureId' => ['nullable', 'max:255', 'string'],
            'uniqueId' => ['required', 'max:255', 'string', Rule::unique('files', 'uniqueId')],
            'clientId' => ['required', 'integer', 'exists:clients,id']
        ];
    }
}
