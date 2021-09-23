<div style="margin:auto">
    <div class="card" style="width: 18rem;">
        @if ($post->image)
            <img src="{{ '/storage/images/'.$post->image }}" class="card-img-top" alt="post image">
        @else
            <span>없음</span>
        @endif

        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">{{ $post->content }}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">등록일 : {{ $post->created_at->diffForHumans() }}</li>
          <li class="list-group-item">수정일 : {{ $post->updated_at->diffForHumans() }}</li>
          <li class="list-group-item">작성자 : {{ $post->writer->name }}</li>
        </ul>
        <div class="card-body">
          <a href="{{ route('posts.edit', ['post'=>$post->id]) }}" class="card-link"> 수정하기 </a>
          
          <form method="post" action="{{ route('posts.destroy', ['post'=>$post->id]) }}">

            <button class="card-link" >삭제하기</button>

            <a href="{{ route('posts.destroy', ['post'=>$post->id]) }}" class="card-link">삭제하기</a>
          </form>
          
        </div>
      </div>
</div>