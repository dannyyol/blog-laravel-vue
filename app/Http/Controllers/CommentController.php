<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function addPostComment(Request $request, Post $post, Comment $comment)
     {
        $this->validate($request,[
            'fullname' =>'required',
            'body'=>'required',
            'email' => 'required'
        ]);
        $form=new Comment();
        $form->fullname = $request->fullname;
        $form->body = $request->body;
        $form->email=$request->email;
          
        $post->comments()->save($form);
        $form->save();
        return response()->json($form, 201);
        }

        public function addReplyComment(Request $request, Comment $comment)
        {
            $this->validate($request,[
                'fullname' =>'required',
                 'body'=>'required',
                'email' => 'required'
            ]);

            $reply=new Comment();
            $reply->fullname = $request->fullname;
            $reply->email = $request->email;
            $reply->body=$request->body;
            // $reply->user_id = auth()->user()->id;
            
            $comment->comments()->save($reply);
            
            $reply->save();
            return response()->json($reply, 201);


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $comment = Comment::find($id);
        // return response()->json($comment, 200); 

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
        //
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
    }
}
