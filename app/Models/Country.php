<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Country extends Model
{
    use HasApiTokens,HasFactory,Notifiable;
    protected $table = 'country'; // Tên của bảng trong cơ sở dữ liệu


    protected $fillable = ['name']; // Các trường có thể được gán hàng loạt

    public function getAllCountry(){
        return Country::all();
    }

    public function addCountry($data){
        return Country::create($data);
    }

    public function getCountryDetail($id){
        return Country::find($id);
    }

    public function updateCountry($data,$id){
        $Country = Country::find($id);
        $Country->update($data);
        return $Country;
    }


    public function deleteCountry($id)
    {
        return Country::destroy($id);
    }
}
