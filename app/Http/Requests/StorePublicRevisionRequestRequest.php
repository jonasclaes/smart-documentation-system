<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicRevisionRequestRequest extends FormRequest
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
            'fileId' => ['required', 'integer', 'exists:files,id'],
            'name' => ['required', 'string', 'max:255'],
            'technicianFirstName' => ['required', 'string', 'max:255'],
            'technicianLastName' => ['required', 'string', 'max:255'],
            'technicianEmail' => ['required', 'string', 'max:255', 'email:rfc,dns'],
            'categoryId' => ['required', 'integer', 'exists:revision_request_categories,id'],
            'description' => ['nullable', 'string', 'max:65536']
        ];
    }
}
