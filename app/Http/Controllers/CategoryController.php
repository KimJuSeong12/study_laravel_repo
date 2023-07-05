<?php

namespace App\Http\Controllers;

use App\Models\ccategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        $categories = ccategory::orderby('title', 'asc')->get();
        return view('category.index')->with('categories', $categories);
    }
    public function view($id): View
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        $category = ccategory::find($id);
        return view('category.view')->with('category', $category);
    }
    // Request : $_POST, $_GET 모두 사용할 수 있다
    public function store(Request $request)
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        $category = new ccategory();
        $category->title = $request->title;
        $category->save();
        return redirect('/category');
    }
    public function update(Request $request, $id)
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        $category = ccategory::find($id);
        $category->title = $request->title;
        $category->save();
        return redirect('/category');
    }
    public function delete($id)
    {
        // 데이터베이스에 있는 내용을 가져오거나, 저장하거나, 삭제하거나, 수정하거나
        $category = ccategory::find($id);
        $category->delete();
        return redirect('/category');
    }
}
