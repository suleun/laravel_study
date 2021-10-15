<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    // 로그인된 사용자의 좋아요/좋아요 취소 요청 처리
    public function store(Post $post){

        // 있으면 없애주고 없으면 있게 해주는게 토글
       return $post->likes()->toggle(auth()->user());

       
    }
}
