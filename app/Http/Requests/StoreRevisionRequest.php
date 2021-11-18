<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRevisionRequest extends FormRequest
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
            'revisionNumber' => [
                'required',
                'max:255',
                'string',
                Rule::unique('revisions', 'revisionNumber')
                    ->where(function ($query) {
                        return $query->where('fileId', $this->fileId);
                    })->ignore($this->revision)
            ],
            'fileId' => ['required', 'numeric', 'exists:files,id']
        ];
    }
}
