@extends('layouts.forum')

{{-- 내용 --}}
@section('content')
    <div class="container">
        <div class="row mt-3">
            <form action="{{ url('/category/store') }}" method="POST">
                @csrf
                <div class="col-12">
                    <label for="inputGroupFile01">Category Title</label>
                    <input type="text" class="form-control" id="inputGroupFile01" name="title">
                </div>

                <div class="d-flex gap-2 justify-content-end mt-2">
                    <button class="btn btn-primary" type="submit">생성</button>
                </div>
            </form>
        </div>
        <hr>
        <ul class="list-group mt-3">
            @foreach ($categories as $category)
                <li class="list-group-item"><a
                        href="{{ url('/') }}/category/{{ $category->id }}/view">{{ $category->title }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
