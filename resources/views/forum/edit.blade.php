@extends('layouts.forum')
@section('inside_head_tag')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
{{-- 내용 --}}
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" value="{{ $post->title }}">
            </div>
        </div>

        <div class="row my-5">
            <div class="col-12">
                <label>Category</label>
                <select class="form-select" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"{{ $category->id == $post->category_id ? 'selected' : '' }}>
                            {{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="editor">
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <input type="hidden" id="post_id" value="{{ $post->id }}">
            <button class="btn btn-primary" type="button" id="submit">수정전송</button>
        </div>
    </div>
@endsection
@section('before_body_tag')
    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#submit').click(function() {
                let post_id = $('#post_id').val();
                let title = $("#title").val();
                let category_id = $("#category_id").val();
                let content = $(".ck-content").html();
                $.ajax({
                    type: "POST",
                    url: "/update",
                    data: {
                        _token: CSRF_TOKEN,
                        post_id: post_id,
                        title: title,
                        category_id: category_id,
                        content: content
                    },
                    dataType: 'JSON',
                    success: function success(data) {
                        console.log(data.result);
                        location.href = '/' + post_id + '/view';
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
