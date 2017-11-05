<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $categories = Category::orderBy('id', 'desc')->paginate(5);
        return view('category.index')->withCategories($categories);
        //
    }
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255'
        ]);
        $category = new Category;
        $category->name = strtolower($request->name);
        $category->user_id = Auth::user()->id;
        $category->save();

        Session::flash('success', 'Category was added succesfully');
        return redirect('/category');
    }
    public function showAll($name) {
        $category = Category::all()->where('name', '=', $name)->first();
        if ($category != null) {
            $posts = Post::all()->where('category_id', '=', $category->id)->sortByDesc('id');
            return view('category.listAll')->withPosts($posts);
        }
        return redirect('/post');
    }

}
