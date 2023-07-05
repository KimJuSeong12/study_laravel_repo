@extends('layouts.forum')

{{-- 내용 --}}
@section('content')
    <div class="container">
        <div class="col-12 border mt-5 p-2">
            <h3>Lorem ipsum dolor sit amet.</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam eum placeat repudiandae dignissimos excepturi
                nisi minus, voluptatibus commodi fuga odit.</p>
            <hr>
            <div class="d-flex gap-2 justify-content-end">
                <button class="btn btn-secondary" type="button">Edit</button>
                <button class="btn btn-danger" type="button">Delete</button>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="button" class="btn btn-outline-danger w-25 btn-lg"><i class="fas fa-heart"></i>4</button>
        </div>

        <ul class="list-group mt-3">
            <li class="list-group-item">An item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
            <li class="list-group-item">A fourth item</li>
            <li class="list-group-item">And a fifth one</li>
        </ul>

        <div class="input-group mt-3">
            <input type="text" class="form-control">
        </div>
        <div class="d-flex gap-2 justify-content-end mt-2">
            <button class="btn btn-primary" type="button">submit</button>
        </div>
    </div>
@endsection
