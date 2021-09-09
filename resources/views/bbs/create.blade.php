<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글쓰기 폼') }}
            <button onclick=location.href="{{ route('posts.index') }}">
                목록보기
            </button>
    </x-slot>
    <x-posts-list :posts="$posts" />
</x-app-layout>