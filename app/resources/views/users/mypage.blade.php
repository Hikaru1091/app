@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col"><img src="{{ asset('storage/'.Auth::user()->icon) }}" class="img-thumbnail" alt="..."></div>
        <div class="col d-flex justify-content-end"><button type="button" class="btn btn-primary">プロフィール編集</button></div>
    </div>

    <div class="row justify-content-center">
        <div class="col">{{ Auth::user()->name }}</div>
        <div class="col">{{ Auth::user()->profile }}</div>
    </div>

    <div class="row justify-content-center">
        <div class="col d-flex justify-content-center"><button type="button" class="btn btn-primary">自分の投稿</button></div>
        <div class="col d-flex justify-content-center"><button type="button" class="btn btn-primary">いいねした投稿</button></div>
    </div>

    @foreach($posts as $post)
    <div class="row justify-content-center">
        <div class="col-auto">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="画像">
                <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">投稿した人</p>
                <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">投稿詳細</a>
            </div>
        </div>
    </div>
    @endforeach
    
</div>
@endsection
