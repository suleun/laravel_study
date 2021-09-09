<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글쓰기 폼') }}
            <button onclick="location.href="{{ route('posts.index') }}"">
                목록보기
            </button>
        </x-slot>
        <div class="m-4 p-4" method="post" enctype="multipart/form-data">

            <form class="row g-3">
                @csrf
                <div class="col-12 m-2">
                    <label for="title" class="form-label">제목</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        id="title"
                        placeholder="제목을 입력하세요">
                </div>

                <div class="col-12 m-2">
                    <label for="content" class="form-label">글 내용</label>
                    <textarea class="form-control" name="content" id="content"></textarea>
                </div>

                <div class="col-12 m-2">
                    <label for="image">첨부이미지</label>
                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        id="image"
                       >
                </div>


                    <button type="submit" class="btn btn-primary">저장</button>
            </form>

        </div>

</x-app-layout>