<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use Image;
use App\Comment;
use Session;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("check");
        $categories = Category::all();
        $posts = Post::with('comments')->latest()->get();//whereIn('category_id', $category_id)->get();

        return view('index', compact('posts','categories'))->with('auth_user',  auth()->user());
        // return response()->json($posts, 200);
    }

    public function posts()
    {
        // dd("check");
        $posts = Post::with('comments')->latest()->get();//whereIn('category_id', $category_id)->get();

        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $category_id = [1];
        // $categories = Category::pluck('name', 'id');//Post::whereIn('category_id', $category_id)->get();
        // // dd($categories);
        // return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $postData = $this->validate($request, [
            'topic' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        $category = Category::where('name', $postData['category_id'])->first();

        if($request->photo){
            // $image = $request->file('photo')
            $name = time(). '.' .explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            $location = public_path('storage/images/'.$name);
            Image::make($request->photo)->save($location);
        }
        $post = Post::create([
            'topic' => $request['topic'],
            'body' => $request['body'],
            'category_id' => $request['category_id'],
            'photo' => $name
        ]);
        // return response()->json($post, 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $post= Post::findOrFail($id);
        $ip = $request->ip();
        $post_id = 'blog_' . $post->id;
        Post::where('id', $id)->update(['user_ip'=> $ip]);

        if (!Session::has($post_id) && ($ip != $post->user_ip)) {
            $post->increment('visit_count');
            Session::put($post_id,1);
        }

        $comment = $post->comments;
        $id = $post->id;
        $comments = Comment::where('commentable_id', $id)->get();
        // dd($comments);
        return response()->json([$post, $comments, 200]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        return $post;

    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if(auth()->user()){
            $postData = $this->validate($request, [
                'topic' => 'required',
                'category_id' => 'required',
                'body' => 'required'
            ]);

            $singlepost = Post::findOrFail($id);
            $currentPhoto = $singlepost->photo;
            // dd($currentPhoto);

            // $currentPhoto = $user->photo;
            // return ['message'=>'success'];
            if($request->photo != $currentPhoto){
                $name = time(). '.' .explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
                $location = public_path('storage/images/'.$name);
                Image::make($request->photo)->save($location);

                $request->merge(['photo'=>$name]);

                $postImage = public_path('storage/images/').$currentPhoto;
                if(file_exists($postImage)){
@unlink($postImage);
                }
            }
            $category = Category::where('name', $postData['category_id'])->first();
            // dd($category->id);
            $singlepost = $singlepost->update([
                'topic' => $request['topic'],
                'body' => $request['body'],
                'category_id' => $request['category_id'],
                'photo' => $name ?? null
            ]);


        // return ["message"=>"Success"];


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        //delete user
        $post->delete();
    }
}
