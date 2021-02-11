<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $posts = Post::all();
        // $category_id = [1];
        $categories = Category::pluck('name', 'id');//Post::whereIn('category_id', $category_id)->get();
        // dd($categories);
        // return view('create', compact('categories'));
        $posts = Post::with('comments')->get();//whereIn('category_id', $category_id)->get();
        // dd($posts);
        // foreach($posts as $post){


        // }
        
        // return view('index', compact('posts','categories'))->with('auth_user',  auth()->user());;
        // return view('home');
    }
}
