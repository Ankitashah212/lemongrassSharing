<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Session;
use Auth;
use Image;
use App\Category;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**sortin to make newest post come first */
        $posts = Post::all()->sortByDesc('id');
        $categories = Category::all();
        return view('post.index')->withPosts($posts)->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
        $this->validate($request, [
            'title' => 'required|max:255',
            'image' => 'image', /*no validation for image - optional*/            
            'body' => 'required|max:255'
        ]);


        /** get all input variables from frontend  */
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->user_id = Auth::user()->id;
        
        /**adding image */
        
        /** save as a post to DB */
        $post->save();
        Session::flash('success', 'Post Created');
        return redirect('/post');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $post = Post::find($id);
        return view('post.show')->withPost($post); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $categories = Category::all();
        return view('post.edit')->withPost($post)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $this->validate($request, [
            'title' => "required|max:255|unique:posts,title,$id",
            'image' => 'image',
            'body' => 'required|max:255'
        ]);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->user_id = Auth::user()->id;
       
        $post->save();
       

        Session::flash('success', 'Post Updated');
        //return redirect()->back();        
        return redirect('/home');   
     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
       
        $post->delete();
        Session::flash('success', 'Post deleted');
        //return redirect()->back();
        return redirect('/home');   
    }

    public function search($word)
    {
        if ($word != null) {
        
           // $posts = Post::all()->where('title', 'like',$word);
           // ->or('body', 'LIKE', "%$word%");
 /*         
           $posts = DB::table('posts')
           ->where('title', 'like', "%$word%")
           ->get();
*/
           $posts = DB::table('posts')
           ->join('categories', 'posts.category_id', '=', 'categories.id')
           ->join('users', 'users.id', '=', 'posts.user_id')
           ->select('posts.*', 'users.name as username', 'categories.name as cat')
           ->where('title', 'like', "%$word%")
           ->orwhere('body', 'like', "%$word%")
           ->get();
           
            return view('post.search')->withPosts($posts);
        }
        return redirect('/post');
    }
}
