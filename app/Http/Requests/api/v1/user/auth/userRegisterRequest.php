<?php

namespace App\Http\Requests\api\v1\user\auth;

use Illuminate\Foundation\Http\FormRequest;

class userRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'family' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];
    }
}
