<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServerAssetRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nick_name' => ['nullable', 'string', 'max:255'],
            'local_ip' => ['nullable', 'ipv4'],
            'public_ip' => ['nullable', 'ipv4'],
            'applications' => ['nullable', 'string', 'max:4000'],
            'tags' => ['nullable', 'string', 'max:4000'],
        ];
    }
}
