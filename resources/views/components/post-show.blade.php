<div style="margin:auto">
    <div class="card" style="width: 18rem;">
        @if ($post->image)
        <img
            src="{{ '/storage/images/'.$post->image }}"
            class="card-img-top"
            alt="post image">
            @else
            <span>없음</span>
            @endif

            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">{{ $post->content }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">등록일 :
                    {{ $post->created_at->diffForHumans() }}</li>
                <li class="list-group-item">수정일 :
                    {{ $post->updated_at->diffForHumans() }}</li>
                <li class="list-group-item">작성자 :
                    {{ $post->writer->name }}</li>
            </ul>
            <div class="card-body flex">

                <a href="{{ route('posts.edit', ['post'=>$post->id]) }}" class="card-link">
                    수정하기
                </a>

                <form method="post" action="{{ route('posts.destroy', ['post'=>$post->id]) }}"
                  onsubmit="event.preventDefault(); confirmDelete(event)"
                  >
                    @csrf @method('delete')
                    {{-- <input type="hidden" name="_method" value="delete"> --}}
                    <button class="card-link" >삭제하기</button>

                </form>

            </div>
        </div>

        <script>
          function confirmDelete(e){
            myform = document.getElementById('form');
            flag = confirm('정말 삭제하시겠습니까?');
            if(flag){
              // 서버쪽에 저장
              myform.submit();
            }
            e.preventDefault();//form이 서버로 전달되는 것을 막아준다
            return false;
          }

        </script>

    </div>