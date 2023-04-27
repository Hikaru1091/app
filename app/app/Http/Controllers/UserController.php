<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Admin;
use App\Like;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('users.my_page',[
            'posts' => $posts,
        ]);
        
    }

    public function likeIndex()
    {
        $likes = Like::select('likes.post_id', 'posts.id', 'posts.user_id', 'posts.title', 'posts.body', 'posts.image')->join('posts', 'likes.post_id', '=', 'posts.id')->where('likes.user_id', Auth::user()->id)->get();
        return view('users.like_page',[
            'posts' => $likes
        ]);
        
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
        $posts = Post::where('user_id', $id)->get();
        $user = User::find($id);
        return view('users.show',[
            'posts' => $posts,
            'user' => $user
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
        return view('users.user_edit');
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
        $user = User::find($id);
        if (auth()->user()->id !=Auth::user()->id) {
            return redirect(route('users.index'));
        }
        if(request()->file('icon') != null){
            $icon = request()->file('icon');
            request()->file('icon')->storeAs('', $icon, 'public');
            $user->icon = $icon;
            }

        $user->name = $request->name;
        $user->profile = $request->profile;
        $user->save();

        return redirect(route('users.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
            return redirect()->route('admins.index');
    }
}
