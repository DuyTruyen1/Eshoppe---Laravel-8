<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $table = 'rate'; 

    protected $fillable = ['rate','user_id', 'blog_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function getAllRate(){
        return Rate::all();
    }

    public function addRate($data){
        return Rate::create($data);
    }

    public function getRateDetail($id){
        return Rate::find($id);
    }

    public function updateRate($data,$id){
        $Rate = Rate::find($id);
        $Rate->update($data);
        return $Rate;
    }


    public function deleteRate($id)
    {
        return Rate::destroy($id);
    }
}
