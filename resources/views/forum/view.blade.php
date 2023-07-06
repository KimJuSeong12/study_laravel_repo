@extends('layouts.forum')

{{-- 내용 --}}
@section('content')
    <div class="container">
        <div class="col-12 border mt-5 p-2">
            <h3>{{ $post->title }}</h3>
            {!! $post->content !!}
            <hr>
            @auth
                @if ($post->user_id == auth()->user()->id)
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ url('/') }}/{{ $post->id }}/edit" class="btn btn-secondary">Edit</a>
                        {{-- 삭제기능: form을 통해서 전송할 것 --}}
                        <form action="{{ url('/') }}/{{ $post->id }}/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="button" class="btn btn-outline-danger w-25 btn-lg"><i class="fas fa-heart"></i>4</button>
        </div>

        {{-- 답글 --}}
        <div class="row my-3">
            <div class="col-12">
                <ul class="list-group">
                    @php
                        $replies = App\Models\Reply::where('post_id', $post->id)
                            ->orderby('created_at', 'asc')
                            ->get();
                    @endphp
                    @if (count($replies) > 0)
                        @foreach ($replies as $reply)
                            <li class="list-group-item list-group-item-action">{{ $reply->reply }}<br>
                                <small>{{ $reply->created_at }} | by
                                    @php
                                        $user = App\Models\User::find($reply->user_id);
                                    @endphp
                                    {{ $user->name }}
                                </small>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        {{-- 답글입력 --}}
        <form action="/reply/store" method="POST">
            @csrf
            <div class="row my-3">
                <div class="col-12">
                    <input type="text" class="form-control" name="reply">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                </div>
            </div>
            {{-- 답글입력저장 오른쪽버튼 --}}
            <div class="row my-3">
                <div class="col-12">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="submit">답글저장</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
