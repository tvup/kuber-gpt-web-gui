<?php

namespace App\Http\Requests;

use App\Rules\NoMoreThanSubscriptionAllows;
use Illuminate\Foundation\Http\FormRequest;

class StoreRunSetRequest extends FormRequest
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
            'nick_name' => ['nullable', 'string', 'max:53', new NoMoreThanSubscriptionAllows],
            'local_ip' => ['nullable', 'ipv4'],
            'public_ip' => ['nullable', 'ipv4'],
            'applications' => ['nullable', 'array'],
            'applications.*.name' => ['required', 'string', 'max:250'],
            'applications.*.url' => ['required', 'url', 'max:250'],
            'tags' => ['nullable', 'array'],
            'credentials_set' => ['sometimes', 'integer'],
        ];
    }
}
