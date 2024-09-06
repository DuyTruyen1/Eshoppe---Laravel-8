<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brand'; // Tên của bảng trong cơ sở dữ liệu

    protected $fillable = ['name']; // Các trường có thể được gán hàng loạt

    public function getAllBrand(){
        return Brand::all();
    }

    public function addBrand($data){
        return Brand::create($data);
    }

    public function getBrandDetail($id){
        return Brand::find($id);
    }

    public function updateBrand($data,$id){
        $Brand = Brand::find($id);
        $Brand->update($data);
        return $Brand;
    }


    public function deleteBrand($id)
    {
        return Brand::destroy($id);
    }

}
