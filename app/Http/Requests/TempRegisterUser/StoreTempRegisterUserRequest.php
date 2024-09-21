<?php

declare(strict_types=1);

namespace App\Http\Requests\TempRegisterUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreTempRegisterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50', 'alpha_num'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ];
    }
}
