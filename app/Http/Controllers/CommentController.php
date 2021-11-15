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
        

        $comments = Comment::where('post_id', $postId)->with('user')->latest()->paginate(4);
        // SQL문 실행이 내부적으로 : select * form comments where post_id = ?
        // order by created_at desc;

        return $comments;

    }

     // store, 댓글 등록 메소드
      public function store(Request $request, $postId){
        // 1. Comment 객체를 생성하고, 이 객체의 멤버변수(프로퍼티)를 설정하고 save();
        // 2. Comment::create([]);
    
        // 정당성 검사(validation check)
        $request->validate(['comment' => ['required']]);
 
        $comment = Comment::create([
            'comment'=> $request->input('comment'),
            // 로그인한 사용자으의 아이디, Auth이용
            'user_id'=> auth()->user()->id,
            'post_id'=> $postId ,
    ]);
    
    return $comment ;
    // 위 create에 의해 삽입된 레코드에 대응된 

    }

    // destroy
    public function destroy($commentId){
  
    //   comments 테이블에서 id가 $commentId인 레코드를 삭제
    //  1. RAW query
    //  2. DB Query Builder
    //  3. Eloquent
  
        
    // select from comments where id = ?
    $comment = Comment::find($commentId);

    // CommentPolicy를 적용한 권한관리를 하자
    // 즉 이요청을 한 사용자가 이 댓글을 삭제할 수 있는지 체크

    $this->authorize('delete', $comment);

   // delete from comments where id = ?
    $comment->delete();
        return $comment;
    }
    
    public function update(Request $request, $commentId){
        
        // 정당성 검사(validation check)
        $request->validate(['comment' => ['required']]);

        // update할 레코드를 먼저 찾고, 그 다음 update

        $comment = Comment::find($commentId);

        $this->authorize('update', $comment);
        // update set comment=? from xcomments where
        // id = ?
        // 첫 번쨰 ? : $request->input('comment)
        // 두 번째 ? : $comment->id

        
        $comment->update([
            'comment'=> $request->input('comment'),
          
    ]);

        return $comment;

    }


  
}
