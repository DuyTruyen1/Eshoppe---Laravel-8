<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
        $user = Auth::user();

        return [
            'id' => 'required',
            'name' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id', // Thêm quy tắc cho id_user
            'price' => 'required|numeric',
            'id_category' => 'required|exists:category,id',
            'id_brand' => 'required|exists:brand,id',
            'status' => 'required|boolean',
            'sale' => 'required|boolean',
            // 'sale_price' => 'nullable|numeric',
            'company' => 'required|string|max:255',
            'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm quy tắc kiểm tra cho ảnh
            'detail' => 'required|string',
        ];
    }
}
