<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',[
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $image = request()->file('image');
        request()->file('image')->storeAs('', $image, 'public');
        
        $post = new Post;

        $post->user_id = Auth::id();
        $post->image = $image;
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show',[
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (auth()->user()->id != $post->user_id) {
            return redirect(route('posts.index'));
        }
        return view('posts.edit')->with('post', $post);
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
        $post = Post::find($id);
        if (auth()->user()->id != $post->user_id) {
            return redirect(route('posts.show' , $id));
        }
        if(request()->file('image') != null){
            $image = request()->file('image');
            request()->file('image')->storeAs('', $image, 'public');
            $post->image = $image;
            }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect(route('posts.show' , $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id != $post->user_id) {
            return redirect(route('posts.index'));
        }
        $post->delete();
            return redirect(route('posts.index'));
    }
}
