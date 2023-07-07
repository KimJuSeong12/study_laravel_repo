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
            <button type="button" class="btn btn-outline-danger w-25 btn-lg"><i class="fas fa-heart"></i>
                {{ $post->like }}</button>
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
    <script>
        let liked = false; // 사용자가 해당 게시글을 좋아요한지 아닌지를 추적하는 변수 초기값은 false로 설정
        const likeButton = document.querySelector('.btn-outline-danger'); // 좋아요 버튼의 DOM 요소를 참조하는 변수
        let likeCount = {{ $post->like }}; // 서버에서 받아온 게시글의 좋아요 수

        // 좋아요 버튼의 텍스트를 업데이트하는 함수
        function updateLikeButtonText() {
            likeButton.innerHTML = `<i class="fas fa-heart"></i> ${likeCount}`;
        }

        // 좋아요 버튼에 클릭 이벤트 리스너를 설정
        likeButton.addEventListener('click', () => {
            if (!liked) { // 현재 좋아요 상태가 아닌 경우
                // 좋아요 추가 시
                fetch('/{{ $post->id }}/like', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                }).then((response) => {
                    // 요청이 성공한 경우
                    if (response.ok) {
                        likeCount++; // 좋아요 수를 증가
                        updateLikeButtonText(); // 증가된 좋아요 수를 버튼에 업데이트
                        liked = true; // 상태를 좋아요 상태로 변경
                    }
                });
            } else { // 현재 좋아요 상태인 경우
                // 좋아요 삭제 시
                fetch('/{{ $post->id }}/unlike', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                }).then((response) => {
                    // 요청이 성공한 경우
                    if (response.ok) {
                        likeCount--; // 좋아요 수를 감소
                        updateLikeButtonText(); // 감소된 좋아요 수를 버튼에 업데이트
                        liked = false; // 상태를 좋아요가 아닌 상태로 변경
                    }
                });
            }
        });
    </script>
@endsection
