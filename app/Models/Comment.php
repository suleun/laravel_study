<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    // User - Comment (1:N) 관계
    protected $fillable = ['comment', 'user_id','post_id'];

    // 유저 이름을 알아내기 위해 밑의 함수 작성

    public function user(){
        // comment 입장에서 연결된 user를 찾을 때
        // belongsTo : ~에게 소속 되다
        // belongsTo 관계 메소드를 통해서 연결   

        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'user_id', 'id', 'users');


        // 네이밍 컨벤션에 인해 아래 주석 코드가 자동으로 정해 짐
        // SELECT *
        // FORM USERS
        // WHERE id = $this.user_id

  

    }

}
