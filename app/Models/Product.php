<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product'; 

    protected $fillable = [
        'id',
        'id_user',
        'name',
        'price',
        'id_category',
        'id_brand',
        'status',
        'sale',
        'company',
        'hinhanh',
        'detail',
    ];
    

   
}
