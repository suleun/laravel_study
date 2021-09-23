<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // select * from posts order by created_at desc
        // $posts = Post::orderBy('created_at', 'desc')->get();

        // $posts = Post::latest()->get();
        // $posts = Post::oldest()->get();

        $posts = Post::latest()->paginate(10);

        // dd($posts);
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
         /*
            $request->all() : ['title'=>'dfakl', 'content'=>'cdkd']
            ["user_id"=>Auth::user()->id] => ['user_id'=>1]
        arrary_merge(['title'=>'dfakl', 'content'=>'cdkd'], 
                            ['user_id'=>1])

         */
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
