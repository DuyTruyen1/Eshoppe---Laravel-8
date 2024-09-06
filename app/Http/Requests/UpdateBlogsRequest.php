<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogsRequest extends FormRequest
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
        return [
            'title' =>'required',
            'image' => 'nullable|image|max:2048', 
            'description' =>'required',
            'content' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Bạn Phải Nhập Tiêu Đề.',
            'image.max' => 'Kích thước của ảnh không được vượt quá 2MB.',
            'description.required' => 'Bạn Phải Nhập Tiêu Đề.',
            'content.required' => 'Bạn Phải Nhập Tiêu Đề.',
        ];
    }
}
