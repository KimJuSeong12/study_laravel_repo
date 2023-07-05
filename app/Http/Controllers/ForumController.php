<?php

namespace App\Http\Controllers;

use App\Models\ccategory;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        return view('forum.index');
    }
    public function view(): View
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        return view('forum.view');
    }
    public function create(): View
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        $categories = ccategory::orderby('title', 'asc')->get();
        return view('forum.create')->with('categories', $categories);
    }
    //Ajax 통신하는 방식
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->save();
        // 가져왔던 데이터를 다시 보내준다.
        $result = $request->all();
        $data = array('result' => $result);
        return response()->json($data);
    }
}
