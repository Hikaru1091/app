@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-end flex-column bd-highlight mb-3">
            @if (!Auth::guest() && Auth::user()->id == $post->user_id)
                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary p-2 bd-highlight">編集</a>
            @endif
            <form action="{{route('posts.destroy', $post->id)}}" method="post" class="">
                @csrf
                @method('delete')
                <input type="submit" value="削除" class="btn btn-danger p-2 bd-highlight" onclick='return confirm("削除しますか");'>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="col justify-content-center">
                <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="...">
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">{{ $post->title }}</div>
                </div>        
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                    <a href="#" class="card-link">投稿者</a>
                    </div>
                </div>        
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">{{ $post->body }}</div>
                </div>        
            </div>
        </div>
    </div>


@endsection
