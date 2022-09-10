<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    
    protected $fillable = [
        'content', 'user_id', 'post_id'
    ];

    // method to return which post the comment belongs
    public function user(){
        return $this->belongsTo(User::class);
    }

    // method to return which user the comment belongs
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
