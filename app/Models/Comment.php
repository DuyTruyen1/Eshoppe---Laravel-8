<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment'; 
    protected $fillable = ['cmt','id_user', 'id_blog','avatar_user','name_user','level'];

    public function replies()
    {
        return $this->hasMany(Comment::class, 'id_user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
}
