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
            'fileId' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'enclosureId' => ['max:255'],
            'uniqueId' => ['required', 'max:255', Rule::unique('files', 'uniqueId')],
            'clientId' => ['required']
        ];
    }
}
