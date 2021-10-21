<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // 방법1
    // http://localhost:8000/post/{id}/comments
    
    /* 
    
    public function index_test(Post $post){
        // post클래스에 comments함수 구현 한 경우
        return $post->comments;
        // 내부적으로
        // select * 
        // from comments
        // where post_id = $post->id
    }

    */

    // 방법2
    // index
    public function index($postId){ // 댓글 리스트를 가져오는 함수
        

        $comments = Comment::where('post_id', $postId)->latest();
        // SQL문 실행이 내부적으로 : select * form comments where post_id = ?
        // order by created_at desc;

        return $comments;

    }

    // update
    public function update(){
        
    }

    // destroy
    public function destroy(){
        
    }

    // store
    public function store(){
        
    }
}
