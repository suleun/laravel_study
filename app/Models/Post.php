<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; //trait이라고 한단다

    protected $fillable = [
        "title",
        "content",

    ];
    
    public function user(){
        // User와 Post의 관계 : 1:n
        // User은 hasMany posts
        // Post는 belongs to a User
        return $this->belongsTo(User::class, "user_id");
    }

}
