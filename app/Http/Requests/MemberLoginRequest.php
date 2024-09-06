<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MemberLoginRequest extends FormRequest

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = Auth::id();
        return [
            'email' => 'required|email',
            'password' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email bắt buộc phải nhập',
        ];
    }
}
