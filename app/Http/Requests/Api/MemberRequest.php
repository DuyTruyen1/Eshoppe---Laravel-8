<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'name'=>'required|max:191',
            'password'=>'required',
            'email' => 'required|email|unique:users',
            'address'=>'required',
            'phone'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute Không được để trống',
            'max'=>':attribute Không được quá :max ký tự',
            'email.email' => ':attribute sai định dạng',
            'email.unique' => ':attribute da ton tai',
            'image' => ':attribute phai la hình ảnh',
            'mimes' => ':attribute phai dinh dang như sau:jpeg,png,jpg,gif',
            'image.max' => ':attribute Maximum file size to upload :max'
        ];
    }
}