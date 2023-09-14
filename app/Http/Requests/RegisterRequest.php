<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|unique:a_users',
            'first_name' => 'required',
            'intitution' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
