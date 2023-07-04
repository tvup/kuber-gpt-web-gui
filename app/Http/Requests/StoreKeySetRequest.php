<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeySetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<string>>
     */
    public function rules(): array
    {

        return [
            'name' => ['nullable', 'string', 'max:255'],
            'key' => ['nullable', 'unique:credential_sets', 'string', 'max:255'],
            'value' => ['nullable', 'string', 'max:255'],
        ];
    }
}
