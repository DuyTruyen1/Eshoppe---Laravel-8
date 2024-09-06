<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Blog extends Model
{
    use HasApiTokens,HasFactory,Notifiable;
    protected $table = 'blogs'; // Tên của bảng trong cơ sở dữ liệu

    protected $fillable = [
        'title',
        'image',
        'description',
        'content'
    ];

    public function getAllBlog(){
        return Blog::all();
    }

    public function addBlog($data){
        return Blog::create($data);
    }

    public function getBlogDetail($id){
        return Blog::find($id);
    }

    public function updateBlog($data,$id){
        $Blog = Blog::find($id);
        $Blog->update($data);
        return $Blog;
    }


    public function deleteBlog($id)
    {
        return Blog::destroy($id);
    }
}
