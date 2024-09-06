<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // nhớ phải thay đổi thành true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'password' => 'nullable',
            'avatar' => 'nullable|image|max:2048', 
        ];
    }

    public function messages()
    {
        return [
            'avatar.max' => 'Kích thước của ảnh avatar không được vượt quá 2MB.',
        ];
    }
}
