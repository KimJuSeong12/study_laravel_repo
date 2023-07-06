@extends('layouts.forum')

{{-- 내용 --}}
@section('content')
    <div class="container">
        @auth
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ url('/create') }}"><button class="btn btn-primary" type="button">새로운 포스팅</button></a>
            </div>
            <hr>
        @endauth

        @php
            $categories = App\Models\ccategory::orderby('title', 'asc')->get();
        @endphp
        @if (count($categories) > 0)
            @foreach ($categories as $category)
                @php
                    $posts = App\Models\Post::where('category_id', $category->id)
                        ->orderby('created_at', 'desc')
                        ->limit(3)
                        ->get();
                @endphp
                @if (count($posts) > 0)
                    <div class="row mt-5">
                        <div class="col-12">
                            <h4>{{ $category->title }}</h4>
                            <ul class="list-group">
                                @foreach ($posts as $post)
                                    <li class="list-group-item">
                                        <a href="{{ url('/') }}/{{ $post->id }}/view">{{ $post->title }}</a>
                                        <span class="badge text-bg-info"> <i class="fas fa-comment-dots"></i>3</span>
                                        <span class="badge rounded-pill text-bg-danger"><i class="fas fa-heart"></i>4</span>
                                        <br>
                                        <small>{{ $post->create_at }}| by 홍길동</small>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <a href="{{ url('/') }}/{{ $category->id }}/category" class="btn btn-dark w-50">All posting
                                of
                                {{ $category->title }} Category</a>
                        </div>
                    </div>
                    <hr>
                @endif
            @endforeach
        @endif

    </div>
@endsection
