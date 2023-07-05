@extends('layouts.forum')

{{-- 내용 --}}
@section('content')
    <div class="container">
        <form action="{{ url('/category') }}/{{ $category->id }}/update" method="post">
            @method('PUT')
            @csrf
            <div class="row mt-3">
                <input type="text" class="form-control" value="{{ $category->title }}" name="title">
            </div>
            <div class="d-flex gap-2 justify-content-end mt-2">
                <button class="btn btn-info" type="submit">수정</button>
        </form>
        <form action="{{ url('/category') }}/{{ $category->id }}/delete" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit">삭제</button>
        </form>
    </div>
    </div>
@endsection
