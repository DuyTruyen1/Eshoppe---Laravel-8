<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category'; // Tên của bảng trong cơ sở dữ liệu

    protected $fillable = ['name']; // Các trường có thể được gán hàng loạt

    public function getAllCategory(){
        return Category::all();
    }

    public function addCategory($data){
        return Category::create($data);
    }

    public function getCategoryDetail($id){
        return Category::find($id);
    }

    public function updateCategory($data,$id){
        $Category = Category::find($id);
        $Category->update($data);
        return $Category;
    }


    public function deleteCategory($id)
    {
        return Category::destroy($id);
    }
}
