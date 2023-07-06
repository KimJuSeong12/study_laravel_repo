<?php

namespace App\Http\Controllers;

use App\Models\ccategory;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        return view('forum.index');
    }
    public function view($id): View
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        $post = Post::find($id);
        return view('forum.view')->with('post', $post);
    }
    public function create(): View
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        if (isset(auth()->user()->id)) {
            $categories = ccategory::orderby('title', 'asc')->get();
            return view('forum.create')->with('categories', $categories);
        } else {
            return view('forum.index');
        }
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
    //Ajax 통신하는 방식
    public function update(Request $request)
    {
        $post = Post::find($request->post_id);
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->save();
        // 가져왔던 데이터를 다시 보내준다.
        $result = $request->all();
        $data = array('result' => $result);
        return response()->json($data);
    }
    public function category($id): View
    {
        $category = ccategory::find($id);
        $posts = Post::where('category_id', $id)->orderby('created_at', 'desc')->get();
        return view('forum.category')->with('posts', $posts)->with('category_title', $category->title);
    }
    public function edit($id): View
    {
        $post = Post::find($id);
        if (auth()->user()->id == $post->user_id) {
            $categories = ccategory::orderby('title', 'asc')->get();
            return view('forum.edit')->with('post', $post)->with('categories', $categories);
        } else {
            return redirect('/');
        }
    }
    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/');
    }
    //Ajax 통신하는 방식
    public function replyStore(Request $request)
    {
        $reply = new Reply;
        $reply->user_id = auth()->user()->id;
        $reply->post_id = $request->post_id;
        $reply->reply = $request->reply;
        $reply->save();
        return redirect('/' . $request->post_id . '/view');
    }
}
