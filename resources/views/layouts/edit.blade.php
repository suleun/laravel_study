<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('수정 폼') }}
            </h2>
            <button onclick=location.href="{{ route('posts.show', ['post'=>$post->id]) }}" type="button" class="btn btn-info hover:bg-blue-700 font-bold text-white">
                상세보기
            </button>
        </div>
    </x-slot>
    <div class="m-4 p-4">
        <form class="row g-3" action="{{ route('posts.update', ['post'=>$post->id]) }}"
                    method="post" 
                    enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="col-12 m-2">
                <label for="title" class="form-label">제목</label>
                <input type="text" name="title" class="form-control" id="title" 
                            placeholder="제목 입력"
                            value="{{ old('title') }}">
                @error('title')    
                <div class="text-red-800">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="col-12 m-2">
                <label for="content" class="form-label">글 내용</label>
                <textarea class="form-control" 
                name="content" 
                id="content">{{$post->content}}</textarea>
                @error('content')    
                <div class="text-red-800">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
        
            <div class="col-12 m-2">
                @if ($post->image)
                <img
                    src="{{ '/storage/images/'.$post->image }}"
                    class="card-img-top"
                    class="w-20 h-20 rounded-full"
                    alt="post image">
                    @else
                    <span>없음</span>
                    @endif

                <label for="image" class="form-label">첨부 이미지</label>
                <input type="file" name="image" class="form-control" 
                            id="image" value="{{ old('image') }}">
            </div>    
            <div class="col-12 m-2">
            <button type="submit" class="btn btn-primary">글수정</button>
            </div>
        </form>
    </div>
  </x-app-layout>
  