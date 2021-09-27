<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            1. 게시글 리스트를 DB에서 읽어와야지
            2. 게시글 목록 만들어주는 blade 에 읽어온 데이터를 전달하고
               실행. 
        */
    

        $posts = Post::latest()->paginate(10);


        return view('bbs.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bbs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title'=>'required', 
                        'content'=>'required|min:3']);
        
        $fileName = null;
        if($request->hasFile('image')) {
            // dd($request->file('image'));
            $fileName = time().'_'.
                $request->file('image')->getClientOriginalName();
            $path = $request->file('image')  
                ->storeAs('public/images', $fileName);
            // dd($path);
        }                       
        //
        // dd($request->all());
        $input = array_merge($request->all(), 
                ["user_id"=>Auth::user()->id]);
        // 이미지가 있으면.. $input에 image 항목 추가
        if($fileName) {

            $input = array_merge($input, ['image' => $fileName]);
            // dd($input);
        }
       
        // dd($input);
        /*
            $input의 내용은 
                ["title"=>"dasjfl", "content=>"cdajl", "user_id"=>1]

        */

        // mass assignment 
        // Eloquent model의 white list 인 $fillable에 기술해야 한다.
        Post::create($input);

        // $post = new Post;
        // $post->title = $input['title'];
        // $post->content = $input['content'];

        // ... 

        // $post->save();
        
        // return view('bbs.index', ['posts'=>Post::all()]);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // id에 해당하는 Post를 데이터베이스에서 인출
        $post = Post::find($id);


        // 상세보기 뷰로 전달
        return view('bbs.show', ['post'=>$post]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$id에 해당하는 포스트를 수정 할 수 있는 페이지 반환
       

        return view('bbs.edit',['post'=> Post::find($id)] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['title'=>'required', 
        'content'=>'required|min:3']);

        $post = Post::find($id);
 
        // 내용 바꾸기
        $post->title = $request->title;
        $post->content = $request->content;

        // 사진 내용 바꾸기
        // $request 객체 안에 이미지가 있으면
        // 이 이미지를 이 게시글의 이미지로 변경
        if($request->image){

            // 기존 이미지가 있다면 기존이미지를 파일 시스템에서 삭제
            if($post->image){
                Storage::delete('public/images/'.$post->image);
            }
            // 이 이미지를 이 게시글의 이미지로 파일 시스템에 저장, DB반영
        
            $fileName = time().'_'.
            $request->file('image')->getClientOriginalName();

            $post->image = $fileName;

            $request->image->storeAS('public/images/'.$fileName);

        }

        $post->save();

        return redirect()->route('posts.show', ['post'=>$post->$id]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // DI(라우터 파라미터 앞에 와야 함), Dependency Injection, 의존성 주입
        
        $post = Post::find($id)->delete();
       // 게시글에 딸린 이미지가 있으면 파일시스템에서도 삭제 해줘야한다
       
       if($post->image){
           Storage::delete('public/images/'.$post->image);

       } else {
           $post->delete();
       }

       return redirect()->route('posts.index');

    }

    public function deleteImages($id){

        $post = Post::find($id);
        
        Storage::delete('public/images', $post->image);
    
    

    }
}
